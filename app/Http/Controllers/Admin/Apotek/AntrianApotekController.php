<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ObatApotek;
use App\Models\ObatPasienRajal;
use App\Models\PeriksaDokter;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ApotekInterface;
use App\Repositories\Interfaces\DokterInterface;

class AntrianApotekController extends Controller
{
    private $apotekRepository;
    private $dokterRepository;
    public  $perPage = 12;

    public function __construct(ApotekInterface $apotekRepository, DokterInterface $dokterRepository)
    {
        $this->apotekRepository = $apotekRepository;
        $this->dokterRepository = $dokterRepository;
    }

    public function index()
    {
        $data = $this->apotekRepository->antrianApotekBpjs();
        // return $data;
        $title = 'Daftar Antrian Apotek';
        $total = $this->apotekRepository->antrianApotekBpjs()->count();
        $per_page = $this->perPage;
        $badge = $this->badge();
        $kategori = $this->kategoriPasien();
        return view('admin.apotek.antrian_apotek_bpjs._daftar-antrian', compact(
            'title',
            'data',
            'badge',
            'total',
            'kategori',
            'per_page'
        ));
    }

    function _fetchData(Request $request)
    {
        if ($request->ajax()) {
            $p = $request->get('pasien_id');
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotekBpjs()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('rm.kode', 'like', '%' . $q . '%')
                        ->orWhere('pd.pasien_id', 'like', '%' . $q . '%')
                        ->orWhere('pn.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('pl.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('pd.dokter_id', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.apotek.antrian_apotek_bpjs._fetch-data_bpjs', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }


    public function createApotek()
    {

        return view('admin.apotek.antrian_apotek_bpjs.partials._modal_tambah_obat');
    }

    public function storeApotek(Request $request)
    {
        $attr = $request->all();


        $obat = ObatApotek::find($attr['obat_apotek_id']);
        $harga_obat = $obat->harga_jual;

        // cek stok obat
        if ($request->jumlah > $obat->stok) {
            return 'obat lebih';
        }

        ObatPasienRajal::create([
            'obat_apotek_id' => $attr['obat_apotek_id'],
            'periksa_dokter_id' => $attr['periksa_dokter_id'],
            'harga_obat' => $harga_obat,
            'jumlah' => $request->jumlah,
            'subtotal' => $harga_obat * $request->jumlah
        ]);

        $obat->update([
            'stok' => $obat->stok - $request->jumlah,
        ]);
    }

    public function prosesApotek($riwayat_pasien)
    {
        $data = $this->dokterRepository->obatPasien($riwayat_pasien);
        $pasien = $this->apotekRepository->pasienApotek($riwayat_pasien);
        $title = 'Ubah data pasien apotek';
        return view('admin.apotek.antrian_apotek_bpjs._proses_pasien', compact(
            'title',
            'pasien',
            'data',
        ));
    }

    // public function updateApotek(Request $request, $id)
    // {
    //     // dd($request->all());
    //     Pasien::where('id', $request->id)
    //         ->update([
    //             'nama' => $request->nama
    //         ]);

    //     return back();
    // }
}
