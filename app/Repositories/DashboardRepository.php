<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public $bpjs_id = 1;
    public $kategori_bpjs = 'bpjs';
    public $umum_id = 2;
    public $kategori_umum = 'umum';
    public $asuransi_id = 3;
    public $kategori_asuransi = 'asuransi';

    public function totalPasienRajalHariIni()
    {
        return DB::table('pemeriksaan')
            ->select('id')
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalBpjsHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->bpjs_id)
            ->where('kp.nama', $this->kategori_bpjs)
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalUmumHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->umum_id)
            ->where('kp.nama', $this->kategori_umum)
            ->whereDate('tanggal', now())
            ->count();
    }
    public function totalPasienRajalAsuransiHariIni()
    {
        return DB::table('pemeriksaan as p')
            ->select('p.id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'p.kategori_pasien')
            ->where('p.kategori_pasien', $this->asuransi_id)
            ->where('kp.nama', $this->kategori_asuransi)
            ->whereDate('tanggal', now())
            ->count();
    }

    public function totalPasienSpesialisSaya(int $user_id)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $dokter = DB::table('dokter')->select('id')
            ->where('user_id', $user_id)
            ->first();

        if ($dokter)
            return DB::table('periksa_dokter as pd')
                ->selectRaw('pd.id, pd.dokter_id, pd.tanggal')
                ->where('dokter_id', $dokter->id)
                ->whereMonth('pd.tanggal', $bulan)
                ->whereYear('pd.tanggal', $tahun)
                ->count();
    }

    public function dataPasienSpesialisSaya(int $user_id)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $dokter = DB::table('dokter')->select('id')
            ->where('user_id', $user_id)
            ->first();

        if ($dokter)
            return DB::table('periksa_dokter as pd')
                ->selectRaw("
                DATE(tanggal) AS tanggal,
                DATE_FORMAT(tanggal, '%d') AS hari,
                COUNT(*) AS pasien
            ")
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->groupBy('tanggal', 'hari')
                ->orderBy('tanggal', 'ASC')
                ->get();
    }
}
