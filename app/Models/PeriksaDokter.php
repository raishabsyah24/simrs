<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PeriksaDokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periksa_dokter';

    protected $fillable = [
        'pemeriksaan_detail_id', 'pasien_id', 'dokter_id', 'tanggal', 'subjektif', 'objektif', 'assesment', 'plan', 'status_diperiksa', 'informasi_tambahan',
        'no_antrian_periksa', 'no_antrian_apotek', 'poli_id', 'keluhan', 'status_lanjutan', 'alasan_dirujuk', 'jadwal_kontrol', 'diagnosa', 'periksa_poli_station_id'
    ];
}
