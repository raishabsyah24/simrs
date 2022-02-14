<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'foto', 'no_hp', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
