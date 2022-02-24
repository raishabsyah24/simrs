<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\gudangAtkPermintaan;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\GudangATKInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GudangATKController extends Controller

{
        public $perPage = 10;
    
        private $gudangATKRepository;
    
        public function __construct(GudangATKInterface $gudangATKRepository)
        {
            $this->gudangATKRepository = $gudangATKRepository;
        }
    

        public function penyimpanan()
        {
    
            $data = $this->gudangATKRepository->perencanaan_permintaan_atk()
                ->paginate($this->perPage);
            $title = 'Gudang Atk';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.gudang_atk.penyimpanan', compact(
                'title',
                'data',
            ));
        }

        public function perencanaan_permintaan_atk(Request $request)
        {   
            $data = $this->gudangATKRepository->perencanaan_permintaan_atk()
                ->paginate($this->perPage);
            $title = 'Gudang ATK';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.gudang_atk.permintaan.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
        }

        public function input_permintaan_atk(Request $request)
        {
            dd($request->all());
            $gudang_permintaan = new gudangAtkPermintaan();
            $gudang_permintaan->no_permintaan  = $request->no_permintaan;
            $gudang_permintaan->nama_unit = $request->nama_unit;
            $gudang_permintaan->tanggal_permintaan = now();
            $gudang_permintaan->jenis_permintaan = "ATK";
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
        $data = $this->gudangATKRepository->searchObat($obat);

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
