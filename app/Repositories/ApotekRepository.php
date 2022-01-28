<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotek()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
                rm.kode, pn.tanggal_lahir, pd.pasien_id, pl.spesialis, pn.nama as nama_pasien,
                pm.dokter_id, do.nama, rp.dokter, pa.kategori_pasien, kp.nama as kategori_pasien
            ')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'pd.pasien_id')
            ->join('pasien as pn', 'pn.id', '=', 'pd.pasien_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('pemeriksaan_detail as pm', 'pm.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('dokter as do', 'do.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('rekam_medis_pasien as rp', 'rp.id', '=', 'rp.rekam_medis_id')
            ->join('pemeriksaan as pa', 'pa.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pd.pemeriksaan_detail_id')
            ->paginate(12);
        // ->get();
    }
}
