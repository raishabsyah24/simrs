<?php

namespace App\Http\Controllers\Admin\Dokter;

use App\Models\Poli;
use App\Models\Layanan;
use App\Models\ObatApotek;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use App\Models\ObatPasienRajal;
use App\Models\RekamMedisPasien;
use App\Models\PemeriksaanDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\DokterInterface;

class PasienDokterController extends Controller
{
    private $dokterRepository;
    private $perPage = 20;
    public $limitObatPasienBpjs = 70000;
    public $kategoriPasien = 1;

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }

    public function q()
    {
        $daftar_pasien = $this->dokterRepository->identitasPasien(1);
        return $daftar_pasien;
    }

    public function index()
    {
        $dokter_id = Auth::user()->dokter->id;
        if (!$dokter_id) {
            return abort(403);
        }
        $dokter = $this->dokterRepository->dokterSpesialis($dokter_id);
        $data = $this->dokterRepository->daftarPasienDokterSpesialis($dokter->poli_id)
            ->paginate($this->perPage);
        $title = 'Daftar Pasien';
        return view('admin.dokter.pasien.index', compact(
            'title',
            'data'
        ));
    }

    public function fetch(Request $request)
    {
        $title = 'Daftar Pasien';
        $q = $request->get('query');
        $dokter_id = Auth::user()->dokter->id;
        $dokter = $this->dokterRepository->dokterSpesialis($dokter_id);
        $data = $this->dokterRepository->daftarPasienDokterSpesialis($dokter->poli_id)
            ->when($q ?? false, function ($query) use ($q) {
                return $query->where('pas.nama', 'like', '%' . $q . '%');
            })
            ->paginate($this->perPage);
        return view(
            'admin.dokter.pasien.fetch',
            compact('data')
        )
            ->render();
    }

    public function periksaPasien($periksa_dokter_id)
    {
        $title = 'Periksa Pasien';
        $periksa_dokter = PeriksaDokter::find($periksa_dokter_id);
        $pasien_id = $periksa_dokter->pasien_id;
        $rekam_medis = $this->dokterRepository->rekamMedisPasienPeriksa($periksa_dokter_id);
        $pasien = $this->dokterRepository->identitasPasien($pasien_id);

        return view('admin.dokter.pasien.pasien', compact(
            'title',
            'rekam_medis',
            'pasien',
            'periksa_dokter_id'
        ));
    }

    public function searchObat(Request $request)
    {
        $obat = $request->get('obat');
        $periksa_dokter_id = $request->get('periksa_dokter_id');
        $data = $this->dokterRepository->searchObat($obat, $periksa_dokter_id);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item" 
                onclick="pilihObat(`' . $item->id . '`,`' . $periksa_dokter_id . '`,`' . route('dokter.change-obat') . '`)">' . $item->nama_generik . ' ( ' . $item->nama_paten . ' )' . ' </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function changeObat(Request $request)
    {
        $attr = $request->all();
        DB::transaction(
            function () use ($attr) {
                $obat = ObatApotek::find($attr['obat_apotek_id']);
                $harga_obat = $obat->harga_jual;

                ObatPasienRajal::create([
                    'obat_apotek_id' => $attr['obat_apotek_id'],
                    'periksa_dokter_id' => $attr['periksa_dokter_id'],
                    'harga_obat' => $harga_obat,
                    'jumlah' => 1,
                    'subtotal' => $harga_obat
                ]);
            }
        );

        return response()->json([
            'message' => 'Obat berhasil ditambahkan',
            'url' => route('dokter.obat-pasien', $attr['periksa_dokter_id'])
        ], 200);
    }

    public function obatPasien($periksa_dokter_id)
    {
        $data = $this->dokterRepository->obatPasien($periksa_dokter_id);
        $total = $data->sum('subtotal');
        $limit = null;

        // cek kategori pasien
        $periksa_dokter = PeriksaDokter::find($periksa_dokter_id);
        $pemeriksaan_detail = PemeriksaanDetail::find($periksa_dokter->pemeriksaan_detail_id);
        $pemeriksaan = Pemeriksaan::find($pemeriksaan_detail->pemeriksaan_id);
        $kategori_pasien = DB::table('kategori_pasien as kp')
            ->selectRaw('
            p.kategori_pasien, kp.nama as kategori
        ')
            ->join('pemeriksaan as p', 'p.kategori_pasien', '=', 'kp.id')
            ->where('kp.id', $pemeriksaan->kategori_pasien)
            ->first();

        if ($total > $this->limitObatPasienBpjs && $kategori_pasien->kategori_pasien == $this->kategoriPasien) {
            $limit = 'limit';
        } else {
            $limit = 'aman';
        }

        $output = '';
        foreach ($data as $key => $item) {
            $output .= '
            <tr>
                <td>' . $key + 1 . '</td>
                <td>' . $item->nama_generik . '</td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input autocomplete="off" onkeyup="updateQuantity(`' . route('dokter.obat-pasien.update-quantity', $item->obat_pasien_periksa_rajal_id) . '`,this,`' . $item->obat_pasien_periksa_rajal_id . '`)" name="jumlah"
                                value="' . $item->jumlah . '"
                                type="text" class="form-control">
                        </div>
                    </div>
                </td>
                <td>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" name="satuan">
                            <option value="" disabled selected>Satuan</option>
                            <option value="default_option">Papan</option>
                            <option value="option_select_name">Botol</option>
                            <option value="option_select_name">Kaplet</option>
                        </select>
                    </div>
                </div>
                </td>
                <td>
                     <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control" name="signa">
                                <option value="" disabled selected>Signa</option>
                                <option value="default_option">1 X 1</option>
                                <option value="option_select_name">2 X 1</option>
                                <option value="option_select_name">3 X 1</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="text-right">' . formatAngka($item->harga_obat, true) . '</td>
                <td class="text-right">' . formatAngka($item->subtotal, true) . '</td>
                <td class="text-center">
                    <button onclick="hapusObat(`' . route('dokter.obat-pasien.hapus', $item->obat_pasien_periksa_rajal_id) . '`,`' . $item->obat_pasien_periksa_rajal_id . '`)" class="btn btn-danger btn-sm"><em class="icon ni ni-trash-alt"></em></button>
                </td>
            </tr>
        ';
        }
        $output .= '<tr> 
                        <td colspan="5" class="text-right"><h5>Total</h5></td>
                        <td class="text-right"><h5>Rp. </h5></td>
                        <td colspan="2" class="text-right"><h4>' . formatAngka($total) . '</h4></td>
                    </tr>';

        return response()->json([
            'output' => $output,
            'limit' => $limit
        ], 200);
    }

    public function updateQuantity(Request $request)
    {
        $attr = $request->all();

        $data['obat_pasien_periksa_rajal'] = ObatPasienRajal::find($attr['obat_pasien_periksa_rajal_id']);
        $data['obat_apotek'] = ObatApotek::find($data['obat_pasien_periksa_rajal']->obat_apotek_id);
        $data['harga_jual'] = $data['obat_apotek']->harga_jual;

        // Cek total obat pasien bpjs
        $total_tagihan_obat_pasien = ObatPasienRajal::where('periksa_dokter_id', $data['obat_pasien_periksa_rajal']->periksa_dokter_id)
            ->get();
        $total_tagihan_obat_pasien = $total_tagihan_obat_pasien->sum('subtotal');

        // Cek total input obat
        $subtotal = $data['harga_jual'] * $attr['jumlah'];

        // Total
        $total = $total_tagihan_obat_pasien + $subtotal;

        // cek kategori pasien
        $periksa_dokter = PeriksaDokter::find($data['obat_pasien_periksa_rajal']->periksa_dokter_id);
        $pemeriksaan_detail = PemeriksaanDetail::find($periksa_dokter->pemeriksaan_detail_id);
        $pemeriksaan = Pemeriksaan::find($pemeriksaan_detail->pemeriksaan_id);
        $kategori_pasien = DB::table('kategori_pasien as kp')
            ->selectRaw('
            p.kategori_pasien, kp.nama as kategori
        ')
            ->join('pemeriksaan as p', 'p.kategori_pasien', '=', 'kp.id')
            ->where('kp.id', $pemeriksaan->kategori_pasien)
            ->first();

        if ($total >= $this->limitObatPasienBpjs && $kategori_pasien->kategori_pasien == $this->kategoriPasien) {
            return response()->json([
                'limit' => 'limit',
                'message' => 'Limit obat pasien sudah melewati batas'
            ], 200);
        } else {
            $data['obat_pasien_periksa_rajal']->update([
                'jumlah' => $attr['jumlah'],
                'subtotal' => $data['harga_jual'] * $attr['jumlah']
            ]);

            return response()->json([
                'limit' => 'aman',
                'message' => 'Ubah quantity berhasil'
            ], 200);
        }
    }

    public function hapusObat(Request $request)
    {
        $obatPasienRajal = ObatPasienRajal::find($request->id);
        $obatPasienRajal->delete();
        return response()->json([
            'message' => 'Hapus obat berhasil'
        ], 200);
    }

    public function storePasien(PeriksaDokter $periksaDokter, Request $request)
    {
        $attr = $request->except(['obat', 'satuan', 'signa', 'jumlah']);
        $attr['status_diperiksa'] = 'sudah diperiksa';

        DB::transaction(
            function () use ($attr, $periksaDokter) {
                $periksaDokter->update($attr);

                $pemeriksaan_detail = PemeriksaanDetail::find($periksaDokter->pemeriksaan_detail_id);
                $layanan = Layanan::find($pemeriksaan_detail->layanan_id);
                $harga_layanan = $layanan->tarif;

                // Update tagihan layanan di table pemeriksaan detail
                $pemeriksaan_detail->update([
                    'tagihan_layanan' => $harga_layanan
                ]);

                // Update tagihan layanan di table pemeriksaan
                $pemeriksaan = Pemeriksaan::find($pemeriksaan_detail->pemeriksaan_id);
                $pemeriksaan->update([
                    'total_tagihan_layanan' => $pemeriksaan->total_tagihan_layanan + $pemeriksaan_detail->tagihan_layanan
                ]);

                // Update tagihan obat di table pemeriksaan
                $obat_pasien_periksa = ObatPasienRajal::where('periksa_dokter_id', $periksaDokter->id)->get();
                $tagihan_obat = $obat_pasien_periksa->sum('subtotal');
                $pemeriksaan->update([
                    'total_tagihan_obat' => $pemeriksaan->total_tagihan_obat + $tagihan_obat
                ]);

                // Cek rekam medis pasien
                $rm = RekamMedis::find($periksaDokter->pasien_id);
                $poli = Poli::find($periksaDokter->poli_id);

                // Insert rekam medis pasien
                $rekam_medis_pasien = RekamMedisPasien::create([
                    'rekam_medis_id' => $rm->id,
                    'tujuan' => $poli->nama,
                    'dokter' => Auth::user()->dokter->nama,
                    'subjektif' => $attr['subjektif'],
                    'objektif' => $attr['objektif'],
                    'assesment' => $attr['assesment'],
                    'plan' => $attr['plan'],
                    'tanggal' => now()
                ]);
            }
        );

        return response()->json([
            'message' => 'Terimakasih atas layanannya',
            'url' => route('dokter.daftar-pasien')
        ], 200);
    }
}
