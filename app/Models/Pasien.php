<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'pasien';

    protected $fillable = [
        'kode', 'no_bpjs', 'nik', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama',
        'golongan_darah', 'pekerjaan', 'status_perkawinan', 'email', 'no_hp', 'alamat'
    ];
}
