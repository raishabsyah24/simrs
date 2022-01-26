<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPasien extends Model
{
    use HasFactory;
    protected $table = 'kategori_pasien';

    protected $fillable = [
        'nama', 'status'
    ];
}
