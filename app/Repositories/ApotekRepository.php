<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApotekInterface;

class ApotekRepository implements ApotekInterface
{
    public function antrianApotekBpjs()
    {
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                   DISTINCT  pe.id as pemeriksaan_id, pe.no_rekam_medis, p.nama as nama_pasien, p.tanggal_lahir,
                     pl.spesialis, po.id as periksa_dokter_id, do.nama as nama_dokter, kn.nama as kategori_pasien, 
                     pe.status as status_pemeriksaan
            ')
            ->join('kasir as k', 'k.pemeriksaan_id', '=', 'pe.id')
            ->join('pasien as p', 'p.id', '=', 'pe.pasien_id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('periksa_dokter as po', 'po.pemeriksaan_detail_id', '=', 'pd.id')
            ->join('dokter as do', 'po.dokter_id', '=', 'do.id')
            ->join('poli as pl', 'pd.poli_id', '=', 'pl.id')
            ->join('kategori_pasien as kn', 'pe.kategori_pasien', '=', 'kn.id')
            ->where('kn.nama', 'bpjs')
            ->where('po.status_diperiksa', '=', 'sudah diperiksa')
            ->where('pd.status', 'selesai')
            ->whereDate('pe.tanggal', tanggalSekarang())
            ->orderBy('pe.created_at', 'asc');
        // ->where('k.status', '!=', 'belum dibayar');
    }

    public function antrianApotekUmum()
    {
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                DISTINCT pe.id as pemeriksaan_id, pe.no_rekam_medis, ps.nama as nama_pasien, ps.tanggal_lahir,
                        do.nama as nama_dokter, pl.spesialis, kt.nama as kategori_pasien, pe.status
                ')
            ->join('kasir as ka', 'ka.pemeriksaan_id', '=', 'pe.id')
            ->join('pasien as ps', 'pe.pasien_id', '=', 'ps.id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('periksa_dokter as po', 'po.pemeriksaan_detail_id', '=', 'pd.id')
            ->join('dokter as do', 'po.dokter_id', '=', 'do.id')
            ->join('poli as pl', 'pd.poli_id', '=', 'pl.id')
            ->join('kategori_pasien as kt', 'pe.kategori_pasien', '=', 'kt.id')
            ->where('pd.status', 'selesai')
            ->where('po.status_diperiksa', 'sudah diperiksa')
            ->where('kt.nama', 'umum')
            ->whereDate('pe.tanggal', tanggalSekarang())
            ->orderBy('pe.created_at', 'asc');
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
