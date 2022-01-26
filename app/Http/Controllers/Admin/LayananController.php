<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LayananInterface;

class LayananController extends Controller
{
    private $layananRepository;

    public function __construct(LayananInterface $layananRepository)
    {
        $this->layananRepository = $layananRepository;
    }

    public function index()
    {
        $data = DB::table('layanan')
            ->selectRaw('id, kode, nama, tarif, keterangan, created_at')
            ->orderByDesc('created_at')
            ->paginate(12);
        $title = 'Daftar Layanan';
        $badge = $this->badge();
        return view('admin.layanan.index', compact(
            'title',
            'data',
            'badge'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $badge = $this->badge();
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $data = DB::table('layanan')
                ->selectRaw('id, kode, nama, tarif, keterangan, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('kode', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('tarif', 'like', '%' . $q . '%')
                        ->orWhere('keterangan', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate(12);
            return view(
                'admin.layanan.fetch',
                compact('data', 'badge')
            )
                ->render();
        }
    }
}
