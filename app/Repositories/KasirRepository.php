<?php

namespace App\Repositories;

use App\Repositories\Interfaces\KasirInterface;
use Illuminate\Support\Facades\DB;

class KasirRepository implements KasirInterface
{
    public $periksaDokter = 1;

    public function kasir()
    {
        return DB::table('kasir as k')
            ->selectRaw('
                k.id as kasir_id, pe.id as pemeriksaan_id, p.nama as nama_pasien,
                p.tanggal_lahir, kp.nama as kategori_pasien, k.status, p.no_hp,
                p.jenis_kelamin, k.status_pembayaran
            ')
            ->join('pemeriksaan as pe', 'pe.id', '=', 'k.pemeriksaan_id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('pasien as p', 'p.id', '=', 'pe.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pe.kategori_pasien')
            ->where('pd.status', 'selesai')
            ->orderBy('pe.created_at', 'desc');
    }

    public function identitasPasien(int $kasir_id)
    {
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                p.nama as nama_pasien, p.jenis_kelamin, p.nik, p.alamat,
                p.no_hp, p.tanggal_lahir, kp.nama as kategori_pasien, pe.no_rekam_medis,
                pe.created_at as tanggal_pendaftaran, pe.kategori_pasien as kategori_pasien_id, k.deposit_awal, k.tanggal_deposit
            ')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('kasir as k', 'k.pemeriksaan_id', '=', 'pe.id')
            ->join('pasien as p', 'p.id', '=', 'pe.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pe.kategori_pasien')
            ->where('pd.status', 'selesai')
            ->where('k.id', $kasir_id)
            ->first();
    }

    public function daftarLayanan(int $kasir_id)
    {
        return DB::table('pemeriksaan as pe')
            ->selectRaw('
                k.id as kasir_id, kd.jenis_tagihan, kd.subtotal, kd.tanggal_layanan
            ')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('kasir as k', 'k.pemeriksaan_id', '=', 'pe.id')
            ->join('kasir_detail as kd', 'kd.kasir_id', '=', 'k.id')
            ->where('pd.status', 'selesai')
            ->where('kd.kasir_id', $kasir_id)
            ->get();
    }

    public function obatPasienRajal(int $kasir_id)
    {
        $kasir = DB::table('pemeriksaan as pe')
            ->selectRaw('
                pede.id as periksa_dokter_id
            ')
            ->join('kasir as k', 'k.pemeriksaan_id', '=', 'pe.id')
            ->join('pemeriksaan_detail as pd', 'pd.pemeriksaan_id', '=', 'pe.id')
            ->join('periksa_dokter as pede', 'pede.pemeriksaan_detail_id', '=', 'pd.id')
            ->where('k.id', $kasir_id)
            ->where('pd.layanan_id', $this->periksaDokter)
            ->first();

        return DB::table('obat_pasien_periksa_rajal as oppr')
            ->selectRaw('
                o.nama_generik, oppr.jumlah, oppr.harga_obat, oppr.subtotal
            ')
            ->join('obat_apotek as oa', 'oa.id', '=', 'oppr.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'oa.obat_id')
            ->where('oppr.periksa_dokter_id', $kasir->periksa_dokter_id)
            ->get();
    }

    public function posisiPasien(int $kasir_id)
    {
        $kasir = DB::table('kasir as k')
            ->select('pemeriksaan_id')
            ->where('k.pemeriksaan_id', $kasir_id)
            ->first();

        return DB::table('posisi_pasien_rajal as ppr')
            ->selectRaw('
                id as posisi_pasien_rajal_id, pemeriksaan_id, status
            ')
            ->where('pemeriksaan_id', $kasir->pemeriksaan_id)
            ->first();
    }

    public function laporan($tanggal_awal, $tanggal_akhir)
    {
        return DB::table('kasir as k')
            ->selectRaw('
                p.nama as nama_pasien, k.tanggal_pembayaran, kp.nama as kategori_pasien, u.name as admin,
                k.total_tagihan, k.diskon, k.pajak, k.id as kasir_id, k.metode_pembayaran
            ')
            ->join('pemeriksaan as pe', 'pe.id', '=', 'k.pemeriksaan_id')
            ->join('pasien as p', 'p.id', '=', 'pe.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'pe.kategori_pasien')
            ->join('users as u', 'u.id', '=', 'k.admin')
            ->whereBetween('k.tanggal_pembayaran', [$tanggal_awal, $tanggal_akhir])
            ->where('k.status', 'sudah dilayani')
            ->where('k.status_pembayaran', '!=', 'belum dibayar');
    }
}
