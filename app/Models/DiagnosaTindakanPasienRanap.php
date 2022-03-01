<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaTindakanPasienRanap extends Model
{
    use HasFactory;

    protected $table = 'diagnosa_tindakan_pasien_ranap';

    protected $fillable = [
        'visit_dokter_id', 'diagnosa', 'tindakan', 'bagian'
    ];
}
