<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirRawatInapDetail extends Model
{
    use HasFactory;

    protected $table = 'kasir_rawat_inap_detail';

    protected $fillable = [
        'kasir_rawat_inap_id',
        'jenis_tagihan',
        'subtotal',
        'tanggal_layanan'
    ];
}
