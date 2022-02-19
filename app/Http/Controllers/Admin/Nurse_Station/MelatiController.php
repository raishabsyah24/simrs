<?php

namespace App\Http\Controllers\Admin\Nurse_Station;

use App\Http\Controllers\Controller;
use App\Models\GudangPermintaan;
use App\Models\Melati;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\MelatiInterface;

use Illuminate\Support\Facades\DB;

class MelatiController extends Controller

{
        public $perPage = 10;
    
        private $melatiRepository;
    
        public function __construct(MelatiInterface $melatiRepository)
        {
            $this->melatiRepository = $melatiRepository;
        }

    // Data pasien hari ini berdasarkan login dokter spesialis
  

    public function perencanaan_permintaan(Request $request)
    {
     
        
        $data = $this->melatiRepository->perencanaan_permintaan()
                ->paginate($this->perPage);
            $title = 'Melati';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.nurse_station.melati.permintaan.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
    }

    public function input_permintaan(Request $request)
        {
            $gudang_permintaan = new GudangPermintaan();
            $gudang_permintaan->no_permintaan  = $request->no_permintaan;
            $gudang_permintaan->nama_unit = $request->nama_unit;
            $gudang_permintaan->tanggal_permintaan = now();
            $gudang_permintaan->jenis_permintaan = "BHP";
            $gudang_permintaan->item_permintaan = $request->item_permintaan;
            $gudang_permintaan->jumlah = $request->jumlah;
            $gudang_permintaan->stok_lama = "20";

            // dd($request->all());
            $gudang_permintaan->save();
            return back();
        }


        public function rajal($pemeriksaan_id)
    {
        $title = 'Posisi Pasien';
        $data = $this->melatiRepository->pasienRajal($pemeriksaan_id);

        return view('admin.posisi_pasien.rajal', compact(
            'title',
            'data'
        ));
    }
}