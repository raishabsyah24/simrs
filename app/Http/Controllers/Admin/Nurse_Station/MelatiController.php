<?php

namespace App\Http\Controllers\Admin\Nurse_Station;

use App\Http\Controllers\Controller;
use App\Models\gudang_apotek;
use App\Models\gudangAtkPermintaan;
use App\Models\GudangPermintaan;
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
  

    public function perencanaan_permintaan_melati(Request $request)
    {
     
        
        $data = $this->melatiRepository->perencanaan_permintaan_melati()
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

    public function input_permintaan_melati(Request $request)
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

        public function perencanaan_permintaan_atk_melati(Request $request)
    {
     
        
        $data = $this->melatiRepository->perencanaan_permintaan_atk_melati()
                ->paginate($this->perPage);
            $title = 'Melati';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.nurse_station.melati.permintaan_atk.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
    }

    public function input_permintaan_atk(Request $request)
        {
            $gudang_atk_permintaan = new gudangAtkPermintaan();
            $gudang_atk_permintaan->no_permintaan  = $request->no_permintaan;
            $gudang_atk_permintaan->nama_unit = $request->nama_unit;
            $gudang_atk_permintaan->tanggal_permintaan = now();
            $gudang_atk_permintaan->jenis_permintaan = "ATK";
            $gudang_atk_permintaan->item_permintaan = $request->item_permintaan;
            $gudang_atk_permintaan->jumlah = $request->jumlah;
            $gudang_atk_permintaan->stok_lama = "20";

            // dd($request->all());
            $gudang_atk_permintaan->save();
            return back();
        }

        public function perencanaan_permintaan_obat_melati(Request $request)
        {
         
            
            $data = $this->melatiRepository->perencanaan_permintaan_obat_melati()
                    ->paginate($this->perPage);
                $title = 'Melati';
                $badge = $this->badge();
                $per_page = $this->perPage;
                // return $data;
                return view('admin.nurse_station.melati.permintaan_obat.perencanaan_permintaan', compact(
                    'title',
                    'data',
                ));
        }
    
        public function input_permintaan_obat_melati(Request $request)
            {
                $gudang_apotek = new gudang_apotek();
                $gudang_apotek->no_permintaan  = $request->no_permintaan;
                $gudang_apotek->nama_unit = $request->nama_unit;
                $gudang_apotek->tanggal_permintaan = now();
                $gudang_apotek->jenis_permintaan = "OBAT";
                $gudang_apotek->item_permintaan = $request->item_permintaan;
                $gudang_apotek->jumlah = $request->jumlah;
                $gudang_apotek->stok_lama = "20";
    
                // dd($request->all());
                $gudang_apotek->save();
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