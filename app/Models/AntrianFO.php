<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianFO extends Model
{
    use HasFactory;

    protected $table = 'antrian_fo';
    protected $fillable = [
        'antrian_fo_id','tujuan','tanggal','nomor_antrian','kategori_pasien'
    ];


}
