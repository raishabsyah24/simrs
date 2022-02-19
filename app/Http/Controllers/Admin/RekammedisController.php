<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Layanan;
use App\Models\PeriksaLab;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use App\Models\PeriksaDokter;
use App\Models\PeriksaRadiologi;
use App\Models\RekamMedisPasien;
use App\Models\PemeriksaanDetail;
use App\Repositories\Interfaces\PendaftaranInterface;
use App\Http\Requests\Admin\PendaftaranPasienBaruRequest;
use App\Http\Requests\Admin\PendaftaranPasienLamaRequest;


class RekammedisController extends Controller
{
    public $perPage = 10;

    private $pendaftaranRepository;

    public function __construct(PendaftaranInterface $pendaftaranRepository)
    {
        $this->pendaftaranRepository = $pendaftaranRepository;
    }

    public function q()
    {
        return $this->pendaftaranRepository->pasienHariIni()->get();
    }

    public function rekam_medis()
    {

        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        $per_page = $this->perPage;
        $total = [
            ['Total Pasien Hari Ini', $this->pendaftaranRepository->pasienHariIni()->count()],
            ['BPJS', $this->pendaftaranRepository->totalPasienBpjs()],
            ['Umum', $this->pendaftaranRepository->totalPasienUmum()],
            ['Asuransi', $this->pendaftaranRepository->totalPasienAsuransi()],
        ];
        return view('admin.rekam_medis.rekammedis', compact(
            'title',
            'data',
            'total',
            'badge',
            'kategori_pasien',
            'poli',
            'per_page'
        ));
    }


    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = DB::table('activity_logs')
                ->selectRaw('id, nama, email, aktifitas, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%');
                })
                ->when(!empty($dari) && !empty($sampai) ?? false, function ($query) use ($dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->whereBetween('created_at', [$dari, $sampai]);
                })
                ->when(!empty($dari) && !empty($sampai && $q) ?? false, function ($query) use ($q, $dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%')
                        ->whereBetween('created_at', [$dari, $sampai]);
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.activity_log.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }


    public function retensi()
    {

        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        $per_page = $this->perPage;
        $total = [
            ['Total Pasien Hari Ini', $this->pendaftaranRepository->pasienHariIni()->count()],
            ['BPJS', $this->pendaftaranRepository->totalPasienBpjs()],
            ['Umum', $this->pendaftaranRepository->totalPasienUmum()],
            ['Asuransi', $this->pendaftaranRepository->totalPasienAsuransi()],
        ];
        return view('admin.rekam_medis.retensi', compact(
            'title',
            'data',
            'total',
            'badge',
            'kategori_pasien',
            'poli',
            'per_page'
        ));
    }

    public function migrasi_retensi()
    {

        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        $per_page = $this->perPage;
        $total = [
            ['Total Pasien Hari Ini', $this->pendaftaranRepository->pasienHariIni()->count()],
            ['BPJS', $this->pendaftaranRepository->totalPasienBpjs()],
            ['Umum', $this->pendaftaranRepository->totalPasienUmum()],
            ['Asuransi', $this->pendaftaranRepository->totalPasienAsuransi()],
        ];
        return view('admin.rekam_medis.migrasi', compact(
            'title',
            'data',
            'total',
            'badge',
            'kategori_pasien',
            'poli',
            'per_page'
        ));
    }

}
