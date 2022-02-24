<?php

namespace App\Repositories\Interfaces;

use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

interface GudangATKInterface
{
    public Function searchObat(string $nama_obat);
    public function perencanaan_permintaan_atk();
    public function input_permintaan_atk();

    
}
