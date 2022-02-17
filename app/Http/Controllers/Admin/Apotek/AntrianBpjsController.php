<?php

namespace App\Http\Controllers\Admin\Apotek;

use PDF;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\ObatApotek;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\PeriksaDokter;
use App\Models\ObatPasienRajal;
use App\Models\PemeriksaanDetail;
use App\Models\PosisiPasienRajal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\PosisiDetailPasienRajal;
use App\Repositories\Interfaces\ApotekInterface;
use App\Repositories\Interfaces\DokterInterface;

class AntrianBpjsController extends Controller
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
        $data = $this->apotekRepository->antrianApotekBpjs()->paginate($this->perPage);
        // return $data;
        $kategori = $this->kategoriPasien();
        $total = $this->apotekRepository->antrianApotekBpjs()->count();
        $title = 'Antrian Bpjs';
        $per_page = $this->perPage;
        $badge = $this->badge();
        return view('admin.apotek.antrian_bpjs._daftar-antrian', compact(
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
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = $this->apotekRepository->antrianApotekBpjs()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('pe.id', 'like', '%' . $q . '%')
                        ->orWhere('pe.no_rekam_medis', 'like', '%' . $q . '%')
                        ->orWhere('p.nama', 'like', '%' . $q . '%');
                })
                ->orderBy('pe.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.apotek.antrian_bpjs._fetch-data_bpjs', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }

    public function detailPasienBpjs($pasien_bpjs)
    {
        $pasien = DB::table('pemeriksaan as pi')
            ->selectRaw('
                   DISTINCT pi.id as pemeriksaan_id, cr.id as kasir_id, ps.nama as nama_pasien, ps.tanggal_lahir,
                    ps.jenis_kelamin, ps.golongan_darah, pi.no_rekam_medis,
                    dk.nama as nama_dokter, pl.spesialis, pi.tanggal as tanggal_pemeriksaan
        ')
            ->join('pasien as ps', 'pi.pasien_id', '=', 'ps.id')
            ->join('kasir as cr', 'cr.pemeriksaan_id', '=', 'cr.id')
            ->join('dokter as dk', 'dk.id', '=', 'dk.id')
            ->join('dokter_poli as dp', 'dp.dokter_id', 'dk.id')
            ->join('poli as pl', 'dp.dokter_id', '=', 'pl.id')
            ->where('ps.id', '=', $pasien_bpjs)
            ->first();

        $obat = DB::table('obat_pasien_periksa_rajal as ob')
            ->selectRaw('
                   DISTINCT ob.id as obat_pasien_rajal_id, o.nama_generik, ob.jumlah, ob.signa1, ob.signa2,
                   ob.harga_obat, ob.subtotal
                ')
            ->join('obat_apotek as ot', 'ot.id', '=', 'ob.obat_apotek_id')
            ->join('obat as o', 'o.id', '=', 'ot.obat_id')
            ->join('periksa_dokter as pd', 'pd.id', '=', 'ob.periksa_dokter_id')
            ->join('pasien as pe', 'pe.id', '=', 'pd.pasien_id')
            ->where('pd.id', '=', $pasien_bpjs)
            ->get();
        // return $obat;
        $title = 'Detail Pasien';
        $head  = 'Informasi Pasien';
        return view('admin.apotek.antrian_bpjs._pasien-bpjs', compact(
            'title',
            'head',
            'pasien',
            'obat'
        ));
    }

    public function obatApotek($pemeriksaan_id, $periksa_dokter_id)
    {
        // Pemeriksaan pasien bpjs
        $pasien = $this->apotekRepository->pasienBpjs($pemeriksaan_id);

        // Obat pasien bpjs
        $obat = $this->apotekRepository->obatBpjs($pemeriksaan_id);

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

        return view('admin.apotek.antrian_bpjs._proses-pasien-bpjs', compact(
            'pasien',
            'obat',
            'periksa_dokter_id'
        ));
    }

    public function prosesPasienBpjs(Request $request)
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
                    $aktifitas = "Pasien telah selesai di apotek oleh {$user}";
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
            'url'     => route('data.antrian.bpjs')
        ], 200);
    }

    public function previewPDF($pemeriksaan_id, $periksa_dokter_id)
    {
        $query = $this->apotekRepository->pasienBpjs($pemeriksaan_id);
        $drug  = $this->apotekRepository->obatBpjs($pemeriksaan_id);
        // return $query;
        return view('admin.apotek.antrian_bpjs.pdf.hasil', compact(
            'query',
            'drug'
        ));

        // // Cek jika ada file pdf sebelumnya
        // if ($query(['pemeriksaan_id'])->filename_pdf) {
        //     $path = public_path('swab/') . $query(['pemeriksaan_id'])->filename_pdf;

        //     // Hapus file pdf
        //     File::delete($path);
        // }

        // // Set filename pdf baru
        // $data['filename'] = str_replace(' ', '', $query(['pemeriksaan_id'])->nama) . '_' . time() . uniqid() . '.pdf';

        // // create pdf file baru
        // $pdf = \PDF::loadView('admin.apotek.antrian_bpjs.pdf.hasil', compact('query'));
        // $path = public_path('swab/') . $data['filename'];
        // $pdf->save($path);
    }

    public function print()
    {
        // 
    }
}
