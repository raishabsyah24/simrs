<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    use HasFactory;

    protected $table = 'asuransi';

    protected $fillable = [
        'pemeriksaan_id',
        'rawat_inap',
        'nama',
        'email',
        'no_telpon',
        'no_hp',
        'alamat',
    ];
}
