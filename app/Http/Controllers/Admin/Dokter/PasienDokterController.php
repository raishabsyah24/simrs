<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Models\{
    DiagnosaPasienRajal,
    Dokter,
    Kasir,
    KasirDetail,
    Poli,
    Layanan,
    ObatApotek,
    RekamMedis,
    Pemeriksaan,
    PeriksaDokter,
    ObatPasienRajal,
    Pasien,
    RekamMedisPasien,
    PemeriksaanDetail,
    PosisiDetailPasienRajal,
    PosisiPasienRajal,
    TindakanPasienRajal
};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\DokterInterface;
use App\Http\Requests\Admin\PeriksaPasienRajalRequest;

class PasienDokterController extends Controller
{
    private $dokterRepository;
    private $perPage = 20;
    public $limitObatPasienBpjs = 70000;
    public $kategoriPasienBpjs = 1;

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }

    // Data pasien hari ini berdasarkan login dokter spesialis
    public function index()
    {
<<<<<<< HEAD
        $user_id = Auth::id();
        $user_dokter = Dokter::select('id')->where('user_id', $user_id)->first();
        if (!$user_dokter) {
            return abort(403);
=======
        $dokter_id = Auth::user()->dokter->id;
        if (!$dokter_id) {
            return redirect()->abort(403);
>>>>>>> fb18979 (kamis 3 februari)
        }
        $dokter = $this->dokterRepository->dokterSpesialis($user_dokter->id);
        $data = $this->dokterRepository->daftarPasienDokterSpesialis($user_id)
            ->paginate($this->perPage);
        $title = 'Daftar Pasien';
        return view('admin.dokter.pasien.index', compact(
            'title',
            'data',
            'dokter_id',
            'dokter'
        ));
    }

    // Search data pasien hari ini berdasarkan login dokter spesialis
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

    // Halaman periksa pasien
    public function periksaPasien($periksa_dokter_id)
    {
        $title = 'Periksa Pasien';
        $periksa_dokter = PeriksaDokter::find($periksa_dokter_id);

        $rekam_medis = $this->dokterRepository->rekamMedisPasienPeriksa($periksa_dokter->pasien_id);
        $pasien = $this->dokterRepository->identitasPasien($periksa_dokter->pasien_id);
        $periksa_poli_station = $this->dokterRepository->periksaPoliStation($periksa_dokter_id);

        // Aktifitas user
        $posisi_pasien_rajal = $this->dokterRepository->posisiPasienRajal($pasien->pemeriksaan_id);
        $posisi_pasien_rajal_status = PosisiPasienRajal::findOrFail($posisi_pasien_rajal->posisi_pasien_rajal_id);
        if ($posisi_pasien_rajal_status->status == 'proses periksa dokter') {
            $posisi_pasien_rajal_status->update([
                'status' => 'periksa dokter'
            ]);

            $user_id = Auth::id();
            $dokter = Dokter::select(['id', 'nama'])->where('user_id', $user_id)->first();

            //           uery mendapatkan nama poli
            $pemeriksaan_detail = PemeriksaanDetail::select(['id', 'poli_id'])
                ->where('id', $periksa_dokter->pemeriksaan_detail_id)
                ->first();
            $poli = Poli::select(['id', 'nama'])
                ->where('id', $pemeriksaan_detail->poli_id)
                ->first();

            $aktifitas = "Pasien diperiksa di poli {$poli->nama} oleh {$dokter->nama}";

            $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                'posisi_pasien_rajal_id' => $posisi_pasien_rajal->posisi_pasien_rajal_id,
                'aktifitas' => $aktifitas,
                'waktu' => now(),
                'keterangan' => 'checkin',
                'status' => 'proses'
            ]);
        }

        return view('admin.dokter.pasien.pasien', compact(
            'title',
            'rekam_medis',
            'pasien',
            'periksa_dokter_id',
<<<<<<< HEAD
            'periksa_dokter',
            'periksa_poli_station'
=======
            'periksa_dokter'
>>>>>>> fb18979 (kamis 3 februari)
        ));
    }

    // Search obat untuk pasien
    public function searchObat(Request $request)
    {
        $obat = $request->get('obat');
        // dd($obat);
        $periksa_dokter_id = $request->get('periksa_dokter_id');
        $data = $this->dokterRepository->searchObat($obat, $periksa_dokter_id);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            if ($item->stok >= $item->minimal_stok) {
                $output .= '
                <a href="#" class="item dropdown-item"
                onclick="pilihObat(`' . $item->id . '`,`' . $periksa_dokter_id . '`,`' . route('dokter.change-obat') . '`)">' . $item->nama_generik . ' ( ' . $item->nama_paten . ' )' . ' </a>
                ';
            }
        }
        $output .= '</div>';
        echo $output;
    }

    // Pilih obat untuk pasien dan masukan ke database
    public function changeObat(Request $request)
    {
        $attr = $request->all();

        // cek total obat pasien
        $obat_pasien_rajal = ObatPasienRajal::where('periksa_dokter_id', $attr['periksa_dokter_id'])->get();
        $subtotal = 0;
        foreach ($obat_pasien_rajal as $obat) {
            $subtotal += $obat->jumlah * $obat->harga_obat;
        }

        $harga_obat_dipilih = ObatApotek::find($attr['obat_apotek_id']);
        $total = $subtotal + $harga_obat_dipilih->harga_jual;

        // cek pasien dokter
        $periksa_dokter = PeriksaDokter::find($attr['periksa_dokter_id']);
        $pemeriksaan_detail = PemeriksaanDetail::find($periksa_dokter->pemeriksaan_detail_id);
        $pemeriksaan = Pemeriksaan::find($pemeriksaan_detail->pemeriksaan_id);

        if ($pemeriksaan->kategori_pasien == $this->kategoriPasienBpjs) {
            if ($total > $this->limitObatPasienBpjs) {
                return response()->json([
                    'status' => false
                ], 200);
            } else {
                $obat = ObatApotek::find($attr['obat_apotek_id']);
                $harga_obat = $obat->harga_jual;

                ObatPasienRajal::create([
                    'obat_apotek_id' => $attr['obat_apotek_id'],
                    'periksa_dokter_id' => $attr['periksa_dokter_id'],
                    'harga_obat' => $harga_obat,
                    'signa1' => 1,
                    'signa2' => 1,
                    'jumlah' => 1,
                    'subtotal' => $harga_obat
                ]);
<<<<<<< HEAD

=======
>>>>>>> fb18979 (kamis 3 februari)
                return response()->json([
                    'message' => 'Obat berhasil ditambahkan',
                    'url' => route('dokter.obat-pasien', $attr['periksa_dokter_id'])
                ], 200);
            }
        } else {

<<<<<<< HEAD
            $obat = ObatApotek::find($attr['obat_apotek_id']);
=======
            $$obat = ObatApotek::find($attr['obat_apotek_id']);
>>>>>>> fb18979 (kamis 3 februari)
            $harga_obat = $obat->harga_jual;

            ObatPasienRajal::create([
                'obat_apotek_id' => $attr['obat_apotek_id'],
                'periksa_dokter_id' => $attr['periksa_dokter_id'],
                'harga_obat' => $harga_obat,
                'signa1' => 1,
                'signa2' => 1,
                'jumlah' => 1,
                'subtotal' => $harga_obat
            ]);
            return response()->json([
                'message' => 'Obat berhasil ditambahkan',
                'url' => route('dokter.obat-pasien', $attr['periksa_dokter_id'])
            ], 200);
        }
    }

    // Data obat pasien periksa
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

        if ($total > $this->limitObatPasienBpjs && $kategori_pasien->kategori_pasien == $this->kategoriPasienBpjs) {
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
                            <input type="number" autocomplete="off" onkeyup="updateQuantity(`' . route('dokter.obat-pasien.update-quantity', $item->obat_pasien_periksa_rajal_id) . '`,this,`' . $item->obat_pasien_periksa_rajal_id . '`)" name="jumlah"
                                value="' . $item->jumlah . '" style="width: 7em" class="form-control">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="number" onkeyup="signaSatu(`' . route('dokter.obat-pasien.signa1', $item->obat_pasien_periksa_rajal_id) . '`,this,`' . $item->obat_pasien_periksa_rajal_id . '`)" value="' . $item->signa1 . '" style="width: 4em;" autocomplete="off" name="signa1" type="number" class="form-control">
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <p class="pt-1">X</p>
                </td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap ">
                            <input onkeyup="signaDua(`' . route('dokter.obat-pasien.signa2', $item->obat_pasien_periksa_rajal_id) . '`,this,`' . $item->obat_pasien_periksa_rajal_id . '`)" type="number" style="width: 4em" autocomplete="off" name="signa2" value="' . $item->signa2 . '" type="number" class="form-control">
                        </div>
                    </div>
                </td>
                <td class="text-right">' . formatAngka($item->harga_obat, true) . '</td>
                <td class="text-right">' . formatAngka($item->subtotal, true) . '</td>
                <td class="text-center">
                    <button onclick="hapusObat(`' . route('dokter.obat-pasien.hapus', $item->obat_pasien_periksa_rajal_id) . '`,`' . $item->obat_pasien_periksa_rajal_id . '`,`' . $item->periksa_dokter_id . '`)" class="btn btn-danger btn-sm"><em class="icon ni ni-trash-alt"></em></button>
                </td>
            </tr>
        ';
        }
<<<<<<< HEAD
        $output .= '<tr>
=======
        $output .= '<tr> 
>>>>>>> fb18979 (kamis 3 februari)
                        <td colspan="6" class="text-right"><h5>Total</h5></td>
                        <td class="text-right"><h5>Rp. </h5></td>
                        <td colspan="2" class="text-right"><h4>' . formatAngka($total) . '</h4></td>
                    </tr>';

        return response()->json([
            'output' => $output,
            'limit' => $limit
        ], 200);
    }

    // Update jumlah obat pasien
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

        if ($total >= $this->limitObatPasienBpjs && $kategori_pasien->kategori_pasien == $this->kategoriPasienBpjs) {
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

    // Hapus obat pasien ditable obat pasien
    public function hapusObat(Request $request)
    {
        $obatPasienRajal = ObatPasienRajal::find($request->id);
        $obatPasienRajal->delete();

        $periksa_dokter = ObatPasienRajal::where('periksa_dokter_id', $request->periksa_dokter_id)->get();
        $total = 0;
        foreach ($periksa_dokter as $obat) {
            $total += $obat->jumlah * $obat->harga_obat;
        }

        $periksa_dokter = PeriksaDokter::find($request->periksa_dokter_id);
        $pemeriksaan_detail = PemeriksaanDetail::find($periksa_dokter->pemeriksaan_detail_id);
        $pemeriksaan = Pemeriksaan::find($pemeriksaan_detail->pemeriksaan_id);

        if ($pemeriksaan->kategori_pasien == $this->kategoriPasienBpjs) {
            if ($total <= $this->limitObatPasienBpjs) {
                return response()->json([
                    'input' => true
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Hapus obat berhasil'
        ], 200);
    }

    // Simpan pemeriksaan pasien
    public function storePasien(PeriksaDokter $periksaDokter, PeriksaPasienRajalRequest $request)
    {
        $attr = $request->except(['obat', 'satuan', 'signa', 'jumlah', 'tindakan', 'diagnosa']);
        $attr['status_diperiksa'] = 'sudah diperiksa';
        $attr['status'] = 'selesai';
        $attr['dokter_id'] = auth()->user()->dokter->id;

        DB::transaction(
            function () use ($attr, $periksaDokter) {

                //              query pemeriksaan detail untuk mendapatkan layanan pasien
                $pemeriksaan_detail = PemeriksaanDetail::select(['id', 'pemeriksaan_id', 'status', 'poli_id', 'layanan_id'])
                    ->where('id', $periksaDokter->pemeriksaan_detail_id)
                    ->first();

                //              query pemeriksaan untuk mendapatkan pemeriksaan id
                $pemeriksaan = Pemeriksaan::select('id')
                    ->where('id', $pemeriksaan_detail->pemeriksaan_id)
                    ->first();

                // Update status layanan di table pemeriksaan detail
                $pemeriksaan_detail->update([
                    'status' => $attr['status']
                ]);

                // Hitung total tagihan obat
                $obat_pasien_periksa = ObatPasienRajal::select(['id', 'periksa_dokter_id', 'subtotal'])
                    ->where('periksa_dokter_id', $periksaDokter->id)
                    ->get();
                $tagihan_obat = $obat_pasien_periksa->sum('subtotal');

<<<<<<< HEAD
                //                Cek status pasien diperiksa
                if ($periksaDokter->status_diperiksa == 'belum diperiksa') {
                    //                    Query layanan untuk mendapatkan tarif layanan pasien
                    $layanan = Layanan::select(['id', 'tarif'])
                        ->where('id', $pemeriksaan_detail->layanan_id)
                        ->first();

                    //                 Query kasir untuk mendapatkan id transaksi di pendaftaran
                    $kasir = Kasir::select(['id', 'pemeriksaan_id', 'total_tagihan', 'status'])
                        ->where('pemeriksaan_id', $pemeriksaan_detail->pemeriksaan_id)
                        ->first();

                    //                Insert ke table kasir detail tagihan pemeriksaan dokter
                    KasirDetail::create([
                        'kasir_id' => $kasir->id,
                        'jenis_tagihan' => 'Periksa dan konsultasi dokter',
                        'subtotal' => $layanan->tarif,
                        'tanggal_layanan' => now()
                    ]);

                    //                  Insert ke table kasir detail tagihan obat pasien
                    KasirDetail::create([
                        'kasir_id' => $kasir->id,
                        'jenis_tagihan' => 'Obat-obatan',
                        'subtotal' => $tagihan_obat,
                        'tanggal_layanan' => now()
                    ]);

                    //                  Query total tagihan dan grand total pasien
                    $tagihan_pasien = KasirDetail::select(['kasir_id', 'subtotal'])
                        ->where('kasir_id', $kasir->id)
                        ->get();
                    $total_tagihan = $tagihan_pasien->sum('subtotal');

                    //                  Update total tagihan dan grand total pasien
                    $kasir->update([
                        'total_tagihan' => $total_tagihan,
                        'status_pembayaran' => 'belum dibayar',
                        'status' => 'belum dilayani',
                    ]);
                }

                //              Update periksa dokter
                $periksaDokter->update($attr);
=======
                // Cek rekam medis pasien
                $rm = RekamMedis::where('pasien_id', $periksaDokter->pasien_id)->first();
                $poli = Poli::find($periksaDokter->poli_id);
>>>>>>> fb18979 (kamis 3 februari)

                // Cek rekam medis pasien
                $rm = RekamMedis::select(['id', 'pasien_id'])
                    ->where('pasien_id', $periksaDokter->pasien_id)
                    ->first();
                $poli = Poli::select(['id', 'nama'])
                    ->where('id', $pemeriksaan_detail->poli_id)
                    ->first();
                $nama_dokter = Auth::user()->dokter->nama;

                // dd($rm);
                // Insert rekam medis pasien
                $rekam_medis_pasien = RekamMedisPasien::create([
                    'rekam_medis_id' => $rm->id,
                    'tujuan' => $poli->nama,
                    'dokter' => $nama_dokter,
                    'subjektif' => $attr['subjektif'],
                    'objektif' => $attr['objektif'],
                    'assesment' => $attr['assesment'],
                    'plan' => $attr['plan'] ?? '',
                    'keluhan' => $attr['keluhan'],
                    'tanggal' => now()
                ]);

<<<<<<< HEAD
                //              Update activity user / dokter
                $nama_poli = $poli->nama;
                activity('melakukan pemeriksaan pasien ' . $this->namaPasien($periksaDokter->pasien_id) . ' di poli ' . $nama_poli);

                // Update posisi pasien
                $posisi_pasien_rajal = PosisiPasienRajal::select(['id', 'pemeriksaan_id', 'status'])
                    ->where('pemeriksaan_id', $pemeriksaan->id)
                    ->first();
                if ($posisi_pasien_rajal->status == 'periksa dokter') {
                    $posisi_pasien_rajal->update([
                        'status' => 'proses kasir'
                    ]);

                    $posisi_detail_pasien_rajal_last = PosisiDetailPasienRajal::where('posisi_pasien_rajal_id', $posisi_pasien_rajal->id)->latest('waktu');
                    $posisi_detail_pasien_rajal_last->update(['status' => 'selesai']);

                    $aktifitas = "Pasien selesai diperiksa di poli {$nama_poli} oleh {$nama_dokter}";
                    $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                        'posisi_pasien_rajal_id' => $posisi_pasien_rajal->id,
                        'aktifitas' => $aktifitas,
                        'waktu' => now(),
                        'keterangan' => 'checkout',
                        'status' => 'selesai'
                    ]);
                }
=======
                $pasien = Pasien::find($periksaDokter->pasien_id);
                $nama_pasien = $pasien->nama;
                $nama_poli = $poli->nama;

                activity('melakukan pemeriksaan pasien ' . $nama_pasien . ' di poli ' . $nama_poli);
>>>>>>> fb18979 (kamis 3 februari)
            }
        );
        return response()->json([
            'message' => 'Terimakasih atas layanan yang anda berikan. Semoga anda sehat selalu',
            'url' => route('dokter.daftar-pasien')
        ], 200);
    }

<<<<<<< HEAD
    // Update signa 1 untuk obat pasien
=======
>>>>>>> fb18979 (kamis 3 februari)
    public function signa1(Request $request)
    {
        $attr = $request->all();

        $data['obat_pasien_periksa_rajal'] = ObatPasienRajal::find($attr['obat_pasien_periksa_rajal_id']);

        $data['obat_pasien_periksa_rajal']->update([
            'signa1' => $attr['signa1']
        ]);

        return response()->json([
            'status' => true
        ], 200);
    }

<<<<<<< HEAD
    // Update signa 2 untuk obat pasien
=======
>>>>>>> fb18979 (kamis 3 februari)
    public function signa2(Request $request)
    {
        $attr = $request->all();

        $data['obat_pasien_periksa_rajal'] = ObatPasienRajal::find($attr['obat_pasien_periksa_rajal_id']);

        $data['obat_pasien_periksa_rajal']->update([
            'signa2' => $attr['signa2']
        ]);

        return response()->json([
            'status' => true
        ], 200);
    }
<<<<<<< HEAD

    public function searchDiagnosa(Request $request)
    {
        $diagnosa = $request->get('diagnosa');
        $periksa_dokter_id = $request->get('periksa_dokter_id');
        $data = $this->dokterRepository->searchDiagnosa($diagnosa, $periksa_dokter_id);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item"
                onclick="pilihDiagnosa(`' . $item->id . '`,`' . $periksa_dokter_id . '`,`' . route('dokter.change-diagnosa') . '`)">' . $item->nama . ' </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function changeDiagnosa(Request $request)
    {
        $attr = $request->all();
        $diagnosa_pasien_rajal = DiagnosaPasienRajal::create($attr);

        return response()->json([
            'message' => 'Diagnosa berhasil ditambahkan',
            'url' => route('dokter.diagnosa-pasien', $attr['periksa_dokter_id'])
        ], 200);
    }

    public function diagnosaPasien($periksa_dokter_id)
    {
        $data = $this->dokterRepository->diagnosaPasien($periksa_dokter_id);
        $output = '';
        foreach ($data as $key => $item) {
            $output .= '
            <tr>
                <td>' . $item->kode . '</td>
                <td>' . $item->nama . '</td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" autocomplete="off" onkeyup="diagnosaBagian(`' . route('dokter.diagnosa-pasien.bagian', $item->id) . '`,this)" name="bagian"
                                value="' . $item->bagian . '" style="width: 15em" class="form-control">
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <button onclick="hapusDiagnosa(`' . route('dokter.diagnosa-pasien.hapus', $item->id) . '`,`' . $item->id . '`,`' . $item->periksa_dokter_id . '`)" class="btn btn-danger btn-sm"><em class="icon ni ni-trash-alt"></em></button>
                </td>
            </tr>
        ';
        }

        return response()->json([
            'output' => $output
        ], 200);
    }

    public function hapusDiagnosa(DiagnosaPasienRajal $diagnosaPasienRajal)
    {
        $diagnosaPasienRajal->delete();
        return response()->json([
            'message' => 'Diagnosa pasien berhasil dihapus'
        ], 200);
    }
    public function diagnosaBagian(DiagnosaPasienRajal $diagnosaPasienRajal, Request $request)
    {
        $diagnosaPasienRajal->update([
            'bagian' => $request->bagian
        ]);
        return response()->json([
            'message' => 'Bagian diagnosa berhasil diupdate'
        ], 200);
    }

    public function searchTindakan(Request $request)
    {
        $tindakan = $request->get('tindakan');
        $periksa_dokter_id = $request->get('periksa_dokter_id');
        $data = $this->dokterRepository->searchTindakan($tindakan, $periksa_dokter_id);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item"
                onclick="pilihTindakan(`' . $item->id . '`,`' . $periksa_dokter_id . '`,`' . route('dokter.change-tindakan') . '`)">' . $item->nama . ' </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function changeTindakan(Request $request)
    {
        $attr = $request->all();
        $diagnosa_pasien_rajal = TindakanPasienRajal::create($attr);

        return response()->json([
            'message' => 'Tindakan berhasil ditambahkan',
            'url' => route('dokter.tindakan-pasien', $attr['periksa_dokter_id'])
        ], 200);
    }

    public function tindakanPasien($periksa_dokter_id)
    {
        $data = $this->dokterRepository->tindakanPasien($periksa_dokter_id);
        $output = '';
        foreach ($data as $key => $item) {
            $output .= '
            <tr>
                <td>' . $item->kode . '</td>
                <td>' . $item->nama . '</td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" autocomplete="off" onkeyup="tindakanBagian(`' . route('dokter.tindakan-pasien.bagian', $item->id) . '`,this)" name="bagian"
                                value="' . $item->bagian . '" style="width: 15em" class="form-control">
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <button onclick="hapusTindakan(`' . route('dokter.tindakan-pasien.hapus', $item->id) . '`,`' . $item->id . '`,`' . $item->periksa_dokter_id . '`)" class="btn btn-danger btn-sm"><em class="icon ni ni-trash-alt"></em></button>
                </td>
            </tr>
        ';
        }

        return response()->json([
            'output' => $output
        ], 200);
    }

    public function hapusTindakan(TindakanPasienRajal $tindakanPasienRajal)
    {
        $tindakanPasienRajal->delete();
        return response()->json([
            'message' => 'Tindakan pasien berhasil dihapus'
        ], 200);
    }

    public function tindakanBagian(TindakanPasienRajal $tindakanPasienRajal, Request $request)
    {
        $tindakanPasienRajal->update([
            'bagian' => $request->bagian
        ]);
        return response()->json([
            'message' => 'Bagian tindakan berhasil diupdate'
        ], 200);
    }
=======
>>>>>>> fb18979 (kamis 3 februari)
}
