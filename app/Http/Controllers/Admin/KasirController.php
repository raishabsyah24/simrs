<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\KasirInterface;

class KasirController extends Controller
{
    private $kasirRepository;

    public function __construct(KasirInterface $kasirRepository)
    {
        $this->kasirRepository = $kasirRepository;
        $data = DB::table('periksa_radiologi')
            ->selectRaw('id, pemeriksaan_detail_id, periksa_dokter_id, dokter_id, pasien_id, tanggal, status_diperiksa, created_at  ')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        $title = 'Aktifitas User';
        $badge = $this->badge();
        // $total = Layanan::count();
        return view('admin.kasir.umumkasir', compact(
            'title',
            'data',
            // 'total',
            'badge'
        ));
    }

    public function index()
    {
        $data = $this->kasirRepository->kasir();
        return view('admin.kasir.index', compact(
            'data'
        ));
    }
}
