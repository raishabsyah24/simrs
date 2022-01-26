<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'obat';

    protected $fillable = [
        'kode', 'kategori_obat', 'nama_paten', 'nama_generik', 'komposisi', 'status'
    ];
}
