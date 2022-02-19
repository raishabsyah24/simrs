<?php

namespace App\Repositories\Interfaces;

interface MelatiInterface
{
    public function input_permintaan();
    public function pasienRajal(int $pemeriksaan_id);
    public function perencanaan_permintaan();
    
}
