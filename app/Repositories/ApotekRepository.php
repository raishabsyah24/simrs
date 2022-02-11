<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotekBpjs()
    {
        return DB::table('pemeriksaan as pa')
            ->selectRaw('
               DISTINCT pa.id, pn.nama as nama_pasien, pn.tanggal_lahir, kp.nama as kategori_pasien, 
               pa.no_rekam_medis, pl.spesialis, dr.nama as nama_dokter, pd.status_diperiksa, pa.status as status_pemeriksaan
            ')
            ->join('pasien as pn', 'pn.id', '=', 'pa.pasien_id')
            ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', '=', 'pa.id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pa.kategori_pasien')
            ->join('dokter as dr', 'dr.id', '=', 'pm.dokter_id')
            ->where('kp.id', '=', 1);
        // ->paginate(12);
    }

    public function antrianApotekUmum()
    {
        return DB::table('pemeriksaan as pa')
            ->selectRaw('
                DISTINCT pa.id, pn.nama as nama_pasien, pn.tanggal_lahir, kp.nama as kategori_pasien, pa.no_rekam_medis,
                pl.spesialis, dr.nama as nama_dokter, pd.status_diperiksa, pa.status as status_pemeriksaan, pa.created_at
            ')
            ->join('pasien as pn', 'pn.id', '=', 'pa.pasien_id')
            ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', '=', 'pa.id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pa.kategori_pasien')
            ->join('dokter as dr', 'dr.id', '=', 'pm.dokter_id')
            ->where('kp.id', '>=', 2)
            ->orderByDesc('pa.created_at');
    }

    public function obatApotek()
    {
        return DB::table('obat_pasien_periksa_rajal as op')
            ->selectRaw('op.id, harga_jual as price_sale, harga_obat as price
            ')
            ->join('obat_apotek as ap', 'ap.id', '=', 'op.obat_apotek_id')
            ->get();
    }

    public function pasienApotek(int $periksa_dokter_id)
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
                pd.id periksa_dokter_id, rm.kode, p.nama as nama_pasien, p.tanggal_lahir, p.alamat as alamat_pasien,
                kn.nama as kategori_pasien
            ')
            ->join('pasien as p', 'p.id', '=', 'pd.pasien_id')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'p.id')
            ->join('kategori_pasien as kn', 'kn.id', '=', 'kn.id')
            ->where('pd.id', $periksa_dokter_id)
            ->first();
    }
}
