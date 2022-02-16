<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ApotekInterface;
use App\Repositories\Interfaces\DokterInterface;

class AntrianUmumController extends Controller
{
    private $apotekRepository;
    private $dokterRepository;
    public  $perPage = 12;


    public function __construct(ApotekInterface $apotekRepository, DokterInterface $dokterRepository)
    {
        $this->apotekRepository = $apotekRepository;
        $this->dokterRepository = $dokterRepository;
    }

    public function umum()
    {
        $data = $this->apotekRepository->antrianApotekUmum()->paginate($this->perPage);
        // return $data;
        $total = $this->apotekRepository->antrianApotekUmum()->count();
        $title = 'Antrian Umum';
        $perPage = $this->perPage;
        $badge = $this->badge();
        return view('admin.apotek.antrian_umum.index', compact(
            'data',
            'title',
            'perPage',
            'total',
            'badge'
        ));
    }

    function _fetchUmum(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotekUmum()
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
            return view('admin.apotek.antrian_umum._fetch-umum', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }

    public function detailPasienUmum($pasien_umum)
    {
        // $pasien = DB::table('pemeriksaan as pd')
        //     ->selectRaw(
        //         'DISTINCT pn.id, pd.no_rekam_medis, pn.nama as nama_pasien, pn.email, pn.jenis_kelamin, pn.tempat_lahir, 
        //               pn.tanggal_lahir, pn.golongan_darah, pn.alamat, pd.status as status_pemeriksaan, pk.no_antrian_apotek, pk.tanggal as tanggal_periksa, pk.status_diperiksa, pl.spesialis, dr.nama as nama_dokter, kp.nama as kategori_pasien
        //              '
        //     )
        //     ->join('pasien as pn', 'pn.id', '=', 'pd.pasien_id')
        //     ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', 'pm.id')
        //     ->join('periksa_dokter as pk', 'pk.id', '=', 'pm.dokter_id')
        //     ->join('poli as pl', 'pm.pemeriksaan_id', '=', 'pl.id')
        //     ->join('dokter as dr', 'pm.dokter_id', '=', 'dr.id')
        //     ->join('kategori_pasien as kp', 'kp.id', '=', 'pd.kategori_pasien')
        //     ->where('pd.id', '=', $pasien_umum)
        //     ->first();
        // // return $pasien;
        $title = 'Detail Pasien';
        // $head  = 'Informasi Pasien';
        return view('admin.apotek.antrian_umum._pasien-umum', compact(
            'title'
        ));
    }
}
