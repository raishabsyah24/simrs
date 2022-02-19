<?php

namespace App\Repositories\Interfaces;

use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

interface GudangFarmasiInterface
{

    public function input_po();
    public function perencanaan_po();
    public Function searchObat(string $nama_obat);
    public function perencanaan_permintaan();
    public function input_permintaan();

    
}
