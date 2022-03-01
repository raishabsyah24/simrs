<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LayananInterface;

class LayananRepository implements LayananInterface
{
    public function all()
    {
        return DB::table('layanan as l')
            ->selectRaw('
            l.id, l.kode, l.nama, l.tarif, l.keterangan, l.created_at, l.parent_id
        ')
            ->whereNotIn('l.id', [2, 3]);
    }
}
