<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotekBpjs()
    {
        // return DB::table('pemeriksaan as pa')
        //     ->selectRaw('
        //     DISTINCT pa.id as pemeriksaan_id, pn.nama as nama_pasien, pn.tanggal_lahir, kp.nama as kategori_pasien, 
        //        pa.no_rekam_medis, pl.spesialis, dr.nama as nama_dokter, pd.status_diperiksa,
        //        ks.id as kasir_id, ks.status as status_pembayaran, pd.id as periksa_dokter_id, pa.status, pd.id as periksa_dokter_id
        //     ')
        //     ->join('pasien as pn', 'pn.id', '=', 'pa.pasien_id')
        //     ->join('kasir as ks', 'ks.pemeriksaan_id', '=', 'ks.id')
        //     ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', '=', 'pa.id')
        //     ->join('periksa_dokter as pd', 'pd.id', '=', 'pd.pemeriksaan_detail_id')
        //     ->join('poli as pl', 'pl.id', '=', 'pm.poli_id')
        //     ->join('kategori_pasien as kp', 'kp.id', '=', 'pa.kategori_pasien')
        //     ->join('dokter as dr', 'dr.id', '=', 'pd.dokter_id')
        //     ->where('kp.id', '=', 1)
        //     ->where('ks.status', '=', 'belum dibayar');
        // ->paginate(12);
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                   DISTINCT  pe.id as pemeriksaan_id, pe.no_rekam_medis, p.nama as nama_pasien, p.tanggal_lahir,
                     pl.spesialis, po.id as periksa_dokter_id, do.nama as nama_dokter, kn.nama as kategori_pasien, 
                     pe.status
            ')
            ->join('kasir as k', 'k.pemeriksaan_id', '=', 'pe.id')
            ->join('pasien as p', 'p.id', '=', 'pe.pasien_id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('periksa_dokter as po', 'po.pemeriksaan_detail_id', '=', 'pd.id')
            ->join('dokter as do', 'po.dokter_id', '=', 'do.id')
            ->join('poli as pl', 'pd.poli_id', '=', 'pl.id')
            ->join('kategori_pasien as kn', 'pe.kategori_pasien', '=', 'kn.id')
            ->where('kn.nama', 'bpjs')
            // ->where('pe.status', 'belum selesai')
            ->where('po.status_diperiksa', '=', 'sudah diperiksa')
            ->orderBy('pe.created_at', 'asc');
        // ->where('pd.status', 'belum selesai');
        // ->where('k.status', '!=', 'belum dibayar');
    }

    public function antrianApotekUmum()
    {
        // return DB::table('pemeriksaan as pa')
        //     ->selectRaw('
        //         DISTINCT pa.id, pn.nama as nama_pasien, pn.tanggal_lahir, kp.nama as kategori_pasien, pa.no_rekam_medis,
        //         pl.spesialis, dr.nama as nama_dokter, pd.status_diperiksa, pa.status as status_pemeriksaan, pa.created_at
        //     ')
        //     ->join('pasien as pn', 'pn.id', '=', 'pa.pasien_id')
        //     ->join('pemeriksaan_detail as pm', 'pm.pemeriksaan_id', '=', 'pa.id')
        //     ->join('periksa_dokter as pd', 'pd.id', '=', 'pd.pemeriksaan_detail_id')
        //     ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
        //     ->join('kategori_pasien as kp', 'kp.id', '=', 'pa.kategori_pasien')
        //     ->join('dokter as dr', 'dr.id', '=', 'pm.dokter_id')
        //     ->where('kp.id', '>=', 2)
        //     ->orderByDesc('pa.created_at');
        return DB::table('pemeriksaan as pe')
            ->selectRaw('pe.id')
            ->first();
    }

    public function obatApotek()
    {
        return DB::table('obat_pasien_periksa_rajal as op')
            ->selectRaw('
                      DISTINCT op.id, harga_jual as price_sale, harga_obat as price,
                        ob.nama_generik, op.jumlah
            ')
            ->join('obat_apotek as ap', 'ap.id', '=', 'op.obat_apotek_id')
            ->leftJoin('obat as ob', 'ap.obat_id', '=', 'ob.id')
            ->where('ob.id', '=', 1)
            ->first();
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
