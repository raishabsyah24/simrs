<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GudangFarmasi;
use App\Models\GudangPermintaan;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\GudangFarmasiInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Repositories\Interfaces\GudangFarmasiInterface;
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

class GudangFarmasiController extends Controller

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
    
        public function perencanaan_po()
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
            return view('admin.gudang.po.perencanaan_po', compact(
                'title',
                'data',
                'total',
                'badge',
                'kategori_pasien',
                'poli',
                'per_page'
            ));
        }


        public function penyimpanan()
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
            return view('admin.gudang.penyimpanan', compact(
                'title',
                'data',
                'total',
                'badge',
                'kategori_pasien',
                'poli',
                'per_page'
            ));
        }


    public function migrasi()
    {
        $title = 'Migrasi data obat Gudang Farmasi';

       
        return view('admin.gudang.migrasi', compact(
            'title'
        ));
    }
    

    public function penerimaan_po()
    {
        $title = 'penerimaan data obat Gudang Farmasi';

       
        return view('admin.gudang.penerimaan_po', compact(
            'title'
        ));
    }

    public function permintaan_po()
    {
        $title = 'permintaan data obat Gudang Farmasi';

       
        return view('admin.gudang.po.pemintaan_po', compact(
            'title'
        ));
    }

    public function permintaan_bhp()
    {
        $title = 'permintaan data obat Gudang Farmasi';

       
        return view('admin.gudang.permintaan_bhp', compact(
            'title'
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
}
