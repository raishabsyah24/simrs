<?php

namespace App\Http\Controllers\Admin\Nurse_Station;

use App\Http\Controllers\Controller;
use App\Models\gudang_apotek;
use App\Models\gudangAtkPermintaan;
use App\Models\GudangPermintaan;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DahliaInterface;

use Illuminate\Support\Facades\DB;

class DahliaController extends Controller

{
        public $perPage = 10;
    
        private $dahliaRepository;
    
        public function __construct(DahliaInterface $dahliaRepository)
        {
            $this->dahliaRepository = $dahliaRepository;
        }

    // Data pasien hari ini berdasarkan login dokter spesialis
  

    public function perencanaan_permintaan_dahlia(Request $request)
    {
     
        
        $data = $this->dahliaRepository->perencanaan_permintaan_dahlia()
                ->paginate($this->perPage);
            $title = 'Dahlia';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.nurse_station.dahlia.permintaan.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
    }

    public function input_permintaan_dahlia(Request $request)
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

        public function perencanaan_permintaan_atk_dahlia(Request $request)
    {
     
        
        $data = $this->dahliaRepository->perencanaan_permintaan_atk_dahlia()
                ->paginate($this->perPage);
            $title = 'Dahlia';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.nurse_station.dahlia.permintaan_atk.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
    }

    public function input_permintaan_atk_dahlia(Request $request)
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

        public function perencanaan_permintaan_obat_dahlia(Request $request)
        {
         
            
            $data = $this->dahliaRepository->perencanaan_permintaan_obat_dahlia()
                    ->paginate($this->perPage);
                $title = 'Dahlia';
                $badge = $this->badge();
                $per_page = $this->perPage;
                // return $data;
                return view('admin.nurse_station.dahlia.permintaan_obat.perencanaan_permintaan', compact(
                    'title',
                    'data',
                ));
        }
    
        public function input_permintaan_obat_dahlia(Request $request)
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
        $data = $this->dahliaRepository->pasienRajal($pemeriksaan_id);

        return view('admin.posisi_pasien.rajal', compact(
            'title',
            'data'
        ));
    }
}