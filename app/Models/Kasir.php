<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';

    protected $fillable = [
        'pemeriksaan_id',
        'deposit_awal',
        'tanggal_pembayaran',
        'tanggal_deposit',
        'total_tagihan',
        'pajak',
        'diskon',
        'admin',
        'metode_pembayaran',
        'deposit_akhir',
        'grand_total',
        'status',
    ];
}
