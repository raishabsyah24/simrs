<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiPasienRanap extends Model
{
    use HasFactory;

    protected $table = 'posisi_pasien_ranap';

    protected $fillable = [
        'rawat_inap_id', 'status'
    ];
}
