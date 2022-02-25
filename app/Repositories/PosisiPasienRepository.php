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

    public function pasienRanap(int $rawat_inap_id)
    {
        return DB::table('posisi_detail_pasien_ranap AS pdpr')
            ->selectRaw('
            pdpr.keterangan, pdpr.waktu, pdpr.status, pdpr.aktifitas
        ')
            ->join('posisi_pasien_ranap AS ppr', 'ppr.id', '=', 'pdpr.posisi_pasien_ranap_id')
            ->join('rawat_inap AS r', 'r.id', '=', 'ppr.rawat_inap_id')
            ->where('ppr.rawat_inap_id', $rawat_inap_id)
            ->get();
    }
}
