<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'dokter';

    protected $fillable = [
        'user_id', 'nik', 'nama', 'spesialis', 'no_str', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'email', 'alamat', 'foto', 'status', 'tanggal_bergabung', 'tanggal_non_aktif'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
