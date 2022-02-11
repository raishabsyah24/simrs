<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PendaftaranInterface;
use Illuminate\Support\Facades\DB;

class PendaftaranRepository implements PendaftaranInterface
{
    public function pasienHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->selectRaw('
            p.id as pemeriksaan_id, p.kode as kode_pasien, p.no_rekam_medis, pasien.nama as nama_pasien, pasien.nik, pasien.tanggal_lahir, pasien.jenis_kelamin, poli.nama as tujuan, dokter.nama as nama_dokter, kp.nama as kategori_pasien, p.created_at , p.no_sep, pd.poli_id, p.tanggal

        ')
            ->join('pasien', 'pasien.id', '=', 'p.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->leftJoin('faskes as f', 'f.id', '=', 'p.faskes_id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'p.id')
            ->join('poli', 'poli.id', '=', 'pd.poli_id')
            ->join('dokter', 'dokter.id', '=', 'pd.dokter_id')
            ->whereDate('p.tanggal', tanggalSekarang())
            ->orderByDesc('p.created_at');
    }

    public function dokterPoli(int $poli_id)
    {
        return DB::table('dokter_poli as dp')
            ->selectRaw('
                d.id, d.nama as nama_dokter
            ')
            ->join('dokter as d', 'd.id', '=', 'dp.dokter_id')
            ->join('poli as p', 'p.id', '=', 'dp.poli_id')
            ->where('dp.poli_id', $poli_id)
            ->where('d.status', '=', 'aktif')
            ->get();
    }

    public function riwayatKunjunganTerakhirPasien(int $pasien_id)
    {
        return DB::table('rekam_medis as rm')
            ->selectRaw('
                p.id, rmp.tanggal as tanggal_periksa, rmp.tujuan, rmp.dokter, p.nik, p.nama, p.tanggal_lahir, p.jenis_kelamin,
                p.no_hp, p.alamat
            ')
            ->join('pasien as p', 'p.id', '=', 'rm.pasien_id')
            ->join('rekam_medis_pasien as rmp', 'rmp.rekam_medis_id', '=', 'rm.id')
            ->where('rm.pasien_id', $pasien_id)
            ->latest('rmp.tanggal')
            ->first();
    }

    public function totalPasienBpjs()
    {
        return DB::table('pemeriksaan as p')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->whereDate('p.tanggal', tanggalSekarang())
            ->where('kp.nama', 'bpjs')
            ->count();
    }

    public function totalPasienUmum()
    {
        return DB::table('pemeriksaan as p')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->whereDate('p.tanggal', tanggalSekarang())
            ->where('kp.nama', 'umum')
            ->count();
    }

    public function totalPasienAsuransi()
    {
        return DB::table('pemeriksaan as p')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->whereDate('p.tanggal', tanggalSekarang())
            ->where('kp.nama', 'asuransi')
            ->count();
    }
}
