<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ObatInterface;

class ObatRepository implements ObatInterface
{
    public function all()
    {
        return DB::table('obat as l')
            ->selectRaw('
            l.id, l.kode, l.nama_paten, l.nama_generik, l.komposisi, l.status
        ');
    }
}
