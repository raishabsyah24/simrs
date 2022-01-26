<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DokterInterface;

class DokterRepository implements DokterInterface
{
    public function dokterPoli(int $poli_id)
    {
        return DB::table('dokter_poli as dp')
            ->selectRaw('
        
        ')
            ->join('dokter as d', 'd.id', '=', 'dp.dokter_id')
            ->join('poli as p', 'p.id', '=', 'dp.poli_id')
            ->where('dp.poli_id', $poli_id)
            ->get();
    }
}
