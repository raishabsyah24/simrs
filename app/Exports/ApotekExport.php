<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class ApotekExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): view
    {
        return view('admin.apotek.laporan.excel', [
            'data' => $this->data
        ]);
    }
}
