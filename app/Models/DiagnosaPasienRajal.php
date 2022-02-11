<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaPasienRajal extends Model
{
    use HasFactory;

    protected $table = 'diagnosa_pasien_rajal';

    protected $fillable = [
        'periksa_dokter_id', 'diagnosa_id', 'bagian'
    ];
}
