<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObatPasienRajal extends Model
{
    use HasFactory;

    protected $table = 'obat_pasien_periksa_rajal';

    protected $fillable = [
        'periksa_dokter_id', 'obat_apotek_id', 'signa1', 'signa2', 'harga_obat', 'komposisi', 'jumlah', 'subtotal'
    ];
}
