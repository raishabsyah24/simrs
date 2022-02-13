<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterPoli extends Model
{
    use HasFactory;

    protected $table = 'dokter_poli';

    public $timestamps = false;

    protected $fillable = [
        'dokter_id', 'poli_id',
    ];
}
