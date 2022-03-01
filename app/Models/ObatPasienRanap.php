<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatPasienRanap extends Model
{
    use HasFactory;

    protected $table = 'obat_pasien_ranap';

    protected $fillable = [
        'obat_nurse_station_id',
        'visit_dokter_id',
        'signa1',
        'signa2',
        'jumlah',
        'harga',
        'subtotal',
        'waktu_diberikan',
        'status_diberikan',
    ];
}
