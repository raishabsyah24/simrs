<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\gudang_apotek;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\GudangApotekInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GudangApotekController extends Controller

{
        public $perPage = 10;
    
        private $gudangApotekRepository;
    
        public function __construct(GudangApotekInterface $gudangApotekRepository)
        {
            $this->gudangApotekRepository = $gudangApotekRepository;
        }
    

        public function penyimpanan()
        {
    
            $data = $this->gudangApotekRepository->perencanaan_permintaan()
                ->paginate($this->perPage);
            $title = 'Gudang Atk';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.apotek.permintaan_obat.penyimpanan', compact(
                'title',
                'data',
            ));
        }

        public function perencanaan_permintaan_apotek(Request $request)
        {   
            $data = $this->gudangApotekRepository->perencanaan_permintaan()
                ->paginate($this->perPage);
            $title = 'Apotek';
            $badge = $this->badge();
            $per_page = $this->perPage;
            // return $data;
            return view('admin.apotek.permintaan_obat.perencanaan_permintaan', compact(
                'title',
                'data',
            ));
        }

        public function input_permintaan(Request $request)
        {
            dd($request->all());
            $gudang_apotek = new gudang_apotek();
            $gudang_apotek->no_permintaan  = $request->no_permintaan;
            $gudang_apotek->nama_unit = $request->nama_unit;
            $gudang_apotek->tanggal_permintaan = now();
            $gudang_apotek->jenis_permintaan = "ATK";
            $gudang_apotek->item_permintaan = $request->item_permintaan;
            $gudang_apotek->jumlah = $request->jumlah;
            $gudang_apotek->stok_lama = "20";

            // dd($request->all());
            $gudang_apotek->save();
            return back();
        }


    public function po_obat(Request $request)
    {
        $obat = $request->get('obat');
        $data = $this->gudangApotekRepository->searchObat($obat);

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
