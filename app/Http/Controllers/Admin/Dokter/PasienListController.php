<?php

namespace App\Http\Controllers\Admin\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienListController extends Controller
{
    public function createPasien()
    {
        $title = 'Tambah Pasien';
        return view('admin.dokter.order.pasien.create', compact(
            'title'
        ));
    }

    // insert ke table user

    // insert ke table profile

    // insert ke table dokter



}
