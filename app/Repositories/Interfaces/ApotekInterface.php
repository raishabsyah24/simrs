<?php

namespace App\Repositories\Interfaces;

interface ApotekInterface
{
    public function antrianApotekBpjs();
    public function obatBpjs(int $pemeriksaan_id);
    public function antrianApotekUmum();
    public function obatUmum(int $pemeriksaan_id);
    public function obatApotek();
    public function pasienApotek(int $periksa_dokter_id);
    public function identitasPasien(int $periksa_dokter_id);
    public function laporan($tanggal_awal, $tanggal_akhir);
}
