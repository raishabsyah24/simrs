<?php

namespace App\Http\Controllers\Admin\Apotek;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\ApotekExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Interfaces\ApotekInterface;

class LaporanController extends Controller
{
    public $apotekRepository;

    public function __construct(ApotekInterface $apotekRepository)
    {
        $this->apotekRepository = $apotekRepository;
    }

    public function laporanApotek()
    {
        $title = 'Laporan Apotek';
        $data = $this->kategoriPasien();
        return view('admin.apotek.laporan.index', compact(
            'title',
            'data'
        ));
    }

    public function ekspor(Request $request)
    {
        $title = 'Laporan';
        $res = $request->validate([
            'dari' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:sampai',
            ],
            'sampai' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:dari'
            ],
            'ekstensi' => 'required',
            'kategori_pasien' => 'required',
        ]);

        $tanggal_awal = Carbon::parse($request->dari)->startOfDay();
        $tanggal_akhir = Carbon::parse($request->sampai)->endOfDay();
        $kategori_pasien = $res['kategori_pasien'];
        $bpjs     = isset($res['bpjs']);
        // $umum     = $res['umum'];
        // $asuransi = $res['asuransi'];

        $data['data'] = $this->apotekRepository->laporan($tanggal_awal, $tanggal_akhir)
            ->when($kategori_pasien ?? false, function ($query) use ($kategori_pasien) {
                if ($kategori_pasien == 'semua') {
                    return false;
                }
                return $query->where('kt.id', $kategori_pasien);
            })
            ->get();

        // return $data['data'];

        $data['dari'] = $res['dari'];
        $data['sampai'] = $res['sampai'];

        return view('admin.apotek.laporan.pdf', compact(
            'data',
            'res'
        ));
    }
}
