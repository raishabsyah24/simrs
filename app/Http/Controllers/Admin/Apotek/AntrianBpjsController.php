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
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanDetail;
use App\Models\PeriksaDokter;
use Illuminate\Support\Facades\Auth;
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
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('rm.kode', 'like', '%' . $q . '%')
                        ->orWhere('pd.pasien_id', 'like', '%' . $q . '%')
                        ->orWhere('pn.tanggal_lahir', 'like', '%' . $q . '%')
                        ->orWhere('pl.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('pd.dokter_id', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
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
            ->leftJoin('dokter as dk', 'dk.id', '=', 'dk.id')
            ->rightJoin('dokter_poli as dp', 'dp.dokter_id', 'dk.id')
            ->rightJoin('poli as pl', 'dp.dokter_id', '=', 'pl.id')
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

    public function obatApotek($approve_pasien)
    {
        $pasien = DB::table('pemeriksaan as pi')
            ->selectRaw('
            DISTINCT pi.id as pemeriksaan_id, cr.id as kasir_id, ps.nama as nama_pasien, ps.tanggal_lahir,
                 ps.jenis_kelamin, ps.golongan_darah, pi.no_rekam_medis,dk.nama as nama_dokter, pl.spesialis,
                 pi.tanggal as tanggal_pemeriksaan, pi.status
            ')
            ->join('pasien as ps', 'pi.pasien_id', '=', 'ps.id')
            ->join('kasir as cr', 'cr.pemeriksaan_id', '=', 'cr.id')
            ->leftJoin('dokter as dk', 'dk.id', '=', 'dk.id')
            ->rightJoin('dokter_poli as dp', 'dp.dokter_id', 'dk.id')
            ->rightJoin('poli as pl', 'dp.dokter_id', '=', 'pl.id')
            ->where('ps.id', '=', $approve_pasien)
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
            ->where('pd.id', '=', $approve_pasien)
            ->get();

        // return $pasien;

        return view('admin.apotek.antrian_bpjs._proses_pasien', compact(
            'pasien',
            'obat'
        ));
    }

    public function prosesPasienBpjs(Request $request, $pemeriksaan_id)
    {

        $attr = $request->all();
        $tipe = $request->pasien_id;

        DB::transaction(
            function () use ($attr, $pemeriksaan_id) {
                $pemeriksaan = Pemeriksaan::find($pemeriksaan_id);
                $pemeriksaan_detail = PemeriksaanDetail::find($pemeriksaan_id);
                $pasien = Pasien::find($pemeriksaan->pasien_id);

                // Cari id pemeriksaan
                $pemeriksaan_id = Pemeriksaan::where('id', '=', $pemeriksaan_id)->first();

                // Update ke table pemeriksaan
                $pemeriksaan->update([
                    'status' => 'selesai'
                ]);

                // Cari id pemeriksaan detail
                $pemeriksaan_detail_id = PemeriksaanDetail::where('pemeriksaan_id', '=', $pemeriksaan_id)->first();


                // Update ke table pemeriksaan detail
                $pemeriksaan_detail->update([
                    'status' => 'selesai'
                ]);
            }
        );
        return response()->json([
            'message' => 'Status berhasil di ubah!',
            'url'     => route('data.antrian.bpjs')
        ], 200);
    }
}
