<?php

namespace App\Repositories\Interfaces;

interface PoliStationInterface
{
    public function pasienHariIni();

    public function detailPasien(int $periksa_poli_station_id);
}
