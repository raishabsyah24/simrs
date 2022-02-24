<?php

namespace App\Repositories\Interfaces;

interface PosisiPasienInterface
{
    public function pasienRajal(int $pemeriksaan_id);

    public function pasienRanap(int $rawat_inap_id);
}
