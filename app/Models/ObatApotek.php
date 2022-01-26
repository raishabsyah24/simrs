<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ObatApotek extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'obat_apotek';

    protected $fillable = [
        'obat_id', 'harga_jual', 'stok', 'minimal_stok', 'maksimal_stok', 'satuan_id', 'ed'
    ];
}
