<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public $bpjs_id = 1;
    public $kategori_bpjs = 'bpjs';
    public $umum_id = 2;
    public $kategori_umum = 'umum';
    public $asuransi_id = 3;
    public $kategori_asuransi = 'asuransi';
    public $poli_jantung = 1;
    public $poli_anak = 4;

    public function totalPasienRajalHariIni()
    {
        return DB::table('pemeriksaan')
            ->select('id')
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalBpjsHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->bpjs_id)
            ->where('kp.nama', $this->kategori_bpjs)
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalUmumHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->umum_id)
            ->where('kp.nama', $this->kategori_umum)
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalAsuransiHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->asuransi_id)
            ->where('kp.nama', $this->kategori_asuransi)
            ->whereDate('tanggal', now())
            ->count();
    }

    public function antrianPoliJantung()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            pd.id as periksa_dokter_id, pas.id as pasien_id,  poli.id as poli_id,
            d.id as dokter_id, pas.nama as nama_pasien, pas.jenis_kelamin, pd.status_diperiksa,
            pas.tanggal_lahir, pd.no_antrian_periksa,  d.nama as nama_dokter, pede.created_at
        ')
            ->join('pemeriksaan_detail as pede', 'pede.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('pasien as pas', 'pas.id', '=', 'pd.pasien_id')
            ->join('dokter as d', 'd.id', '=', 'pede.dokter_id')
            ->join('poli', 'poli.id', '=', 'pede.poli_id')
            ->join('dokter_poli as dp', 'dp.poli_id', '=', 'pd.poli_id')
            ->where('pede.poli_id', $this->poli_jantung)
            ->whereDate('pd.tanggal', now())
            ->orderBy('pd.no_antrian_periksa')
            ->get();
    }

    public function antrianPoliAnak()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            pd.id as periksa_dokter_id, pas.id as pasien_id,  poli.id as poli_id,
            d.id as dokter_id, pas.nama as nama_pasien, pas.jenis_kelamin, pd.status_diperiksa,
            pas.tanggal_lahir, pd.no_antrian_periksa,  d.nama as nama_dokter, pede.created_at
        ')
            ->join('pemeriksaan_detail as pede', 'pede.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('pasien as pas', 'pas.id', '=', 'pd.pasien_id')
            ->join('dokter as d', 'd.id', '=', 'pede.dokter_id')
            ->join('poli', 'poli.id', '=', 'pede.poli_id')
            ->join('dokter_poli as dp', 'dp.poli_id', '=', 'pd.poli_id')
            ->where('pede.poli_id', $this->poli_anak)
            ->whereDate('pd.tanggal', now())
            ->orderBy('pd.no_antrian_periksa')
            ->get();
    }
}
