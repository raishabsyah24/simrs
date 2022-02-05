<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterPoli extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dokter_poli';

    protected $fillable = [
        'dokter_id', 'poli_id',
    ];
}
