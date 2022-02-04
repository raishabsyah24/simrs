<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PeriksaPoliStation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periksa_poli_station';

    protected $fillable = [
        'pemeriksaan_detail_id', 'pasien_id', 'tanggal', 'tb', 'bb', 'status_diperiksa'
    ];
}
