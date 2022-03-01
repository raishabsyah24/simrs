<?php

namespace App\Repositories\Interfaces;

use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

interface GudangApotekInterface
{
    public Function searchObat(string $nama_obat);
    public function perencanaan_permintaan();
    public function input_permintaan();

    
}
