<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GudangFarmasi;
use App\Models\GudangPermintaan;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\GudangFarmasiInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GudangFarmasiController extends Controller

{
        public $perPage = 10;
    
        private $gudangFarmasiRepository;
    
        public function __construct(GudangFarmasiInterface $gudangFarmasiRepository)
        {
            $this->gudangFarmasiRepository = $gudangFarmasiRepository;
        }
    

        public function input_po(Request $request)
        {
            // dd($request->all());
            $po = new GudangFarmasi();
            $po->no_po = $request->no_po;
            $po->tanggal_po = $request->tanggal_po;
            $po->nama_po = $request->nama_po;
            $po->perusahaan_tujuan = $request->perusahaan_tujuan;
            $po->pembuat_po = $request->pembuat_po;
            $po->kode_barang = $request->kode_barang;
            $po->jumlah_barang = $request->jumlah_barang;
            $po->keterangan = $request->keterangan;
            $po->tanggal_diterima = $request->tanggal_diterima;
            $po->penerimaan_po = "jamet Kudasai";
            $po->status_po = "Proses";
            $po->disetujui = $request->disetujui;
            // dd($request->all());
            $po->save();
            return back();
        }
    
        public function perencanaan_po(Request $request)
        {
            
            $data = $this->gudangFarmasiRepository->perencanaan_po()
                ->paginate($this->perPage);
            $title = 'Gudang';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.gudang.po.perencanaan_po', compact(
                'title',
                'data',
            ));
        }


        public function penyimpanan()
        {
    
            $data = $this->gudangFarmasiRepository->perencanaan_po()
                ->paginate($this->perPage);
            $title = 'Gudang';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.gudang.penyimpanan', compact(
                'title',
                'data',
            ));
        }


        public function perencanaan_permintaan_farmasi(Request $request)
        {   
            $data = $this->gudangFarmasiRepository->perencanaan_permintaan_farmasi()
                ->paginate($this->perPage);
            $title = 'Gudang Farmasi';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.gudang.permintaan.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
        }

        public function input_permintaan_farmasi(Request $request)
        {
            dd($request->all());
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

        


    public function po_obat(Request $request)
    {
        $obat = $request->get('obat');
        $data = $this->gudangFarmasiRepository->searchObat($obat);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item">
                ' . $item->nama_generik . ' ( ' . $item->nama_paten . ' )' . ' </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = DB::table('activity_logs')
                ->selectRaw('id, nama, email, aktifitas, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%');
                })
                ->when(!empty($dari) && !empty($sampai) ?? false, function ($query) use ($dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->whereBetween('created_at', [$dari, $sampai]);
                })
                ->when(!empty($dari) && !empty($sampai && $q) ?? false, function ($query) use ($q, $dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%')
                        ->whereBetween('created_at', [$dari, $sampai]);
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.activity_log.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }
}
