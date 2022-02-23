<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatInap extends Model
{
    use HasFactory;

    protected $table = 'rawat_inap';

    protected $fillable = [
        'kode',
        'no_sep',
        'no_bpjs',
        'no_asuransi',
        'no_rekam_medis',
        'pasien_id',
        'kategori_pasien',
        'posisi_pasien',
        'checkin',
        'checkout',
        'status',
        'durasi',
        'tanggal',
    ];
}
