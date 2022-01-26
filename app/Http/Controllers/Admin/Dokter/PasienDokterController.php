<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DokterInterface;

class PasienDokterController extends Controller
{
    private $dokterRepository;

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }
    public function index()
    {
        $data = $this->dokterRepository->daftarPasien();
        return $data;
        $title = 'Daftar Pasien';
        return view('admin.dokter.pasien.index', compact(
            'title'
        ));
    }
}
