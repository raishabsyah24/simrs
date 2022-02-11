<?php

namespace App\Repositories\Interfaces;

interface ApotekInterface
{
    public function antrianApotekBpjs();
    public function antrianApotekUmum();
    public function obatApotek();
    public function pasienApotek(int $periksa_dokter_id);
}
