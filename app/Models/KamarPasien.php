<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarPasien extends Model
{
    use HasFactory;

    protected $table = 'kamar_pasien';

    protected $fillable = [
        'rawat_inap_id',
        'ruangan_id',
        'checkin',
        'checkout',
        'tarif',
        'resiko_jatuh_pasien',
        'status',
        'dokter_ruangan',
        'dpjp',
    ];
}
