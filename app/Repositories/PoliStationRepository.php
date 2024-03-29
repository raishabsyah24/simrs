<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PoliStationInterface;

class PoliStationRepository implements PoliStationInterface
{
    public function pasienHariIni()
    {
        return DB::table('periksa_poli_station as pps')
            ->selectRaw('
            pps.id as periksa_poli_station_id, p.nama as nama_pasien, p.tanggal_lahir, po.nama as nama_poli, pps.status_diperiksa, p.jenis_kelamin, pps.tanggal as tanggal_periksa, pe.no_rekam_medis, pps.created_at, pe.id as pemeriksaan_id, d.nama as nama_dokter
        ')
            ->join('pemeriksaan_detail as pede', 'pede.id', '=', 'pps.pemeriksaan_detail_id')
            ->join('pemeriksaan as pe', 'pe.id', '=', 'pede.pemeriksaan_id')
            ->join('periksa_dokter as perdok', 'perdok.periksa_poli_station_id','=','pps.id')
            ->join('pasien as p', 'p.id', '=', 'pps.pasien_id')
            ->join('poli as po', 'po.id', '=', 'pede.poli_id')
            ->join('dokter as d', 'd.id', '=', 'perdok.dokter_id')
            ->where('pps.tanggal', tanggalSekarang());
    }

    public function detailPasien(int $periksa_poli_station_id)
    {
        return DB::table('periksa_poli_station as pps')
            ->selectRaw('
            p.nama, pps.tb, pps.bb, pps.su, pps.bmi, p.tanggal_lahir, pps.td, pd.pemeriksaan_id
        ')
            ->join('pasien as p', 'p.id', '=', 'pps.pasien_id')
            ->join('pemeriksaan_detail as pd', 'pd.id', '=', 'pps.pemeriksaan_detail_id')
            ->where('pps.id', $periksa_poli_station_id)
            ->first();
    }
}
