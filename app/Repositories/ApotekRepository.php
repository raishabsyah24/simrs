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
            ->where('k.status', 'sudah dilayani')
            ->where('k.status_pembayaran', '!=', 'belum dibayar')
            ->whereDate('pe.tanggal', tanggalSekarang());
    }

    public function antrianApotekUmum()
    {
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                DISTINCT pe.id as pemeriksaan_id, pe.no_rekam_medis, ps.nama as nama_pasien, ps.tanggal_lahir,
                        do.nama as nama_dokter, pl.spesialis, kt.nama as kategori_pasien, pe.status as status_pemeriksaan,
                        po.id as periksa_dokter_id
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
            ->where('ka.status', 'sudah dilayani')
            ->where('ka.status', '!=', 'lunas')
            ->whereDate('pe.tanggal', tanggalSekarang());
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

    public function obatBpjs(int $pemeriksaan_id)
    {
        return DB::table('obat_pasien_periksa_rajal as ob')
            ->selectRaw('
                   DISTINCT ob.id as obat_pasien_rajal_id, o.nama_generik, ob.jumlah, ob.signa1, ob.signa2,
                   ob.harga_obat, ob.subtotal
                ')
            ->join('obat_apotek as ot', 'ot.id', '=', 'ob.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'ot.obat_id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'ob.periksa_dokter_id')
            ->join('pasien as pe', 'pe.id', '=', 'pd.pasien_id')
            ->where('pd.id', '=', $pemeriksaan_id)
            ->get();
    }

    public function pasienBpjs(int $pemeriksaan_id)
    {
        return  DB::table('pemeriksaan as pi')
            ->selectRaw('
        DISTINCT pi.id as pemeriksaan_id, cr.id as kasir_id, ps.nama as nama_pasien, ps.tanggal_lahir,
             ps.jenis_kelamin, ps.golongan_darah, pi.no_rekam_medis,dk.nama as nama_dokter, pl.spesialis,
             pi.tanggal as tanggal_pemeriksaan, pi.status as status_pemeriksaan
        ')
            ->join('pasien as ps', 'pi.pasien_id', '=', 'ps.id')
            ->join('kasir as cr', 'cr.pemeriksaan_id', '=', 'cr.id')
            ->join('dokter as dk', 'dk.id', '=', 'dk.id')
            ->join('dokter_poli as dp', 'dp.dokter_id', 'dk.id')
            ->join('poli as pl', 'dp.dokter_id', '=', 'pl.id')
            ->where('ps.id', '=', $pemeriksaan_id)
            ->first();
    }

    public function obatUmum(int $pemeriksaan_id)
    {
        return DB::table('obat_pasien_periksa_rajal as ob')
            ->selectRaw('
                   DISTINCT ob.id as obat_pasien_rajal_id, o.nama_generik, ob.jumlah, ob.signa1, ob.signa2,
                   ob.harga_obat, ob.subtotal
                ')
            ->join('obat_apotek as ot', 'ot.id', '=', 'ob.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'ot.obat_id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'ob.periksa_dokter_id')
            ->join('pasien as pe', 'pe.id', '=', 'pd.pasien_id')
            ->where('pd.id', '=', $pemeriksaan_id)
            ->get();
    }

    public function pasienUmum(int $pemeriksaan_id)
    {
        return  DB::table('pemeriksaan as pi')
            ->selectRaw('
            DISTINCT pi.id as pemeriksaan_id, cr.id as kasir_id, ps.nama as nama_pasien, ps.tanggal_lahir,
                ps.jenis_kelamin, ps.golongan_darah, pi.no_rekam_medis,dk.nama as nama_dokter, pl.spesialis,
                pi.tanggal as tanggal_pemeriksaan, pi.status as status_pemeriksaan
    ')
            ->join('pasien as ps', 'pi.pasien_id', '=', 'ps.id')
            ->join('kasir as cr', 'cr.pemeriksaan_id', '=', 'cr.id')
            ->join('dokter as dk', 'dk.id', '=', 'dk.id')
            ->join('dokter_poli as dp', 'dp.dokter_id', 'dk.id')
            ->join('poli as pl', 'dp.dokter_id', '=', 'pl.id')
            ->where('pi.id', '=', $pemeriksaan_id)
            ->first();
    }
}
