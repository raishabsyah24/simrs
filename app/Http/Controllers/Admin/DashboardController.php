<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DashboardInterface;
use Auth;

class DashboardController extends Controller
{
    private $dashboardRepository;

    public function __construct(DashboardInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        $title = 'Dashboard';

        $total_pasien_rajal_hari_ini = formatAngka($this->dashboardRepository->totalPasienRajalHariIni());

        $total_pasien_rajal_bpjs_hari_ini = formatAngka($this->dashboardRepository->totalPasienRajalBpjsHariIni());

        $total_pasien_rajal_umum_hari_ini = formatAngka($this->dashboardRepository->totalPasienRajalUmumHariIni());

        $total_pasien_rajal_asuransi_hari_ini = formatAngka($this->dashboardRepository->totalPasienRajalAsuransiHariIni());

        $total = [
            ['Total Pasien Rawat Jalan Hari Ini', $total_pasien_rajal_hari_ini],
            ['Pasien BPJS Rawat Jalan Hari Ini', $total_pasien_rajal_bpjs_hari_ini],
            ['Pasien Umum Rawat Jalan Hari Ini', $total_pasien_rajal_umum_hari_ini],
            ['Pasien Asuransi Rawat Jalan Hari Ini', $total_pasien_rajal_asuransi_hari_ini]
        ];

        // Total Pasien Dokter Spesialis Bulan Ini
        $dokter['total_pasien_dokter_spesialis'] = $this->dashboardRepository->totalPasienSpesialisSaya(Auth::id());
        $dokter['data'] = $this->dashboardRepository->dataPasienSpesialisSaya(Auth::id());
        return $dokter['data'];

        return view('admin.dashboard.index', compact(
            'title',
            'total',
            'dokter'
        ));
    }
}
