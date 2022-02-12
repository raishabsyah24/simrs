<?php

namespace App\Repositories\Interfaces;

interface DokterInterface
{
    public function daftarPasienDokterSpesialis(int $poli_id);

    public function dokterSpesialis(int $dokter_id);

    public function rekamMedisPasienPeriksa(int $periksa_dokter_id);

    public function identitasPasien(int $pasien_id);

<<<<<<< HEAD
    public function semuaDokter();

    public function searchObat(string $nama_obat, int $periksa_dokter_id);

    public function obatPasien(int $periksa_dokter_id);

=======
    public function searchObat(string $nama_obat, int $periksa_dokter_id = null);

    public function obatPasien(int $periksa_dokter_id);

    public function semuaDokter();

>>>>>>> a0eeaf3e3d9e3a47c8f7d9355eb2fdf480c232bd
    public function searchDiagnosa(string $nama_diagnosa, int $periksa_dokter_id = null);

    public function diagnosaPasien(int $periksa_dokter_id);

    public function searchTindakan(string $nama_tindakan, int $periksa_dokter_id = null);

    public function tindakanPasien(int $periksa_dokter_id);

    public function periksaPoliStation($periksa_poli_station_id);

    public function posisiPasienRajal(int $pemeriksaan_id);
}
