<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotek()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
                rm.kode, pn.tanggal_lahir, pd.pasien_id, pl.spesialis, 
                pd.dokter_id,
        ')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'pd.pasien_id')
            ->join('pasien as pn', 'pn.id', '=', 'pd.pasien.id',)
            ->join('poli as pl', 'pl.id', '=', 'pl.spesialis')
            ->get();
    }
}
