<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaPoliStation extends Model
{
    use HasFactory;

    protected $table = 'periksa_poli_station';

    protected $fillable = [
        'pemeriksaan_detail_id', 'pasien_id', 'tanggal', 'tb', 'bb',
        'td', 'su', 'bmi', 'status_diperiksa'
    ];
}
