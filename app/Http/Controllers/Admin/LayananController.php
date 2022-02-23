<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LayananRequest;
use App\Repositories\Interfaces\LayananInterface;

class LayananController extends Controller
{
    private $layananRepository;
    public $perPage = 12;

    public function __construct(LayananInterface $layananRepository)
    {
        $this->layananRepository = $layananRepository;
    }

    public function index()
    {
        $data = $this->layananRepository->all()
            ->paginate($this->perPage);
        $title = 'Daftar Layanan';
        $badge = $this->badge();
        $kategori_layanan = $this->kategoriLayanan();
        return view('admin.layanan.index', compact(
            'title',
            'data',
            'badge',
            'kategori_layanan'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $badge = $this->badge();
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $data = $this->layananRepository->all()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('l.id', 'like', '%' . $q . '%')
                        ->orWhere('l.kode', 'like', '%' . $q . '%')
                        ->orWhere('l.nama', 'like', '%' . $q . '%')
                        ->orWhere('l.tarif', 'like', '%' . $q . '%')
                        ->orWhere('l.keterangan', 'like', '%' . $q . '%');
                })
                ->orderBy('l.created_at', $sortBy)
                ->paginate($this->perPage);
            return view(
                'admin.layanan.fetch',
                compact('data', 'badge')
            )
                ->render();
        }
    }

    public function store(LayananRequest $request)
    {
        $attr = $request->all();
        DB::transaction(function () use ($attr) {
            $attr['kode'] = kodeLayanan($attr['parent_id']);
            $layanan = Layanan::create($attr);
        });

        return response()->json([
            'message' => 'Tambah layanan berhasil',
            'url' => route('layanan.index')
        ], 200);
    }

    public function show(Layanan $layanan)
    {
        return response()->json([
            'data' => $layanan
        ], 200);
    }

    public function update(Layanan $layanan, LayananRequest $request)
    {
        $attr = $request->all();
        DB::transaction(function () use ($attr, $layanan) {
            $layanan->update($attr);
        });

        return response()->json([
            'message' => 'Ubah layanan berhasil',
            'url' => route('layanan.index')
        ], 200);
    }
}
