<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawabPasien extends Model
{
    use HasFactory;
    protected $table = 'penanggung_jawab_pasien';

    protected $fillable = [
        'pemeriksaan_id',
        'nama',
        'nik',
        'jenis_kelamin',
        'no_hp',
        'hubungan_dengan_pasien',
        'alamat',
    ];
}
