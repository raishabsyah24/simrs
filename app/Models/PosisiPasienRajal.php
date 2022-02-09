<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiPasienRajal extends Model
{
    use HasFactory;

    protected $table = 'posisi_pasien_rajal';

    protected $fillable = [
        'pemeriksaan_id', 'status'
    ];
}
