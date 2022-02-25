<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AntrianInterface;
use Illuminate\Support\Facades\DB;

class AntrianRepository implements AntrianInterface
{
    public function antrian_fo_umum()
    {
        return DB::table('antrian_fo as a')
            ->selectRaw('a.id,a.antrian_fo_id,a.tanggal,a.kategori_pasien,a.nomor_antrian')
            ->whereDate('a.tanggal', tanggalSekarang())
            ->orderByDesc('a.created_at');
    }

    
}
