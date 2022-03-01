<?php

namespace App\Repositories\Interfaces;

interface PendaftaranRawatJalanInterface
{

    public function pasienHariIni();
    public function dokterPoli(int $poli_id);
    public function totalPasienBpjs();
    public function totalPasienUmum();
    public function totalPasienAsuransi();
    public function riwayatKunjunganTerakhirPasien(int $pasien_id);
}
