<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use App\Models\Obat;
use App\Models\ObatApotek;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createObat()
    {

        $title = 'Tambah Obat';
        $jenis_satuan = $this->jenis_satuan();
        return view('admin.apotek.order.create.create', compact(
            'title',
            'jenis_satuan'
        ));
    }

    public function storeObat(Request $request)
    {
        $satuan = $request->jenis_satuan;
        $satuan = Satuan::find($satuan);

        // Insert ke table obat
        $obat = Obat::create([
            'kode' => 'OBT' . uniqid(),
            'nama_paten' => $request->nama_paten,
            'nama_generik' => $request->nama_generik,
            'satuan_id' => $request->satuan_id,
            'komposisi' => $request->komposisi

        ]);

        // Insert ke table apotek
        $query = ObatApotek::create([
            'obat_id' => $obat->id,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'minimal_stok' => $request->minimal_stok,
            'maksimal_stok' => $request->maksimal_stok,
            'satuan_id' => $request->satuan_id,
            'ed' => $request->tanggal
        ]);

        return response()->json([
            'url' => route('order.store.obat'),
            'message' => 'Tambah' . $obat->nama_paten . ' berhasil !'
        ], 200);
    }
}
