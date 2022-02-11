<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\KasirInterface;

class KasirRepository implements KasirInterface
{
    public function kasir()
    {
        return DB::table('kasir as k')
            ->selectRaw('
                    k.id as kasir_id, pn.nama as nama_pasien, kg.nama as kategori_pasien, k.grand_total,
                    pe.no_rekam_medis
            ')
            ->join('kasir_detail as kd', 'kd.kasir_id', '=', 'k.id')
            ->join('pemeriksaan as pe', 'pe.id', '=', 'k.pemeriksaan_id')
            ->join('pasien as pn', 'pn.id', '=', 'pe.pasien_id')
            ->join('kategori_pasien as kg', 'kg.id', '=', 'pe.kategori_pasien')
            ->get();
    }
}
