<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObatPasienRajal extends Model
{
    use HasFactory,
        SoftDeletes;
    use HasFactory,
        SoftDeletes;

    protected $table = 'obat_pasien_periksa_rajal';

    protected $fillable = [
        'periksa_dokter_id', 'obat_apotek_id', 'signa', 'harga_obat', 'komposisi', 'jumlah', 'subtotal'
    ];
}
