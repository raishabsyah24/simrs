<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KasirController extends Controller
{
    public $perPage = 10;

    public function kasir_bpjs()
    {
        $data = DB::table('periksa_radiologi')
            ->selectRaw('id, pemeriksaan_detail_id, periksa_dokter_id, dokter_id, pasien_id, tanggal, status_diperiksa, created_at  ')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        $title = 'Aktifitas User';
        $badge = $this->badge();
        // $total = Layanan::count();
        return view('admin.kasir.bpjs', compact(
            'title',
            'data',
            // 'total',
            'badge'
        ));
    }

    public function kasir_umum()
    {
        $data = DB::table('periksa_radiologi')
            ->selectRaw('id, pemeriksaan_detail_id, periksa_dokter_id, dokter_id, pasien_id, tanggal, status_diperiksa, created_at  ')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        $title = 'Aktifitas User';
        $badge = $this->badge();
        // $total = Layanan::count();
        return view('admin.kasir.umum', compact(
            'title',
            'data',
            // 'total',
            'badge'
        ));
    }

    public function kasir_otc()
    {
        $data = DB::table('periksa_radiologi')
            ->selectRaw('id, pemeriksaan_detail_id, periksa_dokter_id, dokter_id, pasien_id, tanggal, status_diperiksa, created_at  ')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        $title = 'Aktifitas User';
        $badge = $this->badge();
        // $total = Layanan::count();
        return view('admin.kasir.otc', compact(
            'title',
            'data',
            // 'total',
            'badge'
        ));
    }
}
