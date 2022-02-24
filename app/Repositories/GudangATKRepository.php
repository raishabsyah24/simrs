<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\GudangATKInterface;

class GudangATKRepository implements GudangATKInterface
{
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

    public function searchObat(string $nama_obat)
    {
        return DB::table('obat as o')
            ->selectRaw('
            o.nama_paten, o.nama_generik
        ')
            ->when($nama_obat ?? false, function ($query) use ($nama_obat) {
                return $query->where('o.nama_paten', 'like', '%' . $nama_obat . '%')
                    ->orWhere('o.nama_generik', 'like', '%' . $nama_obat . '%');
            })
            ->get();
    }
}
