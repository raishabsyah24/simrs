<?php

namespace App\Repositories\Interfaces;

interface DokterInterface
{
    public function daftarPasienDokterSpesialis(int $user_id);

    public function dokterSpesialis(int $dokter_id);

    public function rekamMedisPasienPeriksa(int $pasien_id);

    public function identitasPasien(int $pasien_id);

    public function searchObat(string $nama_obat, int $periksa_dokter_id = null);

    public function obatPasien(int $periksa_dokter_id);

    public function semuaDokter();

    public function searchDiagnosa(string $nama_diagnosa, int $periksa_dokter_id = null);

    public function diagnosaPasien(int $periksa_dokter_id);

    public function searchTindakan(string $nama_tindakan, int $periksa_dokter_id = null);

    public function tindakanPasien(int $periksa_dokter_id);

    public function periksaPoliStation($periksa_poli_station_id);

    public function posisiPasienRajal(int $pemeriksaan_id);
}
