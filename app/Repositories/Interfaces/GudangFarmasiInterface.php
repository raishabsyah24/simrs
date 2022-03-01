<?php

namespace App\Repositories\Interfaces;

interface GudangFarmasiInterface
{

    public function migrasi();
    public function penyimpanan();
    public function penerimaan_po();
    public function perencanaan_po();
    public function permintaan_po();
    public function permintaan_bhp();
    
}
