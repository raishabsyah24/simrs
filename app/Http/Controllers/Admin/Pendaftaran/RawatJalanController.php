<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use App\Models\{
    Kasir,
    Poli,
    Dokter,
    Pasien,
    PeriksaLab,
    RekamMedis,
    Pemeriksaan,
    PeriksaDokter,
    PeriksaRadiologi,
    PemeriksaanDetail,
    PenanggungJawabPasien,
    PeriksaPoliStation,
    PosisiDetailPasienRajal,
    PosisiPasienRajal
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\{PendaftaranPasienBaruRequest, PendaftaranPasienLamaRequest};
use App\Repositories\Interfaces\PendaftaranRawatJalanInterface;
use Carbon\Carbon;

class RawatJalanController extends Controller
{
    public $perPage = 10;
    public $layananPeriksaDokter  = 1;
    public $layananPeriksaLaboratorium  = 2;
    public $layananPeriksaRadiologi  = 3;

    private $pendaftaranRepository;

    public function __construct(PendaftaranRawatJalanInterface $pendaftaranRepository)
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
        return view('admin.pendaftaran.rajal.index', compact(
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
            return view('admin.pendaftaran.rajal.fetch', compact(
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
        return view('admin.pendaftaran.rajal.create', compact(
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
            //          query dokter
            $dokter = Dokter::find($attr['dokter_id']);
            $nama_dokter = $dokter->nama;

            //          query poli
            $poli = Poli::find($attr['poli_id']);
            $nama_poli = $poli->nama;

            //            Tanggal untuk antrian pasien
            $tanggal = Carbon::parse($attr['tanggal'])->format('d');

            // Insert pasien
            $pasien = Pasien::create($attr);

            // Insert rekam medis jika belum ada
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
                'pasien_sudah_membaca_dan_setuju_dengan_peraturan' => $attr['pasien_sudah_membaca_dan_setuju_dengan_peraturan'],
                'status' => 'belum selesai',
            ]);

            // Jika identitas Penanggung Jawab Pasien tidak sama dengan identitas pasien
            if ($attr['penanggung_jawab_sama_dengan_pasien'] == 'tidak') {
                $penanggung_jawab['pemeriksaan_id'] = $pemeriksaan->id;
                $penanggung_jawab['nama'] = $attr['nama_penanggung_jawab'];
                $penanggung_jawab['nik'] = $attr['nik_penanggung_jawab'];
                $penanggung_jawab['no_hp'] = $attr['no_hp_penanggung_jawab'];
                $penanggung_jawab['jenis_kelamin'] = $attr['jenis_kelamin_penanggung_jawab'];
                $penanggung_jawab['hubungan_dengan_pasien'] = $attr['hubungan_dengan_pasien'];
                $penanggung_jawab['alamat'] = $attr['alamat_penanggung_jawab'];
                PenanggungJawabPasien::create($penanggung_jawab);
            } else if ($attr['penanggung_jawab_sama_dengan_pasien'] == 'ya') {
                // Jika identitas Penanggung Jawab Pasien sama dengan identitas pasien
                $penanggung_jawab = new PenanggungJawabPasien();
                $penanggung_jawab['pemeriksaan_id'] = $pemeriksaan->id;
                $penanggung_jawab->nama = $attr['nama'];
                $penanggung_jawab->nik = $attr['nik'];
                $penanggung_jawab->no_hp = $attr['no_hp'];
                $penanggung_jawab->jenis_kelamin = $attr['jenis_kelamin'];
                $penanggung_jawab->hubungan_dengan_pasien = $attr['hubungan_dengan_pasien'];
                $penanggung_jawab->alamat = $attr['alamat'];
                $penanggung_jawab->save();
            }

            // Insert pemeriksaan detail
            $pemeriksaan_detail = PemeriksaanDetail::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'poli_id' => $attr['poli_id'],
                'layanan_id' => $attr['layanan_id'],
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

            // Aktivitas user
            activity("mendaftarkan pemeriksaan atas nama {$this->namaPasien($pasien->id)} ke poli {$this->namaPoli($attr['poli_id'])}");

            if ($attr['layanan_id'] == $this->layananPeriksaDokter) {
                //              Insert ke table periksa di poli station
                $periksa_poli_station = PeriksaPoliStation::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'pasien_id' => $pasien->id,
                    'tanggal' => $attr['tanggal']
                ]);

                //                Insert ke tabel pemeriksaan dokter
                $periksa_dokter = PeriksaDokter::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'periksa_poli_station_id' => $periksa_poli_station->id,
                    'pasien_id' => $pasien->id,
                    'dokter_id' => $attr['dokter_id'],
                    'no_antrian_periksa' => noUrutPasienPeriksa($tanggal, $pemeriksaan_detail->poli_id, $pemeriksaan_detail->dokter_id),
                    'tanggal' => $attr['tanggal'],
                    'informasi_tambahan' => $attr['informasi_tambahan'],
                    'status_diperiksa' => 'belum diperiksa'
                ]);

                //                Insert ke table kasir
                $kasir = Kasir::create([
                    'pemeriksaan_id' => $pemeriksaan->id,
                ]);
            } elseif ($attr['layanan_id'] == $this->layananPeriksaLaboratorium) {
                //                Insert ke tabel pemeriksaan laboratorium
                $periksa_lab = PeriksaLab::create([
                    'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                    'pasien_id' => $pasien->id,
                    'tanggal' => $attr['tanggal'],
                    'keterangan' => $attr['keterangan'],
                    'status_diperiksa' => 'belum diperiksa'
                ]);
            } elseif ($attr['layanan_id'] == $this->layananPeriksaRadiologi) {
                //                Insert ke tabel pemeriksaan radiologi
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
            'url' => route('pendaftaran.rawat-jalan.index')
        ], 200);
    }

    public function createPasienSudahPernahDaftar()
    {
        $title = 'Tambah Pasien';
        $kategori_pasien = $this->kategoriPasien();
        $faskes = $this->faskes();
        $layanan = $this->layanan();
        $poli = $this->poli();
        return view('admin.pendaftaran.rajal.create_pasien_terdaftar', compact(
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
                $pasien = Pasien::findOrFail($attr['pasien']);
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
                    'pasien_sudah_membaca_dan_setuju_dengan_peraturan' => $attr['pasien_sudah_membaca_dan_setuju_dengan_peraturan']
                ]);

                // Jika identitas Penanggung Jawab Pasien tidak sama dengan identitas pasien
                if ($attr['penanggung_jawab_sama_dengan_pasien'] == 'tidak') {
                    $penanggung_jawab['pemeriksaan_id'] = $pemeriksaan->id;
                    $penanggung_jawab['nama'] = $attr['nama_penanggung_jawab'];
                    $penanggung_jawab['nik'] = $attr['nik_penanggung_jawab'];
                    $penanggung_jawab['no_hp'] = $attr['no_hp_penanggung_jawab'];
                    $penanggung_jawab['jenis_kelamin'] = $attr['jenis_kelamin_penanggung_jawab'];
                    $penanggung_jawab['hubungan_dengan_pasien'] = $attr['hubungan_dengan_pasien'];
                    $penanggung_jawab['alamat'] = $attr['alamat_penanggung_jawab'];
                    PenanggungJawabPasien::create($penanggung_jawab);
                } else if ($attr['penanggung_jawab_sama_dengan_pasien'] == 'ya') {
                    // Jika identitas Penanggung Jawab Pasien sama dengan identitas pasien
                    $penanggung_jawab = new PenanggungJawabPasien();
                    $penanggung_jawab['pemeriksaan_id'] = $pemeriksaan->id;
                    $penanggung_jawab->nama = $pasien->nama;
                    $penanggung_jawab->nik = $pasien->nik;
                    $penanggung_jawab->no_hp = $pasien->no_hp;
                    $penanggung_jawab->jenis_kelamin = $pasien->jenis_kelamin;
                    $penanggung_jawab->hubungan_dengan_pasien = $attr['hubungan_dengan_pasien'];
                    $penanggung_jawab->alamat = $pasien->alamat;
                    $penanggung_jawab->save();
                }

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

                // Aktivitas user
                activity("mendaftarkan pemeriksaan atas nama {$this->namaPasien($pasien->id)} ke poli {$this->namaPoli($attr['poli_id'])}");

                if ($attr['layanan_id'] == $this->layananPeriksaDokter) {
                    //              Insert ke table periksa di poli station
                    $periksa_poli_station = PeriksaPoliStation::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal']
                    ]);

                    //                Insert ke tabel pemeriksaan dokter
                    $periksa_dokter = PeriksaDokter::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'periksa_poli_station_id' => $periksa_poli_station->id,
                        'pasien_id' => $pasien->id,
                        'dokter_id' => $attr['dokter_id'],
                        'no_antrian_periksa' => noUrutPasienPeriksa($tanggal, $pemeriksaan_detail->poli_id, $pemeriksaan_detail->dokter_id),
                        'tanggal' => $attr['tanggal'],
                        'informasi_tambahan' => $attr['informasi_tambahan'],
                        'status_diperiksa' => 'belum diperiksa'
                    ]);

                    //                Insert ke table kasir
                    $kasir = Kasir::create([
                        'pemeriksaan_id' => $pemeriksaan->id,
                    ]);
                } elseif ($attr['layanan_id'] == $this->layananPeriksaLaboratorium) {
                    //                Insert ke tabel pemeriksaan laboratorium
                    $periksa_lab = PeriksaLab::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal'],
                        'keterangan' => $attr['keterangan'],
                        'status_diperiksa' => 'belum diperiksa'
                    ]);
                    //                Insert ke table kasir
                    $kasir = Kasir::create([
                        'pemeriksaan_id' => $pemeriksaan->id,
                    ]);
                } elseif ($attr['layanan_id'] == $this->layananPeriksaRadiologi) {
                    //                Insert ke tabel pemeriksaan radiologi
                    $periksa_radiologi = PeriksaRadiologi::create([
                        'pemeriksaan_detail_id' => $pemeriksaan_detail->id,
                        'pasien_id' => $pasien->id,
                        'tanggal' => $attr['tanggal'],
                        'keterangan' => $attr['keterangan'],
                        'status_diperiksa' => 'belum diperiksa'
                    ]);
                    //                Insert ke table kasir
                    $kasir = Kasir::create([
                        'pemeriksaan_id' => $pemeriksaan->id,
                    ]);
                }
            }
        );

        return response()->json([
            'message' => 'Pasien berhasil ditambahkan',
            'url' => route('pendaftaran.rawat-jalan.index')
        ], 200);
    }

    public function searchPasien(Request $request)
    {
        $query = $request->get('data');

        $data = DB::table('pasien as p')
            ->selectRaw('
            p.id, p.nik, p.nama
            ')
            ->join('rekam_medis as rm', 'rm.pasien_id', '=', 'p.id')
            ->where("nik", "LIKE", "%{$query}%")
            ->orWhere("nama", "LIKE", "%{$query}%")
            ->get();

        $output = '<div class="dropdown-menu d-block position-relative">';
        foreach ($data as $item) {
            $output .= '
                <a href="#" class="item dropdown-item" onclick="pilihData(`' . $item->id . '`,`' . route('pendaftaran.rawat-jalan.change-pasien') . '`)">' . $item->nama . ' (' . $item->nik . ') </a>
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

        DB::transaction(function () use ($pemeriksaan) {
            activity("menghapus pemeriksaan pasien {$this->namaPasien($pemeriksaan->pasien_id)}");

            $pemeriksaan_detail = DB::table('pemeriksaan_detail')
                ->where('pemeriksaan_id', $pemeriksaan->id)
                ->delete();
            $pemeriksaan->delete();
        });

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'url' => route('pendaftaran.rawat-jalan.index')
        ], 200);
    }
}
