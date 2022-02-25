<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirRawatInap extends Model
{
    use HasFactory;

    protected $table = 'kasir_rawat_inap';

    protected $fillable = [
        'kode',
        'rawat_inap_id',
        'deposit_awal',
        'tanggal_deposit',
        'sisa_deposit',
        'tagihan',
        'pajak',
        'diskon',
        'admin',
        'dibayar',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];
}
