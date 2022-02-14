<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ObatApotek;
use App\Models\ObatPasienRajal;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanDetail;
use App\Models\PeriksaDokter;
use Illuminate\Support\Facades\Auth;
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
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotekBpjs()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('rm.kode', 'like', '%' . $q . '%')
                        ->orWhere('pd.pasien_id', 'like', '%' . $q . '%')
                        ->orWhere('pn.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('pl.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('pd.dokter_id', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
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
        $pasien = DB::table('pemeriksaan as pi')
            ->selectRaw('
                    pi.id as pemeriksaan_id, cr.id as kasir_id
            ')
            ->join('kasir as cr', 'cr.pemeriksaan_id', '=', 'cr.id')
            ->join('pasien as ps', 'pi.pasien_id', '=', 'ps.id')
            ->first();
        // dd($pasien);
        $title = 'Detail Pasien';
        $head  = 'Informasi Pasien';
        return view('admin.apotek.antrian_bpjs._pasien-bpjs', compact(
            'title',
            'head',
            'pasien'
        ));
    }

    public function obatApotek($approve_pasien)
    {
        // $pasien = DB::table('pemeriksaan as pd')
        //     ->selectRaw('
        //     DISTINCT pd.id as pemeriksaan_id, pn.id as pasien_id, pn.nama as nama_pasien, pn.email, pn.tempat_lahir,
        //     pn.tanggal_lahir, pn.jenis_kelamin, pn.golongan_darah, pn.alamat, pd.no_rekam_medis,
        //     pd.status as status_menerima, pk.no_antrian_apotek, pk.tanggal as tanggal_periksa,
        //     pl.spesialis, dr.nama as nama_dokter, kp.nama as kategori_pasien
        // ')
        //     ->join('pasien as pn', 'pn.id', '=', 'pd.pasien_id')
        //     ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', '=', 'pd.id')
        //     ->join('periksa_dokter as pk', 'pk.id', '=', 'pm.dokter_id')
        //     ->join('dokter as dr', 'dr.id', '=', 'pm.dokter_id')
        //     ->join('poli as pl', 'pl.id', '=', 'pm.poli_id')
        //     ->join('kategori_pasien as kp', 'kp.id', '=', 'pd.kategori_pasien')
        //     ->where('pd.id', '=', $approve_pasien)
        //     ->first();
        $pasien = DB::table('pemeriksaan as pd')
            ->selectRaw('pd.id as pemeriksaan_id')
            ->where('pd.id', '=', $approve_pasien)
            ->get();
        // return  $pasien;

        $data = DB::table('pemeriksaan as pd')
            ->selectRaw('
                 DISTINCT pd.id as pemeriksaan_id, oa.nama_generik
            ')
            ->leftJoin('obat_pasien_periksa_rajal as or', 'or.id', '=', 'or.id')
            ->leftJoin('obat_apotek as op', 'op.id', '=', 'or.obat_apotek_id')
            ->leftJoin('obat as oa', 'oa.id', '=', 'op.obat_id')
            ->rightJoin('periksa_dokter as pe', 'pe.id', '=', 'or.periksa_dokter_id')
            ->get();
        $badge = $this->badge();
        return view('admin.apotek.antrian_bpjs._proses_pasien', compact(
            'data',
            'pasien',
            'badge'
        ));
    }

    public function prosesPasienBpjs(Request $request, $pemeriksaan_id)
    {
        $attr = $request->all();
        $tipe = $request->pasien_id;

        DB::transaction(
            function () use ($attr, $pemeriksaan_id) {
                $pemeriksaan = Pemeriksaan::find($pemeriksaan_id);

                $pemeriksaan_detail = PemeriksaanDetail::find($pemeriksaan_id);
                $pasien = Pasien::find($pemeriksaan->pasien_id);
                // dd($pasien);

                // Cari id pemeriksaan
                $pemeriksaan_id = Pemeriksaan::where('id', '=', $pemeriksaan_id)
                    // ->orWhere('pasien_id', '=', $pasien)
                    ->first();

                // Update ke table pemeriksaan
                $pemeriksaan->update([
                    'status' => 'Lunas'
                ]);

                // Cari id pemeriksaan detail
                $pemeriksaan_detail_id = PemeriksaanDetail::where('pemeriksaan_id', '=', $pemeriksaan_id)->first();


                // Update ke table pemeriksaan detail
                $pemeriksaan_detail->update([
                    'status' => 'Lunas'
                ]);
            }
        );
        return response()->json([
            'message' => 'Status berhasil di ubah!'
        ], 200);
    }
}
