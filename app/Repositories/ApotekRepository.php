<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotekBpjs()
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            DISTINCT pd.id, rm.kode, pn.tanggal_lahir, pd.pasien_id, pl.spesialis, pn.nama as nama_pasien,
                pm.dokter_id, do.nama, rp.dokter, pa.kategori_pasien, kp.nama as kategori_pasien,
                pn.alamat as alamat_pasien, kp.status as status_pasien
            ')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'pd.pasien_id')
            ->join('pasien as pn', 'pn.id', '=', 'pd.pasien_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('pemeriksaan_detail as pm', 'pm.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('dokter as do', 'do.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('rekam_medis_pasien as rp', 'rp.id', '=', 'rp.rekam_medis_id')
            ->join('pemeriksaan as pa', 'pa.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pd.pemeriksaan_detail_id')
            ->where('kp.id', 1,)
            ->paginate(12);
    }

    public function obatApotek()
    {
        return DB::table('obat_pasien_periksa_rajal as op')
            ->selectRaw('op.id, harga_jual as price_sale, harga_obat as price
            ')
            ->join('obat_apotek as ap', 'ap.id', '=', 'op.obat_apotek_id')
            ->get();
    }

    public function pasienApotek($periksa_dokter_id)
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
