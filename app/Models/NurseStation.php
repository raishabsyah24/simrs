<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseStation extends Model
{
    use HasFactory;

    protected $table = 'nurse_station';

    protected $fillable = [
        'nama', 'lokasi', 'pic', 'dpjp'
    ];
}
