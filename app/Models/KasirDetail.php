<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KasirDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kasir_detail';

    protected $fillable = [
        'kasir_id',
        'jenis_tagihan',
        'subtotal',
        'tanggal_layanan'
    ];
}
