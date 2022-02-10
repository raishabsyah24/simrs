<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Repositories\Interfaces\ObatInterface;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function dataObat()
    {
        $data = DB::table('obat')
            ->selectRaw('kode, nama_paten, nama_generik, komposisi, status, created_at')
            ->orderByDesc('created_at')
            ->paginate(12);
        $title = 'Data Obat';
        $total = Obat::count();
        $badge = $this->badge();
        return view('admin.apotek.data_obat._dataObat', compact(
            'title',
            'data',
            'total',
            'badge'
        ));
    }

    function _fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = DB::table('obat')
                ->selectRaw('id, kode, nama_paten, nama_generik, komposisi, status, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('kode', 'like', '%' . $q . '%')
                        ->orWhere('nama_paten', 'like', '%' . $q . '%')
                        ->orWhere('nama_generik', 'like', '%' . $q . '%')
                        ->orWhere('komposisi', 'like', '%' . $q . '%')
                        ->orWhere('status', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate(12);
            return view('admin.apotek.data_obat._fetch-data', compact('data', 'badge'))->render();
        }
    }

    public function data(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'kode',
            2 => 'nama_paten',
            3 => 'nama_generik',
            4 => 'komposisi',
            5 => 'status',
        ];

        // dd($request->all());

        $totalData = $this->obatRepository->all()->count();
        $search = $request->input('search.value');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $data = $this->obatRepository->all()
            ->when(
                $search ?? false,
                fn ($query, $search) =>
                $query->where('l.id', 'LIKE', "%{$search}%")
                    ->orWhere('l.kode', 'LIKE', "%{$search}%")
                    ->orWhere('l.nama_paten', 'LIKE', "%{$search}%")
                    ->orWhere('l.nama_generik', 'LIKE', "%{$search}%")
                    ->orWhere('l.komposisi', 'LIKE', "%{$search}%")
                    ->orWhere('l.status', 'LIKE', "%{$search}%")
            )
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = $this->obatRepository->all()
            ->when(
                $search ?? false,
                fn ($query, $search) =>
                $query->where('l.id', 'LIKE', "%{$search}%")
                    ->orWhere('l.kode', 'LIKE', "%{$search}%")
                    ->orWhere('l.nama_paten', 'LIKE', "%{$search}%")
                    ->orWhere('l.nama_generik', 'LIKE', "%{$search}%")
                    ->orWhere('l.komposisi', 'LIKE', "%{$search}%")
                    ->orWhere('l.status', 'LIKE', "%{$search}%")
            )
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->count();

        $data = [];
        if (!empty($layanan)) {
            foreach ($layanan as $record) {
                $item['id'] = $record->id;
                $item['kode'] = $record->kode;
                $item['nama_paten'] = $record->nama_paten;
                $item['nama_generik'] = $record->nama_generik;
                $item['komposisi'] = $record->komposisi;
                $item['status'] = $record->status;
                $data[] = $item;
            }
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ]);
    }
}
