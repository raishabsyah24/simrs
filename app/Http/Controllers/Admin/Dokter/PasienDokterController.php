<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ObatApotek;
use App\Models\ObatPasienRajal;
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
        if (!$dokter_id) {
            return abort(403);
        }
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
            'pasien',
            'periksa_dokter_id'
        ));
    }

    public function searchObat(Request $request)
    {
        $obat = $request->get('obat');
        $periksa_dokter_id = $request->get('periksa_dokter_id');
        $data = $this->dokterRepository->searchObat($obat, $periksa_dokter_id);

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item" 
                onclick="pilihObat(`' . $item->id . '`,`' . $periksa_dokter_id . '`,`' . route('dokter.change-obat') . '`)">' . $item->nama_generik . ' ( ' . $item->nama_paten . ' )' . ' </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function changeObat(Request $request)
    {
        $attr = $request->all();
        DB::transaction(
            function () use ($attr) {
                $obat = ObatApotek::find($attr['obat_apotek_id']);
                $harga_obat = $obat->harga_jual;

                ObatPasienRajal::create([
                    'obat_apotek_id' => $attr['obat_apotek_id'],
                    'periksa_dokter_id' => $attr['periksa_dokter_id'],
                    'harga_obat' => $harga_obat,
                    'jumlah' => 1,
                    'subtotal' => $harga_obat
                ]);
            }
        );

        return response()->json([
            'message' => 'Obat berhasil ditambahkan',
            'url' => route('dokter.obat-pasien', $attr['periksa_dokter_id'])
        ], 200);
    }

    public function obatPasien($periksa_dokter_id)
    {
        $data = $this->dokterRepository->obatPasien($periksa_dokter_id);

        $output = '';
        foreach ($data as $item) {
            $output .= '
            <tr>
                <td>' . $item->nama_generik . '</td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input name="jumlah"
                                value="' . $item->jumlah . '"
                                type="text" class="form-control">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input name="signa"
                                value="' . $item->signa . '"
                                type="text" class="form-control">
                        </div>
                    </div>
                </td>
            </tr>
        ';
        }

        echo $output;
    }
}
