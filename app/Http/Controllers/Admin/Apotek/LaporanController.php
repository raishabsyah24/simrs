<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanApotek()
    {
        $title = 'Laporan Apotek';
        $data = $this->kategoriPasien();

        return view('admin.apotek.laporan.index', compact(
            'title',
            'data'
        ));
    }

    public function ekspor(Request $request)
    {
        $res = $request->validate([
            'dari' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:sampai'
            ],
            'sampai' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after:dari'
            ],
            'ektensi' => 'required',
            'data' => 'nullable'
        ]);
    }
}
