<?php

namespace App\Repositories\Interfaces;

interface MelatiInterface
{
    public function pasienRajal(int $pemeriksaan_id);
    public function input_permintaan_melati();
    public function perencanaan_permintaan_melati();
    public function input_permintaan_atk_melati();
    public function perencanaan_permintaan_atk_melati();
    public function input_permintaan_obat_melati();
    public function perencanaan_permintaan_obat_melati();
    
}
