<?php

namespace App\Repositories\Interfaces;

interface KasirInterface
{
    public function kasir();

    public function identitasPasien(int $kasir_id);

    public function daftarLayanan(int $kasir_id);

    public function obatPasienRajal(int $kasir_id);

    public function posisiPasien(int $kasir_id);
}
