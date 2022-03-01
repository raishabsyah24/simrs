<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';

    protected $fillable = [
        'nurse_station_id',
        'kode_kamar',
        'kode_bed',
        'kelas',
        'tarif',
        'fasilitas',
        'status_bed',
    ];
}
