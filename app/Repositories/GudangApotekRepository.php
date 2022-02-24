<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\GudangApotekInterface;

class GudangApotekRepository implements GudangApotekInterface
{
    // public function input_po()
    // {
    //     return DB::table('po as p')
    //         ->selectRaw('p.id, no_po, tanggal_po, nama_po, perusahaan_tujuan, pembuat_po, kode_barang, jumlah_barang, keterangan,status_po, penerimaan_po, tanggal_diterima, disetujui')
    //         ->orderByDesc('p.created_at');
    // }

    // public function perencanaan_po()
    // {
    //     return DB::table('po as p')
    //     ->selectRaw('p.id, no_po, tanggal_po, nama_po, perusahaan_tujuan, pembuat_po, kode_barang, jumlah_barang, keterangan, status_po, penerimaan_po, tanggal_diterima, disetujui')
    //     ->orderByDesc('p.created_at');
    // }

    public function perencanaan_permintaan()
    {
        return DB::table('gudang_apotek as ga')
        ->selectRaw('ga.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('ga.created_at');
    }

    public function input_permintaan()
    {
        return DB::table('gudang_apotek as ga')
        ->selectRaw('ga.id, no_permintaan, nama_unit, tanggal_permintaan, jenis_permintaan, item_permintaan, jumlah, stok_lama')
        ->orderByDesc('ga.created_at');
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
