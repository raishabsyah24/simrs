<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DokterInterface;

class DokterRepository implements DokterInterface
{
    public function daftarPasienDokterSpesialis(int $poli_id)
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            DISTINCT pd.id as periksa_dokter_id, pas.id as pasien_id,  poli.id as poli_id, d.id as dokter_id, pas.nama as nama_pasien, pas.jenis_kelamin, pd.status_diperiksa, pas.tanggal_lahir, pd.no_antrian_periksa,  d.nama as nama_dokter
        ')
            ->join('pemeriksaan_detail as pede', 'pede.id', '=', 'pd.pemeriksaan_detail_id')
            ->join('pasien as pas', 'pas.id', '=', 'pd.pasien_id')
            ->join('dokter as d', 'd.id', '=', 'pede.dokter_id')
            ->join('poli', 'poli.id', '=', 'pede.poli_id')
            ->join('dokter_poli as dp', 'dp.poli_id', '=', 'pd.poli_id')
            ->where('pede.poli_id', $poli_id)
            ->whereDate('pd.tanggal', now())
            ->orderBy('pd.no_antrian_periksa');
    }

    public function dokterSpesialis(int $dokter_id)
    {
        return DB::table('dokter_poli as dp')
            ->selectRaw('
            d.id as dokter_id, d.nama as nama_dokter, p.id as poli_id, p.nama as nama_poli,
            p.spesialis
        ')
            ->join('dokter as d', 'd.id', '=', 'dp.dokter_id')
            ->join('poli as p', 'p.id', '=', 'dp.poli_id')
            ->where('dp.dokter_id', $dokter_id)
            ->first();
    }

    public function rekamMedisPasienPeriksa(int $periksa_dokter_id)
    {
        return DB::table('periksa_dokter as pd')
            ->selectRaw('
            rmp.tanggal as tanggal_periksa, rmp.tujuan as poli, rmp.dokter, rmp.subjektif, rmp.objektif, rmp.assesment, rmp.plan, rmp.keterangan 
        ')
            ->join('pasien as p', 'p.id', '=', 'pd.pasien_id')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'pd.pasien_id')
            ->join('rekam_medis_pasien as rmp', 'rmp.rekam_medis_id', '=', 'rm.id')
            ->where('pd.id', $periksa_dokter_id)
            ->get();
    }

    public function identitasPasien(int $pasien_id)
    {
        return DB::table('pasien as p')
            ->selectRaw('
            p.nama as nama_pasien, p.tanggal_lahir, p.jenis_kelamin, p.alamat, p.no_hp,
            kp.nama as kategori_pasien, rm.kode as no_rekam_medis, p.golongan_darah, pem.id as pemeriksaan_id
        ')
            ->join('periksa_dokter as pd', 'pd.pasien_id', 'p.id')
            ->join('pemeriksaan_detail as pede', 'pede.id', 'pd.pemeriksaan_detail_id')
            ->join('pemeriksaan as pem', 'pem.id', 'pede.pemeriksaan_id')
            ->join('kategori_pasien as kp', 'kp.id', 'pem.kategori_pasien')
            ->join('rekam_medis as rm', 'rm.pasien_id', 'p.id')
            ->where('p.id', $pasien_id)
            ->first();
    }

<<<<<<< HEAD

    public function searchObat($nama_obat, $periksa_dokter_id)
=======
    public function searchObat(string $nama_obat, int $periksa_dokter_id = null)
>>>>>>> a0eeaf3e3d9e3a47c8f7d9355eb2fdf480c232bd
    {
        return DB::table('obat as o')
            ->selectRaw('
            oa.id, o.nama_paten, o.nama_generik, oa.harga_jual, oa.minimal_stok, oa.stok
        ')
            ->join('obat_apotek as oa', 'oa.obat_id', '=', 'o.id')
            ->when($nama_obat ?? false, function ($query) use ($nama_obat) {
                return $query->where('o.nama_paten', 'like', '%' . $nama_obat . '%')
                    ->orWhere('o.nama_generik', 'like', '%' . $nama_obat . '%');
            })
            ->where('oa.stok', '>=', 'oa.minimal_stok')
            ->get();
    }

    public function obatPasien(int $periksa_dokter_id)
    {
        return DB::table('obat_pasien_periksa_rajal as or')
            ->selectRaw('
<<<<<<< HEAD
           or.id as obat_id, o.nama_generik, or.jumlah, or.signa, or.subtotal, or.harga_obat, or.id as obat_pasien_periksa_rajal_id, pr.tanggal as tanggal_periksa
=======
            o.nama_generik, or.jumlah, or.signa1, or.signa2, or.subtotal, or.harga_obat, or.id as obat_pasien_periksa_rajal_id,or.periksa_dokter_id
>>>>>>> a0eeaf3e3d9e3a47c8f7d9355eb2fdf480c232bd
        ')
            ->join('obat_apotek as oa', 'oa.id', '=', 'or.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'oa.obat_id')
            ->join('periksa_dokter as pr', 'pr.id', '=', 'or.periksa_dokter_id')
            ->where('or.periksa_dokter_id', $periksa_dokter_id)
            ->get();
    }

    public function semuaDokter()
    {
        return DB::table('dokter as d')
            ->selectRaw('
            d.id, d.nama, d.email, d.no_str, d.no_hp, d.foto, d.status, d.tanggal_bergabung, d.created_at, p.spesialis, p.nama as nama_poli
        ')
            ->join('dokter_poli as dp', 'dp.dokter_id', '=', 'd.id')
            ->join('poli as p', 'dp.poli_id', '=', 'p.id')
            ->whereNull('d.deleted_at');
    }

    public function searchDiagnosa(string $nama_diagnosa, int $periksa_dokter_id = null)
    {
        return DB::table('diagnosa as d')
            ->selectRaw('
            d.id, d.kode, d.nama
        ')
            ->when($nama_diagnosa ?? false, function ($query) use ($nama_diagnosa) {
                return $query->where('d.kode', 'like', '%' . $nama_diagnosa . '%')
                    ->orWhere('d.nama', 'like', '%' . $nama_diagnosa . '%');
            })
            ->get();
    }

    public function diagnosaPasien(int $periksa_dokter_id)
    {
        return DB::table('diagnosa_pasien_rajal as dpr')
            ->selectRaw('
            dpr.id, dpr.periksa_dokter_id, d.kode, d.nama, dpr.bagian
        ')
            ->join('diagnosa as d', 'd.id', '=', 'dpr.diagnosa_id')
            ->where('dpr.periksa_dokter_id', $periksa_dokter_id)
            ->get();
    }

    public function searchTindakan(string $nama_tindakan, int $periksa_dokter_id = null)
    {
        return DB::table('tindakan as t')
            ->selectRaw('
            t.id, t.kode, t.nama
        ')
            ->when($nama_tindakan ?? false, function ($query) use ($nama_tindakan) {
                return $query->where('t.kode', 'like', '%' . $nama_tindakan . '%')
                    ->orWhere('t.nama', 'like', '%' . $nama_tindakan . '%');
            })
            ->get();
    }

    public function tindakanPasien(int $periksa_dokter_id)
    {
        return DB::table('tindakan_pasien_rajal as tpr')
            ->selectRaw('
            tpr.id, tpr.periksa_dokter_id, t.kode, t.nama, tpr.bagian
        ')
            ->join('tindakan as t', 't.id', '=', 'tpr.tindakan_id')
            ->where('tpr.periksa_dokter_id', $periksa_dokter_id)
            ->get();
    }

    public function periksaPoliStation($periksa_poli_station_id)
    {
        return DB::table('periksa_poli_station as pps')
            ->selectRaw('
            pps.tb, pps.bb, pps.td, pps.su, pps.bmi
        ')
            ->join('periksa_dokter as pd', 'pd.periksa_poli_station_id', '=', 'pps.id')
            ->where('pps.id', $periksa_poli_station_id)
            ->first();
    }

    public function posisiPasienRajal(int $pemeriksaan_id)
    {
        return DB::table('posisi_pasien_rajal AS ppr')
            ->selectRaw('
                ppr.id
            ')
            ->join('pemeriksaan AS pe', 'pe.id', '=', 'ppr.pemeriksaan_id')
            ->where('ppr.pemeriksaan_id', $pemeriksaan_id)
            ->first();
    }
}
