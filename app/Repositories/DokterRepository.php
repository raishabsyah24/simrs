<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DokterInterface;

class DokterRepository implements DokterInterface
{
    public function daftarPasien()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            pd.id, pas.nama as nama_pasien, d.nama as nama_dokter, poli.nama as nama_poli
        ')
            ->join('pemeriksaan_detail as pede', 'pede.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('pasien as pas', 'pas.id', '=', 'pd.pasien_id')
            ->join('dokter as d', 'd.id', '=', 'pede.dokter_id')
            ->join('poli', 'poli.id', '=', 'pede.poli_id')
            ->get();
    }
}
