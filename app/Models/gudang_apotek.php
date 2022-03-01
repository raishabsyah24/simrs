<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudang_apotek extends Model
{
    use HasFactory;
    protected $table = "gudang_apotek",
    $fillable = [
        'no_permintaan',
        'nama_unit',
        'tanggal_permintaan',
        'jenis_permintaan',
        'item_permintaan',
        'jumlah',
        'stok_lama',
    ];
}
