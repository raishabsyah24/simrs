<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiDetailPasienRajal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'posisi_detail_pasien_rajal';

    protected $fillable = [
        'posisi_pasien_rajal_id', 'keterangan', 'waktu', 'status', 'aktifitas'
    ];
}
