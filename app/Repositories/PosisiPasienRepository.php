<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PosisiPasienInterface;

class PosisiPasienRepository implements PosisiPasienInterface
{
    public function pasienRajal(int $pemeriksaan_id)
    {
        return DB::table('posisi_detail_pasien_rajal AS pdpr')
            ->selectRaw('
            pdpr.keterangan, pdpr.waktu, pdpr.status, pdpr.aktifitas
        ')
            ->join('posisi_pasien_rajal AS ppr', 'ppr.id', '=', 'pdpr.posisi_pasien_rajal_id')
            ->join('pemeriksaan AS pe', 'pe.id', '=', 'ppr.pemeriksaan_id')
            ->where('ppr.pemeriksaan_id', $pemeriksaan_id)
            ->get();
    }
}
