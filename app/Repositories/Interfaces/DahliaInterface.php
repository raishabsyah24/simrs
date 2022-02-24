<?php

namespace App\Repositories\Interfaces;

interface DahliaInterface
{
    public function pasienRajal(int $pemeriksaan_id);
    public function input_permintaan_dahlia();
    public function perencanaan_permintaan_dahlia();
    public function input_permintaan_atk_dahlia();
    public function perencanaan_permintaan_atk_dahlia();
    public function input_permintaan_obat_dahlia();
    public function perencanaan_permintaan_obat_dahlia();
    
}
