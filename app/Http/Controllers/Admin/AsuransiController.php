<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AsuransiRequest;
use App\Models\Asuransi;
use Illuminate\Http\Request;

class AsuransiController extends Controller
{
    public function store(AsuransiRequest $request)
    {
        $asuransi = new Asuransi();
        $asuransi->nama = $request->nama_asuransi;
        $asuransi->no_telpon = $request->no_telpon_asuransi;
        $asuransi->no_hp = $request->no_hp_asuransi;
        $asuransi->email = $request->email_asuransi;
        $asuransi->alamat = $request->alamat_asuransi;
        $asuransi->save();

        return response()->json([
            'message' => 'Asuransi berhasil ditambahkan'
        ], 200);
    }
}
