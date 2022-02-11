<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\PeriksaLab;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use App\Models\PeriksaRadiologi;
use App\Models\PemeriksaanDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PendaftaranInterface;
use App\Http\Requests\Admin\PendaftaranPasienBaruRequest;
use App\Http\Requests\Admin\PendaftaranPasienLamaRequest;
use App\Models\PeriksaPoliStation;
use App\Models\PosisiDetailPasienRajal;
use App\Models\PosisiPasienRajal;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public $perPage = 10;

    private $pendaftaranRepository;

    public function __construct(PendaftaranInterface $pendaftaranRepository)
    {
        $this->pendaftaranRepository = $pendaftaranRepository;
    }

    public function index()
    {

        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $poli = $this->poli();
        $total = [
            ['Total Pasien Hari Ini', $this->pendaftaranRepository->pasienHariIni()->count()],
            ['BPJS', $this->pendaftaranRepository->totalPasienBpjs()],
            ['Umum', $this->pendaftaranRepository->totalPasienUmum()],
            ['Asuransi', $this->pendaftaranRepository->totalPasienAsuransi()],
        ];
        return view('admin.pendaftaran.index', compact(
            'title',
            'data',
            'total',
            'badge',
            'kategori_pasien',
            'poli',
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $kategori = $request->get('kategori');
            $poli = $request->get('poli');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = $this->pendaftaranRepository->pasienHariIni()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('p.id', 'like', '%' . $q . '%')
                        ->where('p.kode', 'like', '%' . $q . '%')
                        ->where('p.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('p.no_sep', 'like', '%' . $q . '%')
                        ->orWhere('p.no_bpjs', 'like', '%' . $q . '%')
                        ->orWhere('pasien.nama', 'like', '%' . $q . '%')
                        ->orWhere('pasien.nik', 'like', '%' . $q . '%')
                        ->orWhere('kp.nama', 'like', '%' . $q . '%')
                        ->orWhere('p.created_at', 'like', '%' . $q . '%')
                        ->orWhere('dokter.nama', 'like', '%' . $q . '%')
                        ->orWhere('poli.nama', 'like', '%' . $q . '%');
                })
                ->when($kategori ?? false, function ($query) use ($kategori) {
                    if ($kategori == 'semua') {
                        return false;
                    }
                    return $query->where('p.kategori_pasien', $kategori);
                })
                ->when($poli ?? false, function ($query) use ($poli) {
                    if ($poli == 'semua') {
                        return false;
                    }
                    return $query->where('poli.nama', $poli);
                })
                ->orderBy('p.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.pendaftaran.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }

    public function create()
    {
        $title = 'Tambah Pasien';
        $kategori_pasien = $this->kategoriPasien();
        $faskes = $this->faskes();
        $layanan = $this->layanan();
        $poli = $this->poli();
        return view('admin.pendaftaran.create', compact(
            'title',
            'kategori_pasien',
            'faskes',
            'layanan',
            'poli',
        ));
    }

    public function getDokterPoli(Request $request)
    {
        $data = $this->pendaftaranRepository->dokterPoli($request->poli_id);
        return response()->json([
            'data' => $data
        ], 200);
    }


    public function store(PendaftaranPasienBaruRequest $request)
    {
        $attr = $request->all();
        DB::transaction(function () use ($attr) {

            $dokter = Dokter::find($attr['dokter_id']);
            $nama_dokter = $dokter->nama;

            $poli = Poli::find($attr['poli_id']);
            $nama_poli = $poli->nama;
            $tanggal = Carbon::parse($attr['tanggal'])->format('d');

            // Insert pasien
            $pasien = Pasien::create($attr);

            // Insert rekam medis
            $rm = RekamMedis::where('pasien_id', $pasien->id)->first();
            if (!$rm) {
                $rekam_medis = RekamMedis::create([
                    'kode' => kodeRekamMedis(),
                    'pasien_id' => $pasien->id
                ]);
            }

            // Insert pemeriksaan
            $pemeriksaan = Pemeriksaan::create([
                'kode' => kodePemeriksaanPasien(),
                'no_rekam_medis' => $rekam_medis->kode ?? '',
                'no_sep' => $attr['no_sep'] ?? null,
                'no_bpjs' => $attr['no_bpjs'] ?? null,
                'faskes_id' => $attr['faskes_id'] ?? null,
                'pasien_id' => $pasien->id,
                'kategori_pasien' => $attr['kategori_pasien'],
                'tanggal' => $attr['tanggal'],
                'status' => 'belum selesai',
            ]);

            // Insert posisi pasien saat ini
            $posisi_pasien_rajal = PosisiPasienRajal::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'status' => 'proses periksa poli'
            ]);
            $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                'posisi_pasien_rajal_id' => $posisi_pasien_rajal->id,
                'aktifitas' => 'Pasien selesai melakukan pendaftaran',
                'waktu' => now(),
                'status' => 'selesai'
            ]);

            // Insert pemeriksaan detail
            $pemeriksaan_detail = PemeriksaanDetail::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'poli_id' => $attr['poli_id'],
                'layanan_id' => $attr['layanan_id'],
                'dokter_id' => $attr['dokter_id'],
                'status' => 'belum selesai',
            ]);
            if ($attr['tujuan'] == 'periksa') {
                $periksa_poli_station = PeriksaPoliStation::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'pasien_id' => $pasien->id,
                    'tanggal' => $attr['tanggal']
                ]);

                $periksa_dokter = PeriksaDokter::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'periksa_poli_station_id' => $periksa_poli_station->id,
                    'pasien_id' => $pasien->id,
                    'poli_id' => $pemeriksaan_detail->poli_id,
                    'no_antrian_periksa' => noUrutPasienPeriksa($tanggal, $pemeriksaan_detail->poli_id, $pemeriksaan_detail->dokter_id),
                    'tanggal' => $attr['tanggal'],
                    'keterangan' => $attr['keterangan'],
                    'status_diperiksa' => 'belum diperiksa'
                ]);
            } elseif ($attr['tujuan'] == 'lab') {
                $periksa_lab = PeriksaLab::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'pasien_id' => $pasien->id,
                    'tanggal' => $attr['tanggal'],
                    'keterangan' => $attr['keterangan'],
                    'status_diperiksa' => 'belum diperiksa'
                ]);
            } elseif ($attr['tujuan'] == 'radiologi') {
                $periksa_radiologi = PeriksaRadiologi::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'pasien_id' => $pasien->id,
                    'tanggal' => $attr['tanggal'],
                    'keterangan' => $attr['keterangan'],
                    'status_diperiksa' => 'belum diperiksa'
                ]);
            }
        });

        return response()->json([
            'message' => 'Pasien berhasil ditambahkan',
            'url' => route('pendaftaran.index')
        ], 200);
    }

    public function createPasienSudahPernahDaftar()
    {
        $title = 'Tambah Pasien';
        $kategori_pasien = $this->kategoriPasien();
        $faskes = $this->faskes();
        $layanan = $this->layanan();
        $poli = $this->poli();
        return view('admin.pendaftaran.create_pasien_terdaftar', compact(
            'title',
            'kategori_pasien',
            'faskes',
            'layanan',
            'poli',
        ));
    }

    public function storePasienSudahPernahDaftar(PendaftaranPasienLamaRequest $request)
    {
        $attr = $request->all();
        DB::transaction(
            function () use ($attr) {
                $pasien = Pasien::find($attr['pasien']);
                $rekam_medis = RekamMedis::where('pasien_id', $pasien->id)
                    ->first();
                $tanggal = Carbon::parse($attr['tanggal'])->format('d');

                // Insert rekam medis jika ga ada
                $rm = RekamMedis::where('pasien_id', $pasien->id)->first();
                if (!$rm) {
                    $rekam_medis = RekamMedis::create([
                        'kode' => kodeRekamMedis(),
                        'pasien_id' => $pasien->id
                    ]);
                }

                // Insert pemeriksaan
                $pemeriksaan = Pemeriksaan::create([
                    'kode' => kodePemeriksaanPasien(),
                    'no_rekam_medis' => $rekam_medis->kode,
                    'no_sep' => $attr['no_sep'] ?? null,
                    'no_bpjs' => $attr['no_bpjs'] ?? null,
                    'faskes_id' => $attr['faskes_id'] ?? null,
                    'pasien_id' => $pasien->id,
                    'kategori_pasien' => $attr['kategori_pasien'],
                    'tanggal' => $attr['tanggal'],
                    'status' => 'belum selesai',
                ]);

                // Insert posisi pasien saat ini
                $posisi_pasien_rajal = PosisiPasienRajal::create([
                    'pemeriksaan_id' => $pemeriksaan->id,
                    'status' => 'proses periksa poli'
                ]);
                $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                    'posisi_pasien_rajal_id' => $posisi_pasien_rajal->id,
                    'aktifitas' => 'Pasien selesai melakukan pendaftaran',
                    'waktu' => now(),
                    'status' => 'selesai'
                ]);

                // Insert pemeriksaan detail
                $pemeriksaan_detail = PemeriksaanDetail::create([
                    'pemeriksaan_id' => $pemeriksaan->id,
                    'poli_id' => $attr['poli_id'],
                    'layanan_id' => $attr['layanan_id'],
                    'dokter_id' => $attr['dokter_id'],
                    'status' => 'belum selesai',
                ]);

                if ($attr['tujuan'] == 'periksa') {
                    $periksa_poli_station = PeriksaPoliStation::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal']
                    ]);

                    $periksa_dokter = PeriksaDokter::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'periksa_poli_station_id' => $periksa_poli_station->id,
                        'pasien_id' => $pasien->id,
                        'poli_id' => $pemeriksaan_detail->poli_id,
                        'no_antrian_periksa' => noUrutPasienPeriksa($tanggal, $pemeriksaan_detail->poli_id, $pemeriksaan_detail->dokter_id),
                        'tanggal' => $attr['tanggal'],
                        'keterangan' => $attr['keterangan'],
                        'status_diperiksa' => 'belum diperiksa'
                    ]);
                } elseif ($attr['tujuan'] == 'lab') {
                    $periksa_lab = PeriksaLab::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal'],
                        'keterangan' => $attr['keterangan'],
                        'status_diperiksa' => 'belum diperiksa'
                    ]);
                } elseif ($attr['tujuan'] == 'radiologi') {
                    $periksa_radiologi = PeriksaRadiologi::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal'],
                        'keterangan' => $attr['keterangan'],
                    ]);
                }
            }
        );

        return response()->json([
            'message' => 'Pasien berhasil ditambahkan',
            'url' => route('pendaftaran.index')
        ], 200);
    }

    public function searchPasien(Request $request)
    {
        $query = $request->get('data');

        $data = DB::table('pasien')
            ->selectRaw('
            id, nik, no_bpjs, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, no_hp
            ')
            ->where("nik", "LIKE", "%{$query}%")
            ->orWhere("nama", "LIKE", "%{$query}%")
            ->get();

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item" onclick="pilihData(`' . $item->id . '`,`' . route('pendaftaran.change-pasien') . '`)">' . $item->nama . ' (' . $item->nik . ') </a>
                ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function changePasien(Request $request)
    {
        $id = $request->get('id');
        $data = $this->pendaftaranRepository->riwayatKunjunganTerakhirPasien($id);
        $usia = tanggal($data->tanggal_lahir) . ' ( ' . usia($data->tanggal_lahir) . ' ) ';
        $tanggal_periksa = tanggal($data->tanggal_periksa);

        return response()->json([
            'data' => $data,
            'usia' => $usia,
            'tanggal_periksa' => $tanggal_periksa
        ], 200);
    }
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan_id = $pemeriksaan->id;
        $pemeriksaan_detail = PemeriksaanDetail::where('pemeriksaan_id', $pemeriksaan_id)->get();

        $pemeriksaan->delete();
        foreach ($pemeriksaan_detail as $item) {
            $periksa_dokter = PeriksaDokter::where('pemeriksaan_detail_id', $item->id)->first();
            $periksa_lab = PeriksaLab::where('pemeriksaan_detail_id', $item->id)->first();
            $periksa_radiologi = PeriksaRadiologi::where('pemeriksaan_detail_id', $item->id)->first();

            if ($periksa_radiologi) {
                $periksa_radiologi->delete();
            }
            if ($periksa_lab) {
                $periksa_lab->delete();
            }
            if ($periksa_dokter) {
                $periksa_dokter->delete();
            }
            $item->delete();
        }

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
