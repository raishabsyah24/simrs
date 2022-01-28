<?php

namespace App\Repositories\Interfaces;

interface DokterInterface
{
    public function daftarPasienDokterSpesialis(int $poli_id);

    public function dokterSpesialis(int $dokter_id);

    public function rekamMedisPasienPeriksa(int $periksa_dokter_id);

    public function indentitasPasien(int $pasien_id);

<<<<<<< HEAD
    public function dokterPoli(int $poli_id);

    public function tenagaMedis();
=======
    public function searchObat(string $nama_obat, int $periksa_dokter_id = null);

    public function obatPasien(int $periksa_dokter_id);
>>>>>>> 3703707 (malam jum'at 00:45)
}
