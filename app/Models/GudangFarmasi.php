<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GudangFarmasi extends Model
{
    use HasFactory;
    protected $table = "po",
    $fillable = [
        'no_po',
        'tanggal_po',
        'nama_po',
        'perusahaan_tujuan',
        'pembuat_po',
        'kode_barang',
        'jumlah_barang',
        'keterangan',
        'status_po',
        'tanggal_diterima',
        'penerimaan_po',
        'disetujui'

    ];


    // public static function getId()
    // {
    //     return $getId = DB::table('po')->orderBy('id')->take(1)->get();
    // }
}
