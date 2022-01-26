<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PeriksaLab extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periksa_lab';

    protected $fillable = [
        'pemeriksaan_detail_id', 'periksa_dokter_id', 'pasien_id', 'tanggal', 'status_diperiksa', 'keterangan'
    ];
}
