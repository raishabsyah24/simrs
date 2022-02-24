<?php

namespace App\Repositories\Interfaces;

interface MelatiInterface
{
    public function pasienRajal(int $pemeriksaan_id);
    public function input_permintaan();
    public function perencanaan_permintaan();
    public function input_permintaan_atk();
    public function perencanaan_permintaan_atk();
    public function input_permintaan_obat();
    public function perencanaan_permintaan_obat();
    
}
