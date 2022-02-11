<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AntrianPoliInterface;
use Illuminate\Support\Facades\DB;

class AntrianPoliRepository implements AntrianPoliInterface
{
    public $poli_jantung = 1;
    public $poli_anak = 4;

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
