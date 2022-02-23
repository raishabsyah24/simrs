<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PendaftaranRawatInapInterface;
use Illuminate\Http\Request;

class RawatInapController extends Controller
{
    public $perPage = 10;
    public $layananPeriksaDokter  = 1;
    public $layananPeriksaLaboratorium  = 2;
    public $layananPeriksaRadiologi  = 3;

    private $pendaftaranRepository;

    public function __construct(PendaftaranRawatInapInterface $pendaftaranRepository)
    {
        $this->pendaftaranRepository = $pendaftaranRepository;
    }

    public function index()
    {
        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran Rawat Inap';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        return view('admin.pendaftaran.ranap.index', compact(
            'title',
            'data',
            'badge',
            'kategori_pasien',
            'poli',
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $kategori = $request->get('kategori');
            $poli = $request->get('poli');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = $this->pendaftaranRepository->pasienHariIni()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('p.id', 'like', '%' . $q . '%')
                        ->where('p.kode', 'like', '%' . $q . '%')
                        ->where('p.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('p.no_sep', 'like', '%' . $q . '%')
                        ->orWhere('p.no_bpjs', 'like', '%' . $q . '%')
                        ->orWhere('pasien.nama', 'like', '%' . $q . '%')
                        ->orWhere('pasien.nik', 'like', '%' . $q . '%')
                        ->orWhere('kp.nama', 'like', '%' . $q . '%')
                        ->orWhere('p.created_at', 'like', '%' . $q . '%')
                        ->orWhere('poli.nama', 'like', '%' . $q . '%');
                })
                ->when($kategori ?? false, function ($query) use ($kategori) {
                    if ($kategori == 'semua') {
                        return false;
                    }
                    return $query->where('p.kategori_pasien', $kategori);
                })
                ->when($poli ?? false, function ($query) use ($poli) {
                    if ($poli == 'semua') {
                        return false;
                    }
                    return $query->where('poli.nama', $poli);
                })
                ->orderBy('p.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.pendaftaran.ranap.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }
}
