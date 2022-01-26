<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ObatNurseStation extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'obat_nurse_station';

    protected $fillable = [
        'obat_id', 'nurse_station_id', 'harga_jual', 'harga_beli', 'stok', 'minimal_stok', 'maksimal_stok', 'satuan_id', 'ed'
    ];
}
