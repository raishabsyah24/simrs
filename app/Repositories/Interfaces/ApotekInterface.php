<?php

namespace App\Repositories\Interfaces;

interface ApotekInterface
{
    public function antrianApotekBpjs();
    public function obatApotek();
    public function pasienApotek(int $periksa_dokter_id);
}
