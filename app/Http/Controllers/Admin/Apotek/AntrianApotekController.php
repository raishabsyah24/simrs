<?php

namespace App\Http\Controllers\Admin\Apotek;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ApotekInterface;
use Illuminate\Support\Facades\DB;

class AntrianApotekController extends Controller
{
    public $perPage = 12;

    private $apotekRepository;

    public function __construct(ApotekInterface $apotekRepository)
    {
        $this->apotekRepository = $apotekRepository;
    }

    public function index()
    {
        $data = $this->apotekRepository->antrianApotek();
        // return $data;
        $title = 'Daftar Antrian Apotek';
        $total = $this->apotekRepository->antrianApotek()->count();
        $per_page = $this->perPage;
        $badge = $this->badge();
        $kategori = $this->kategoriPasien();
        return view('admin.apotek.antrian_apotek_bpjs._daftar-antrian', compact(
            'title',
            'data',
            'badge',
            'total',
            'kategori',
            'per_page'
        ));
    }

    function _fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotek()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('rm.kode', 'like', '%' . $q . '%')
                        ->orWhere('pd.pasien_id', 'like', '%' . $q . '%')
                        ->orWhere('pn.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('pl.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('pd.dokter_id', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.apotek.antrian_apotek_bpjs._fetch-data_bpjs', compact(
                'data',
                'badge'
            ))
                ->render();
        }
    }
}
