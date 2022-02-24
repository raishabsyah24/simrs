<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudangAtkPermintaan extends Model
{
    use HasFactory;
    protected $table = "gudang_atk_permintaan",
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
