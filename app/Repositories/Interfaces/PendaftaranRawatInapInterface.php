<?php

namespace App\Repositories\Interfaces;

interface PendaftaranRawatInapInterface
{
    public function pasienHariIni();
    public function nurseStation(int $nurse_station_id);
    // public function dokterPoli(int $poli_id);
    // public function totalPasienBpjs();
    // public function totalPasienUmum();
    // public function totalPasienAsuransi();
    // public function riwayatKunjunganTerakhirPasien(int $pasien_id);
}
