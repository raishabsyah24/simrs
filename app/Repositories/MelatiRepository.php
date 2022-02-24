<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\MelatiInterface;

class MelatiRepository implements MelatiInterface
{

    public function perencanaan_permintaan()
    {
        return DB::table('gudang_permintaan as gp')
        ->selectRaw('gp.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('gp.created_at');
    }

    public function input_permintaan()
    {
        return DB::table('gudang_permintaan as gp')
        ->selectRaw('gp.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('gp.created_at');
    }

    public function perencanaan_permintaan_atk()
    {
        return DB::table('gudang_atk_permintaan as gap')
        ->selectRaw('gap.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('gap.created_at');
    }

    public function input_permintaan_atk()
    {
        return DB::table('gudang_atk_permintaan as gap')
        ->selectRaw('gap.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('gap.created_at');
    }

    public function perencanaan_permintaan_obat()
    {
        return DB::table('gudang_apotek as ga')
        ->selectRaw('ga.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('ga.created_at');
    }

    public function input_permintaan_obat()
    {
        return DB::table('gudang_apotek as ga')
        ->selectRaw('ga.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('ga.created_at');
    }

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
