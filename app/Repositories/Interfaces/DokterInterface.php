<?php

namespace App\Repositories\Interfaces;

interface DokterInterface
{
    public function daftarPasienDokterSpesialis(int $poli_id);

    public function dokterSpesialis(int $dokter_id);

    public function rekamMedisPasienPeriksa(int $periksa_dokter_id);

    public function identitasPasien(int $pasien_id);


    public function tenagaMedis();

    public function searchObat(string $nama_obat, int $periksa_dokter_id);

    public function obatPasien(int $periksa_dokter_id);
    public function semuaDokter();

    // public function dokterPoli(int $poli_id);

}
