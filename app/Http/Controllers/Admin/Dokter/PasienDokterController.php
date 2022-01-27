<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PeriksaDokter;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\DokterInterface;

class PasienDokterController extends Controller
{
    private $dokterRepository;
    private $perPage = 2;

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }

    public function q()
    {
        $daftar_pasien = $this->dokterRepository->indentitasPasien(1);
        return $daftar_pasien;
    }

    public function index()
    {
        $dokter_id = Auth::user()->dokter->id;
        $dokter = $this->dokterRepository->dokterSpesialis($dokter_id);
        $data = $this->dokterRepository->daftarPasienDokterSpesialis($dokter->poli_id)
            ->paginate($this->perPage);
        $title = 'Daftar Pasien';
        return view('admin.dokter.pasien.index', compact(
            'title',
            'data'
        ));
    }

    public function fetch(Request $request)
    {
        $title = 'Daftar Pasien';
        $q = $request->get('query');
        $dokter_id = Auth::user()->dokter->id;
        $dokter = $this->dokterRepository->dokterSpesialis($dokter_id);
        $data = $this->dokterRepository->daftarPasienDokterSpesialis($dokter->poli_id)
            ->when($q ?? false, function ($query) use ($q) {
                return $query->where('pas.nama', 'like', '%' . $q . '%');
            })
            ->paginate($this->perPage);
        return view(
            'admin.dokter.pasien.fetch',
            compact('data')
        )
            ->render();
    }

    public function periksaPasien($periksa_dokter_id)
    {
        $title = 'Periksa Pasien';
        $periksa_dokter = PeriksaDokter::find($periksa_dokter_id);
        $pasien_id = $periksa_dokter->pasien_id;
        $rekam_medis = $this->dokterRepository->rekamMedisPasienPeriksa($periksa_dokter_id);
        $pasien = $this->dokterRepository->indentitasPasien($pasien_id);

        return view('admin.dokter.pasien.pasien', compact(
            'title',
            'rekam_medis',
            'pasien'
        ));
    }
}
