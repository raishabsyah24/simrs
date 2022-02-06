<?php

namespace App\Repositories\Interfaces;

interface DokterInterface
{
    public function daftarPasienDokterSpesialis(int $poli_id);

    public function dokterSpesialis(int $dokter_id);

    public function rekamMedisPasienPeriksa(int $periksa_dokter_id);

    public function identitasPasien(int $pasien_id);

<<<<<<< HEAD
    public function searchObat(string $nama_obat, int $periksa_dokter_id = null);

    public function obatPasien(int $periksa_dokter_id);

    public function semuaDokter();
=======
    // public function dokterPoli(int $poli_id);

<<<<<<< HEAD
    public function tenagaMedis();

    public function searchObat(string $nama_obat, int $periksa_dokter_id = null);

    public function obatPasien(int $periksa_dokter_id);
=======
    // public function tenagaMedis();
>>>>>>> b684bee (sabtu 29 Januari 2022 00:28)
>>>>>>> 5cb95e8 (29 Januari 2022 00:38)
}
