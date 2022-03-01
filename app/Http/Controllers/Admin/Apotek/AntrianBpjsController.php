<?php

namespace App\Http\Controllers\Admin\Apotek;

use PDF;
use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\ObatApotek;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use App\Models\ObatPasienRajal;
use App\Models\PemeriksaanDetail;
use App\Models\PosisiPasienRajal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\PosisiDetailPasienRajal;
use App\Repositories\Interfaces\ApotekInterface;
use App\Repositories\Interfaces\DokterInterface;

class AntrianBpjsController extends Controller
{
    private $apotekRepository;
    private $dokterRepository;
    public  $perPage = 12;

    public function __construct(ApotekInterface $apotekRepository, DokterInterface $dokterRepository)
    {
        $this->apotekRepository = $apotekRepository;
        $this->dokterRepository = $dokterRepository;
    }

    public function index()
    {
        $data = $this->apotekRepository->antrianApotekBpjs()->paginate($this->perPage);
        // return $data;
        $kategori = $this->kategoriPasien();
        $total = $this->apotekRepository->antrianApotekBpjs()->count();
        $title = 'Antrian Bpjs';
        $per_page = $this->perPage;
        $badge = $this->badge();
        return view('admin.apotek.antrian_bpjs._daftar-antrian', compact(
            'title',
            'data',
            'badge',
            'total',
            'kategori',
            'per_page'
        ));
    }

    function _fetchData(Request $request)
    {
        if ($request->ajax()) {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = $this->apotekRepository->antrianApotekBpjs()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('pe.id', 'like', '%' . $q . '%')
                        ->orWhere('pe.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('p.nama', 'like', '%' . $q . '%');
                })
                ->when(!empty($dari) && !empty($sampai) ?? false, function ($query) use ($dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->whereBetween('pe.created_at', [$dari, $sampai]);
                })
                ->when(!empty($dari) && !empty($sampai && $q) ?? false, function ($query) use ($q, $dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->where('pe.id', 'like', '%' . $q . '%')
                        ->orWhere('pe.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('p.nama', 'like', '%' . $q . '%')
                        ->whereBetween('pe.created_at', [$dari, $sampai]);
                })
                ->orderBy('pe.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.apotek.antrian_bpjs._fetch-data_bpjs', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }

    public function detailPasienBpjs($pasien_bpjs)
    {
        $pasien = DB::table('periksa_dokter as po')
            ->selectRaw('
                        po.id as periksa_dokter_id, ps.nama as nama_pasien, ps.tanggal_lahir, ps.alamat, 
                        pm.no_rekam_medis, do.nama as nama_dokter, pl.nama as spesialis, kt.nama as kategori_pasien,
                        pm.id as pemeriksaan_id,pm.tanggal as tanggal_pemeriksaan, pm.status as status_pemeriksaan
                    ')
            ->join('pemeriksaan_detail as pd', 'pd.id', '=', 'po.pemeriksaan_detail_id')
            ->join('pemeriksaan as pm', 'pm.id', '=', 'pd.pemeriksaan_id')
            ->join('pasien as ps', 'ps.id', '=', 'po.pasien_id')
            ->join('dokter as do', 'do.id', '=', 'po.dokter_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('kategori_pasien as kt', 'kt.id', '=', 'pm.kategori_pasien')
            ->where('po.id', $pasien_bpjs)
            ->first();

        $obat = DB::table('obat_pasien_periksa_rajal as ob')
            ->selectRaw('
                   DISTINCT ob.id as obat_pasien_rajal_id, o.nama_generik, ob.jumlah, ob.signa1, ob.signa2,
                   ob.harga_obat, ob.subtotal
                ')
            ->join('obat_apotek as ot', 'ot.id', '=', 'ob.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'ot.obat_id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'ob.periksa_dokter_id')
            ->join('pasien as pe', 'pe.id', '=', 'pd.pasien_id')
            ->where('pd.id', '=', $pasien_bpjs)
            ->get();
        $title = 'Detail Pasien';
        $head  = 'Informasi Pasien';
        return view('admin.apotek.antrian_bpjs._pasien-bpjs', compact(
            'title',
            'head',
            'pasien',
            'obat'
        ));
    }

    public function obatApotek($pemeriksaan_id, $periksa_dokter_id)
    {
        // Pemeriksaan pasien bpjs
        $pasien = $this->apotekRepository->identitasPasien($periksa_dokter_id);

        // Obat pasien bpjs
        $obat = $this->apotekRepository->obatBpjs($pemeriksaan_id);

        // Update pasien checkin apotek
        $posisi_pasien = PosisiPasienRajal::where('pemeriksaan_id', $pemeriksaan_id)->firstOrFail();
        if ($posisi_pasien->status == 'proses obat') {
            $posisi_pasien->update([
                'status' => 'proses apotek'
            ]);

            $user = auth()->user()->name;
            $aktifitas = "Pasien sedang diproses di apotek oleh {$user}";
            $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                'posisi_pasien_rajal_id' => $posisi_pasien->id,
                'aktifitas' => $aktifitas,
                'waktu' => now(),
                'keterangan' => 'checkin',
                'status' => 'proses'
            ]);
        }

        return view('admin.apotek.antrian_bpjs._proses-pasien-bpjs', compact(
            'pasien',
            'obat',
            'periksa_dokter_id'
        ));
    }

    public function prosesPasienBpjs(Request $request)
    {
        $attr = $request->all();

        DB::transaction(
            function () use ($attr) {
                // Query pemeriksaa
                $pemeriksaan = Pemeriksaan::find($attr['pemeriksaan_id']);

                // Query pemeriksaan detail
                $pemeriksaan_detail = PemeriksaanDetail::where('pemeriksaan_id', '=', $pemeriksaan->id)
                    ->first();

                // Query obat pasien
                $periksaDokter = PeriksaDokter::where('pemeriksaan_detail_id', '=', $attr['periksa_dokter_id'])->first();
                $obatPasien = ObatPasienRajal::where('periksa_dokter_id', '=', $periksaDokter->id)
                    ->get();

                // Update status pemeriksaan
                $pemeriksaan->update([
                    'status' => 'selesai'
                ]);

                // Update status pemeriksaan detail
                $pemeriksaan_detail->update([
                    'status' => 'selesai'
                ]);

                // Update status obat pasien rajal
                foreach ($obatPasien as $obat) {
                    $obat->update([
                        'status' => 'sudah diterima'
                    ]);
                }

                // Query checkout pasien apotek
                $posisi_pasien = PosisiPasienRajal::where('pemeriksaan_id', $pemeriksaan->id)->firstOrFail();

                if ($posisi_pasien->status == 'proses apotek') {
                    $posisi_pasien->update([
                        'status' => 'selesai'
                    ]);

                    // Update pasien checkout apotek
                    $res = PosisiDetailPasienRajal::where('posisi_pasien_rajal_id', $posisi_pasien->id)->latest('waktu');
                    $res->update([
                        'status' => 'selesai'
                    ]);

                    $user = auth()->user()->name;
                    $aktifitas = "Pasien telah selesai di apotek oleh {$user}";
                    $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                        'posisi_pasien_rajal_id' => $posisi_pasien->id,
                        'aktifitas' => $aktifitas,
                        'waktu' => now(),
                        'keterangan' => 'checkout',
                        'status' => 'selesai'
                    ]);
                }
            }
        );
        return response()->json([
            'message' => 'Status berhasil di ubah!',
            'url'     => route('data.antrian.bpjs')
        ], 200);
    }

    public function previewPDF($pemeriksaan_id, $periksa_dokter_id)
    {
        $query = $this->apotekRepository->identitasPasien($periksa_dokter_id);
        $drug  = $this->apotekRepository->obatBpjs($pemeriksaan_id);
        // return $query;
        return view('admin.apotek.antrian_bpjs.pdf.hasil', compact(
            'query',
            'drug'
        ));
    }
}
