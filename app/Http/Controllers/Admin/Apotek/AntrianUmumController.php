<?php

namespace App\Http\Controllers\Admin\Apotek;

use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use App\Models\ObatPasienRajal;
use App\Models\PemeriksaanDetail;
use App\Models\PosisiPasienRajal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PosisiDetailPasienRajal;
use App\Repositories\Interfaces\ApotekInterface;
use App\Repositories\Interfaces\DokterInterface;

class AntrianUmumController extends Controller
{
    private $apotekRepository;
    private $dokterRepository;
    public  $perPage = 12;


    public function __construct(ApotekInterface $apotekRepository, DokterInterface $dokterRepository)
    {
        $this->apotekRepository = $apotekRepository;
        $this->dokterRepository = $dokterRepository;
    }

    public function umum()
    {
        $data = $this->apotekRepository->antrianApotekUmum()->paginate($this->perPage);
        // return $data;
        $total = $this->apotekRepository->antrianApotekUmum()->count();
        $title = 'Antrian Umum';
        $perPage = $this->perPage;
        $badge = $this->badge();
        return view('admin.apotek.antrian_umum.index', compact(
            'data',
            'title',
            'perPage',
            'total',
            'badge'
        ));
    }

    function _fetchUmum(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotekUmum()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('rm.kode', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.apotek.antrian_umum._fetch-umum', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }

    public function detailPasienUmum($pasien_umum)
    {
        $pasien = DB::table('periksa_dokter as po')
            ->selectRaw('
                    po.id as periksa_dokter_id, ps.nama as nama_pasien, ps.tanggal_lahir, ps.alamat, 
                    pm.no_rekam_medis, do.nama as nama_dokter, pl.nama as spesialis, kt.nama as kategori_pasien,
                    pm.id as pemeriksaan_id,pm.tanggal as tanggal_pemeriksaan, pm.status as status_pemeriksaan
                ')
            ->join('pemeriksaan_detail as pd', 'pd.id', '=', 'po.pemeriksaan_detail_id')
            ->join('pemeriksaan as pm', 'pm.id', '=', 'pd.pemeriksaan_id')
            ->join('pasien as ps', 'ps.id', '=', 'po.pasien_id')
            ->join('dokter as do', 'do.id', '=', 'po.dokter_id')
            ->join('poli as pl', 'pl.id', '=', 'pd.poli_id')
            ->join('kategori_pasien as kt', 'kt.id', '=', 'pm.kategori_pasien')
            ->where('po.id', $pasien_umum)
            ->first();
        // return $pasien;
        $title = 'Detail Pasien';
        return view('admin.apotek.antrian_umum._pasien-umum', compact(
            'pasien',
            'title'
        ));
    }

    public function pasienUmum($pemeriksaan_id, $periksa_dokter_id)
    {
        // Pemeriksaan pasien umum
        $res  = $this->apotekRepository->identitasPasien($periksa_dokter_id);

        // Obat pasien umum
        $obat = $this->apotekRepository->obatUmum($pemeriksaan_id);

        // Update pasien checkin apotek
        $posisi_pasien = PosisiPasienRajal::where('pemeriksaan_id', $pemeriksaan_id)->firstOrFail();
        if ($posisi_pasien->status == 'proses obat') {
            $posisi_pasien->update([
                'status' => 'proses apotek'
            ]);

            $user = auth()->user()->name;
            $aktifitas = "Pasien sedang diproses di apotek oleh {$user}";
            $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                'posisi_pasien_rajal_id' => $posisi_pasien->id,
                'aktifitas' => $aktifitas,
                'waktu' => now(),
                'keterangan' => 'checkin',
                'status' => 'proses'
            ]);
        }

        return view('admin.apotek.antrian_umum._proses-pasien-umum', compact(
            'res',
            'obat',
            'periksa_dokter_id'
        ));
    }

    public function prosesPasienUmum(Request $request)
    {
        $attr = $request->all();

        DB::transaction(
            function () use ($attr) {
                // Query pemeriksaa
                $pemeriksaan = Pemeriksaan::find($attr['pemeriksaan_id']);

                // Query pemeriksaan detail
                $pemeriksaan_detail = PemeriksaanDetail::where('pemeriksaan_id', '=', $pemeriksaan->id)
                    ->first();

                // Query obat pasien
                $periksaDokter = PeriksaDokter::where('pemeriksaan_detail_id', '=', $attr['periksa_dokter_id'])->first();
                $obatPasien = ObatPasienRajal::where('periksa_dokter_id', '=', $periksaDokter->id)
                    ->get();

                // Update status pemeriksaan
                $pemeriksaan->update([
                    'status' => 'selesai'
                ]);

                // Update status pemeriksaan detail
                $pemeriksaan_detail->update([
                    'status' => 'selesai'
                ]);

                // Update status obat pasien rajal
                foreach ($obatPasien as $obat) {
                    $obat->update([
                        'status' => 'sudah diterima'
                    ]);
                }

                // Query checkout pasien apotek
                $posisi_pasien = PosisiPasienRajal::where('pemeriksaan_id', $pemeriksaan->id)->firstOrFail();

                if ($posisi_pasien->status == 'proses apotek') {
                    $posisi_pasien->update([
                        'status' => 'selesai'
                    ]);

                    // Update pasien checkout apotek
                    $res = PosisiDetailPasienRajal::where('posisi_pasien_rajal_id', $posisi_pasien->id)->latest('waktu');
                    $res->update([
                        'status' => 'selesai'
                    ]);

                    $user = auth()->user()->name;
                    $aktifitas = "Pasien sudah selesai diproses di apotek oleh {$user}";
                    $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                        'posisi_pasien_rajal_id' => $posisi_pasien->id,
                        'aktifitas' => $aktifitas,
                        'waktu' => now(),
                        'keterangan' => 'checkout',
                        'status' => 'selesai'
                    ]);
                }
            }
        );
        return response()->json([
            'message' => 'Status berhasil di ubah!',
            'url'     => route('data.umum')
        ], 200);
    }

    public function previewPDF($pemeriksaan_id, $periksa_dokter_id)
    {
        $query = $this->apotekRepository->identitasPasien($periksa_dokter_id);
        $drug  = $this->apotekRepository->obatBpjs($pemeriksaan_id);
        // return $query;
        return view('admin.apotek.antrian_umum.pdf.hasil', compact(
            'query',
            'drug'
        ));
    }
}
