<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasir extends Model
{
    use HasFactory, SoftDeletes;

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
        'sisa_deposit',
        'status',
        'status_pembayaran',
        'sisa',
        'dibayar'
    ];

}
