<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class KasirExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
}
