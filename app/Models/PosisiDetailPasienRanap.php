<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiDetailPasienRanap extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'posisi_detail_pasien_ranap';

    protected $fillable = [
        'posisi_pasien_ranap_id', 'keterangan', 'waktu', 'status', 'aktifitas'
    ];
}
