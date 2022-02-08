<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PeriksaPoliStation;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PoliStationInterface;
use App\Http\Requests\Admin\PeriksaPoliStationRequest;

class PoliStationController extends Controller
{
    public $perPage = 20;

    private $poliStationRepository;

    public function __construct(PoliStationInterface $poliStationRepository)
    {
        $this->poliStationRepository = $poliStationRepository;
    }

    public function index()
    {

        $data = $this->poliStationRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Poli Station';
        $badge = $this->badge();
        $poli = $this->poli();
        return view('admin.poli_station.index', compact(
            'title',
            'data',
            'badge',
            'poli',
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $poli = $request->get('poli');
            $status = $request->get('status');
            $badge = $this->badge();
            $data = $this->poliStationRepository->pasienHariIni()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('p.nama', 'like', '%' . $q . '%')
                        ->orWhere('p.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('po.nama', 'like', '%' . $q . '%')
                        ->orWhere('d.nama', 'like', '%' . $q . '%')
                        ->orWhere('pps.status_diperiksa', 'like', '%' . $q . '%')
                        ->orWhere('pps.tanggal', 'like', '%' . $q . '%')
                        ->orWhere('pe.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('kp.nama', 'like', '%' . $q . '%');
                })
                ->when($poli ?? false, function ($query) use ($poli) {
                    if ($poli == 'semua') {
                        return false;
                    }
                    return $query->where('po.nama', $poli);
                })
                ->when($status ?? false, function ($query) use ($status) {
                    if ($status == 'semua') {
                        return false;
                    }
                    return $query->where('pps.status_diperiksa', $status);
                })
                ->orderBy('pps.created_at', 'desc')
                ->paginate($this->perPage);
            return view('admin.poli_station.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }

    public function update(PeriksaPoliStation $periksaPoliStation, PeriksaPoliStationRequest $request)
    {
        $attr = $request->all();
        $attr['status_diperiksa'] = 'sudah diperiksa';
        $periksaPoliStation->update($attr);

        return response()->json([
            'message' => 'Pasien berhasil diperiksa',
            'url' => route('poli-station.index')
        ], 200);
    }

    public function show(PeriksaPoliStation $periksaPoliStation)
    {
        $data = $this->poliStationRepository->detailPasien($periksaPoliStation->id);
        return response()->json([
            'data' => $data,
        ], 200);
    }
}
