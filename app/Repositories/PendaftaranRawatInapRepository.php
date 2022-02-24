<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PendaftaranRawatInapInterface;
use Illuminate\Support\Facades\DB;

class PendaftaranRawatInapRepository implements PendaftaranRawatInapInterface
{
    public function pasienHariIni()
    {
        return DB::table('rawat_inap as ri')
            ->selectRaw('
            ri.id as rawat_inap_id, p.nama as nama_pasien, r.kode_kamar as nama_ruangan, r.kode_bed as nama_bed, kp.nama as kategori_pasien, ri.no_rekam_medis, p.tanggal_lahir, p.jenis_kelamin, ri.created_at as waktu_daftar, p.nik, ns.nama as nurse_station
        ')
            ->join('kamar_pasien as kapa', 'kapa.rawat_inap_id', '=', 'ri.id')
            ->join('ruangan as r', 'r.id', '=', 'kapa.ruangan_id')
            ->join('pasien as p', 'p.id', '=', 'ri.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'ri.kategori_pasien')
            ->join('nurse_station as ns', 'ns.id', '=', 'r.nurse_station_id')
            ->whereDate('ri.tanggal', tanggalSekarang())
            ->orderByDesc('ri.created_at');
    }


    public function nurseStation(int $nurse_station_id)
    {
        return DB::table('ruangan as r')
            ->selectRaw('
                r.id as ruangan_id, r.kode_kamar, r.kode_bed, r.status_bed, r.tarif, r.kelas
            ')
            ->where('r.nurse_station_id', $nurse_station_id)
            ->get();
    }
}
