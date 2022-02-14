<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemeriksaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'kode', 'no_sep', 'no_bpjs', 'faskes_id', 'pasien_id', 'kategori_pasien', 'tanggal', 'status', 'no_rekam_medis'
    ];
}
