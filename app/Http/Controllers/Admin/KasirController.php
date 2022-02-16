<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kasir;
use App\Repositories\Interfaces\KasirInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\KasirInterface;

class KasirController extends Controller
{
    public $kasirRepository;
    public function __construct(KasirInterface $kasirRepository)
    {
        $this->kasirRepository = $kasirRepository;
    }
    public $perPage = 10;

    public function index()
    {
        $data = $this->kasirRepository->kasir()
            ->paginate($this->perPage);
        $title = 'Kasir';
        $badge = $this->badge();
        $kategori_pasien = $this->kategoriPasien();
        return view('admin.kasir.index', compact(
            'title',
            'data',
            'badge',
            'kategori_pasien'
        ));
    }

    // Search data pasien dikasir page
    public function fetch(Request $request)
    {
        $title = 'Kasir';
        $q = $request->get('query');
        $kategori = $request->get('kategori');
        $status = $request->get('status');
        $badge = $this->badge();
        $data = $this->kasirRepository->kasir()
            ->when($q ?? false, function ($query) use ($q) {
                return $query->where('p.nama', 'like', "%{$q}%")
                    ->orWhere('p.no_hp', 'like', "%{$q}%")
                    ->orWhere('p.tanggal_lahir', 'like', "%{$q}%")
                    ->orWhere('kp.nama', 'like', "%{$q}%")
                    ->orWhere('k.grand_total', 'like', "%{$q}%")
                    ->orWhere('k.status', 'like', "%{$q}%")
                    ->orWhere('k.status_pembayaran', 'like', "%{$q}%");
            })
            ->when($kategori ?? false, function ($query) use ($kategori) {
                if ($kategori == 'semua') {
                    return false;
                }
                return $query->where('kp.id', $kategori);
            })
            ->when($status ?? false, function ($query) use ($status) {
                if ($status == 'semua') {
                    return false;
                }
                return $query->where('k.status', $status);
            })
            ->when($status && $kategori ?? false, function ($query) use ($status, $kategori) {
                if ($status == 'semua') {
                    return false;
                } else if ($kategori == 'semua') {
                    return false;
                }
                return $query->where('k.status', $status)
                    ->orWhere('kp.id', $kategori);
            })
            ->paginate($this->perPage);
        return view(
            'admin.kasir.fetch',
            compact('data', 'badge')
        )
            ->render();
    }

    public function show(Kasir $kasir)
    {
        if (request()->ajax()) {
            $diskon = ($kasir->diskon / 100) * $kasir->grand_total;
            $pajak = ($kasir->pajak / 100) * $kasir->grand_total;
            $total = ($kasir->total_tagihan - $diskon) + $pajak;
            return response()->json([
                'grand_total' => formatAngka($total, true),
            ], 200);
        }
        $title = "Detail Transaksi";
        $identitas_pasien = $this->kasirRepository->identitasPasien($kasir->id);
        $layanan = $this->kasirRepository->daftarLayanan($kasir->id);
        $obat_pasien_rajal = $this->kasirRepository->obatPasienRajal($kasir->id);

        return view('admin.kasir.show', compact(
            'identitas_pasien',
            'layanan',
            'obat_pasien_rajal',
            'title',
            'kasir'
        ));
    }

    public function updateTagihan(Kasir $kasir, Request $request)
    {
        $attr = $request->validate([
            'diskon' => 'numeric|max:100',
            'pajak' => 'numeric|max:100',
        ]);

        if ($attr) {
            $kasir->update([
                'diskon' => $request->diskon,
            ]);
        }
    }
}
