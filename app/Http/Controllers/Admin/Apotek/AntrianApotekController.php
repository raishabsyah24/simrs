<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AntrianApotekController extends Controller
{
    public function index()
    {
        $title = 'Daftar Antrian Apotek';
        return view('admin.apotek.master._daftar-antrian', compact(
            'title'
        ));
    }
}
