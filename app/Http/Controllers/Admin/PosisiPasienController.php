<?php

namespace App\Http\Controllers\Admin;

use App\Models\PosisiDetailPasienRajal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PosisiPasienInterface;

class PosisiPasienController extends Controller
{
    protected $posisiPasienRepository;

    public function __construct(PosisiPasienInterface $posisiPasienRepository)
    {
        $this->posisiPasienRepository = $posisiPasienRepository;
    }

    public function rajal($pemeriksaan_id)
    {
        $title = 'Posisi Pasien';
        $data = $this->posisiPasienRepository->pasienRajal($pemeriksaan_id);

        return view('admin.posisi_pasien.rajal', compact(
            'title',
            'data'
        ));
    }
    public function ranap($rawat_inap_id)
    {
        $title = 'Posisi Pasien Rawat Inap';
        $data = $this->posisiPasienRepository->pasienRaNap($rawat_inap_id);

        return view('admin.posisi_pasien.ranap', compact(
            'title',
            'data'
        ));
    }
}
