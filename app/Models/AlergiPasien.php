<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlergiPasien extends Model
{
    use HasFactory;

    protected $table = 'alergi_pasien';

    protected $fillable = [
        'pemeriksaan_id',
        'rawat_inap_id',
        'alergi',
    ];
}
