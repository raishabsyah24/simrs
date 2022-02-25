<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use DB;
use App\Models\Pasien;
use App\Models\Ruangan;
use App\Models\RawatInap;
use App\Models\RekamMedis;
use App\Models\KamarPasien;
use Illuminate\Http\Request;
use App\Models\KasirRawatInap;
use App\Models\PosisiPasienRanap;
use App\Http\Controllers\Controller;
use App\Models\PenanggungJawabPasien;
use App\Models\PosisiDetailPasienRanap;
use App\Repositories\Interfaces\PendaftaranRawatInapInterface;
use App\Http\Requests\Admin\PendaftaranRawatInapPasienBaruRequest;

class RawatInapController extends Controller
{
    public $perPage = 10;
    public $pasienBpjs  = 1;
    public $pasienUmum  = 2;
    public $pasienAsuransi  = 3;

    private $pendaftaranRepository;

    public function __construct(PendaftaranRawatInapInterface $pendaftaranRepository)
    {
        $this->pendaftaranRepository = $pendaftaranRepository;
    }

    public function index()
    {
        $data = $this->pendaftaranRepository->pasienHariIni()
            ->paginate($this->perPage);
        $title = 'Pendaftaran Rawat Inap';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        $nurse_station = $this->nurseStation();
        return view('admin.pendaftaran.ranap.index', compact(
            'title',
            'data',
            'badge',
            'kategori_pasien',
            'nurse_station',
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $kategori = $request->get('kategori');
            $ns = $request->get('ns');
            $badge = $this->badge();
            $data = $this->pendaftaranRepository->pasienHariIni()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('p.nama', 'like', '%' . $q . '%')
                        ->orWhere('p.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('p.nik', 'like', '%' . $q . '%')
                        ->orWhere('p.jenis_kelamin', 'like', '%' . $q . '%')
                        ->orWhere('ri.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('ri.created_at', 'like', '%' . $q . '%')
                        ->orWhere('ns.nama', 'like', '%' . $q . '%')
                        ->orWhere('kp.nama', 'like', '%' . $q . '%')
                        ->orWhere('r.kode_kamar', 'like', '%' . $q . '%')
                        ->orWhere('r.kode_bed', 'like', '%' . $q . '%');
                })
                ->when($kategori ?? false, function ($query) use ($kategori) {
                    if ($kategori == 'semua') {
                        return false;
                    }
                    return $query->where('kp.id', $kategori);
                })
                ->when($ns ?? false, function ($query) use ($ns) {
                    if ($ns == 'semua') {
                        return false;
                    }
                    return $query->where('ns.id', $ns);
                })
                ->paginate($this->perPage);
            return view('admin.pendaftaran.ranap.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }

    public function create()
    {
        $title = 'Tambah Pasien Rawat Inap';
        $kategori_pasien = $this->kategoriPasien();
        $asuransi = $this->asuransi();
        $nurse_station = $this->nurseStation();
        return view('admin.pendaftaran.ranap.create', compact(
            'title',
            'kategori_pasien',
            'asuransi',
            'nurse_station'
        ));
    }

    public function getNurseStation(Request $request)
    {
        $data = $this->pendaftaranRepository->nurseStation($request->nurse_station_id);
        $output = '<div class="row">';
        foreach ($data as $item) {
            if ($item->status_bed == 'tersedia') {
                $output .= '
                <div class="col-md-3 mt-3">
                    <div class="card shadow-sm">
                        <div class="card-inner">
                            <div class="team">
                                <div class="user-card user-card-s2">
                                    <div class="user-avatar md bg-primary">
                                        ' . $item->kode_kamar . '
                                    </div>
                                    <div class="user-info">
                                        <h6>' . $item->status_bed . '</h6>
                                    </div>
                                    <div class="user-info">
                                        <h6>' . formatAngka($item->tarif, true) . ' / perhari</h6>
                                    </div>
                                </div>
                                <ul class="team-statistics">
                                    <li><span>' . $item->kelas . '</span><span>Kelas</span></li>
                                    <li><span>' . $item->kode_bed . '</span><span>Kode Bed</span></li>
                                </ul>
                                <div class="team-view">
                                    <button type="button" onclick="pilihRuangan(`' . $item->ruangan_id . '`,`' . 'ruangan ' . $item->kode_kamar . ' - bed ' . $item->kode_bed . '`)" class="btn btn-round btn-success w-150px"><span>Pilih Kamar</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            } else {
                $output .= '
                <div class="col-md-3 mt-3">
                    <div class="card shadow-sm">
                        <div class="card-inner">
                            <div class="team">
                                <div class="user-card user-card-s2">
                                    <div class="user-avatar md bg-primary">
                                        ' . $item->kode_kamar . '
                                    </div>
                                    <div class="user-info">
                                        <h6>' . $item->status_bed . '</h6>
                                    </div>
                                    <div class="user-info">
                                        <h6>' . formatAngka($item->tarif, true) . ' / perhari</h6>
                                    </div>
                                </div>
                                <ul class="team-statistics">
                                    <li><span>' . $item->kelas . '</span><span>Kelas</span></li>
                                    <li><span>' . $item->kode_bed . '</span><span>Kode Bed</span></li>
                                </ul>
                                <div class="team-view">
                                    <button disabled type="button" class="btn btn-round btn-danger w-150px"><span>Kamar Terisi</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            }
        }
        $output .= '</div>';

        return response()->json([
            'output' => $output
        ], 200);
    }

    public function store(PendaftaranRawatInapPasienBaruRequest $request)
    {
        $attr = $request->all();
        $attr['kode'] = kodePasienRanap();


        DB::transaction(function () use ($attr) {
            // Insert Pasien
            $pasien = Pasien::create($attr);

            // Insert rekam medis jika belum ada
            $rm = RekamMedis::where('pasien_id', $pasien->id)->first();
            if (!$rm) {
                $rekam_medis = RekamMedis::create([
                    'kode' => kodeRekamMedis(),
                    'pasien_id' => $pasien->id
                ]);
            }
            $attr['no_rekam_medis'] = $rekam_medis->kode;
            $attr['pasien_id'] = $pasien->id;
            $attr['posisi_pasien'] = 'selesai mendaftar di pendaftaran rawat inap';
            $attr['tanggal'] = today();
            $attr['status'] = 'belum selesai';

            // Insert rawat Inap
            $rawat_inap = RawatInap::create($attr);

            // Insert ruangan / kamar pasien
            $kamar_pasien = KamarPasien::create([
                'rawat_inap_id' => $rawat_inap->id,
                'ruangan_id' => $attr['ruangan_id'],
            ]);

            // Update ruangan terpakai
            $ruangan = Ruangan::findOrFail($attr['ruangan_id']);
            $ruangan->update(['status_bed' => 'dibooking']);

            // Insert table kasir rawat inap
            $kasir_rawat_inap = new KasirRawatInap();
            $kasir_rawat_inap->rawat_inap_id = $rawat_inap->id;
            if ($attr['kategori_pasien'] == $this->pasienUmum) {
                $kasir_rawat_inap->deposit_awal = $attr['deposit_awal'];
                $kasir_rawat_inap->tanggal_deposit = now();
            }
            $kasir_rawat_inap->save();

            // Jika identitas Penanggung Jawab Pasien tidak sama dengan identitas pasien
            if ($attr['penanggung_jawab_sama_dengan_pasien'] == 'tidak') {
                $penanggung_jawab['rawat_inap_id'] = $rawat_inap->id;
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
                $penanggung_jawab['rawat_inap_id'] = $rawat_inap->id;
                $penanggung_jawab->nama = $pasien->nama;
                $penanggung_jawab->nik = $pasien->nik;
                $penanggung_jawab->no_hp = $pasien->no_hp;
                $penanggung_jawab->jenis_kelamin = $pasien->jenis_kelamin;
                $penanggung_jawab->hubungan_dengan_pasien = $attr['hubungan_dengan_pasien'];
                $penanggung_jawab->alamat = $pasien->alamat;
                $penanggung_jawab->save();
            }

            // Insert posisi pasien saat ini
            $posisi_pasien_ranap = PosisiPasienRanap::create([
                'rawat_inap_id' => $rawat_inap->id,
                'status' => 'proses checkin'
            ]);
            $posisi_detail_pasien_ranap = PosisiDetailPasienRanap::create([
                'posisi_pasien_ranap_id' => $posisi_pasien_ranap->id,
                'aktifitas' => "Pasien selesai melakukan pendaftaran rawat inap menuju " . $this->namaRuangan($ruangan->id),
                'waktu' => now(),
                'status' => 'selesai'
            ]);
        });

        return response()->json([
            'message' => 'Pasien rawat inap berhasil ditambahkan',
            'url' => route('pendaftaran.rawat-inap.index')
        ], 200);
    }

    public function namaRuangan($ruangan_id)
    {
        $ruangan = DB::table('ruangan as r')
            ->selectRaw('r.nurse_station_id, r.kode_kamar, r.kode_bed')
            ->where('r.id', $ruangan_id)
            ->first();

        $ns = DB::table('nurse_station as ns')
            ->selectRaw('ns.nama')
            ->where('ns.id', $ruangan->nurse_station_id)
            ->first();

        $nama_ruangan = "Nurse station $ns->nama, nomor ruangan $ruangan->kode_kamar, nomor bed $ruangan->kode_bed";
        return $nama_ruangan;
    }
}
