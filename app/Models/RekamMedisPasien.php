<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class RekamMedisPasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekam_medis_pasien';

    protected $fillable = [
        'rekam_medis_id', 'tujuan', 'dokter', 'tanggal', 'subjektif', 'objektif', 'assesment', 'plan', 'keterangan', 'keluhan'
    ];
}
