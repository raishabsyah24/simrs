<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PemeriksaanDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemeriksaan_detail';

    protected $fillable = [
        'pemeriksaan_id', 'poli_id', 'layanan_id', 'status'
    ];
}
