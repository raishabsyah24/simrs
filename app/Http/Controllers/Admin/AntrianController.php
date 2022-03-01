<?php



namespace App\Http\Controllers\Admin;


use App\Models\Layanan;


use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use ElephantIO\Client;

use ElephantIO\Engine\SocketIO\Version2X;

use App\Repositories\Interfaces\AntrianInterface;

use App\Repositories\AntrianRepositoriy;

class AntrianController extends Controller
{
    public function antrian()
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
        return view('admin.pendaftaran.antrianindex', compact(
            'title',
            'data',
            'total',
            'badge',
            'kategori_pasien',
            'poli',
            'per_page'
        ));
    }

    public function loket()
    {

        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        $per_page = $this->perPage;
       
        return view('admin.pendaftaran.loketantrian', compact(
            'title',
            'data',
            'badge',
            'kategori_pasien',
            'poli',
            'per_page'
        ));
    }
}