<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class RadiologiController extends Controller
{
    public $perPage = 10;


    public function radiologi_otc()
    {
        $data = DB::table('periksa_radiologi')
            ->selectRaw('id, pemeriksaan_detail_id, periksa_dokter_id, dokter_id, pasien_id, tanggal, status_diperiksa, created_at  ')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        $title = 'Aktifitas User';
        $badge = $this->badge();
        // $total = Layanan::count();
        return view('admin.radiologi.otcradio', compact(
            'title',
            'data',
            // 'total',
            'badge'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $badge = $this->badge();
            $data = DB::table('activity_logs')
                ->selectRaw('id, nama, email, aktifitas, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%');
                })
                ->when(!empty($dari) && !empty($sampai) ?? false, function ($query) use ($dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->whereBetween('created_at', [$dari, $sampai]);
                })
                ->when(!empty($dari) && !empty($sampai && $q) ?? false, function ($query) use ($q, $dari, $sampai) {
                    $dari = Carbon::parse($dari)->startOfDay();
                    $sampai = Carbon::parse($sampai)->endOfDay();
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('nama', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('aktifitas', 'like', '%' . $q . '%')
                        ->orWhere('created_at', 'like', '%' . $q . '%')
                        ->whereBetween('created_at', [$dari, $sampai]);
                })
                ->orderBy('created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.activity_log.fetch', compact(
                'data',
                'badge'
            ))->render();
        }
    }


    public function radiologi_umum()
    {
        $data = DB::table('pemeriksaan as pem')
            ->selectRaw('pem.no_rekam_medis ,p.nama as nama_pasien ,p.jenis_kelamin, p.tempat_lahir, p.tanggal_lahir, p.agama, kp.nama as kategori_pasien, p.nik, d.nama as nama_dokter')
            ->join('pasien as p','p.id','=','pem.pasien_id')
            ->join('kategori_pasien as kp','kp.id','=','pem.kategori_pasien')
            ->join('pemeriksaan_detail as pd','pd.pemeriksaan_id','=','pem.id')
            ->join('dokter as d','d.id','=','pd.dokter_id')
            ->orderByDesc('pem.created_at')
            ->paginate($this->perPage);
            // return $data;
        $title = 'Aktifitas User';
        $badge = $this->badge();
        $total = Layanan::count();
        return view('admin.radiologi.umumradio', compact(
            'title',
            'data',
            'total',
            'badge'
        ));
    }
}
