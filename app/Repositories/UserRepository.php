<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LayananInterface;

class LayananRepository implements LayananInterface
{
    public function all()
    {
        return DB::table('users as l')
            ->selectRaw('
            l.id, l.name, l.username, l.email, l.status
        ');
    }
}
