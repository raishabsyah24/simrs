<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanPasienRajal extends Model
{
    use HasFactory;

    protected $table = 'tindakan_pasien_rajal';

    protected $fillable = [
        'periksa_dokter_id', 'tindakan_id', 'bagian'
    ];
}
