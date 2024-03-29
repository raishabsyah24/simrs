<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{PosisiDetailPasienRajal, Kasir, PosisiPasienRajal};
use App\Repositories\Interfaces\KasirInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\KasirExport;
use Maatwebsite\Excel\Facades\Excel;

class KasirController extends Controller
{
    public $perPage = 10;
    public $kasirRepository;
    public function __construct(KasirInterface $kasirRepository)
    {
        $this->kasirRepository = $kasirRepository;
    }

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

    public function proses(Kasir $kasir)
    {
        if (request()->ajax()) {
            $total = $this->totalTagihan($kasir->id);
            return response()->json([
                'totalAngka' => $total,
                'total' => formatAngka($total, true),
                'deposit_awal' => formatAngka($kasir->deposit_awal, true),
            ], 200);
        }

        $posisi_pasien = $this->kasirRepository->posisiPasien($kasir->id);
        if ($posisi_pasien->status == 'proses kasir') {
            $posisi = PosisiPasienRajal::findOrFail($posisi_pasien->posisi_pasien_rajal_id);
            $posisi->update([
                'status' => 'proses transaksi'
            ]);

            $user = auth()->user()->name;
            $aktifitas = "Pasien sedang diproses di kasir oleh {$user}";
            $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                'posisi_pasien_rajal_id' => $posisi->id,
                'aktifitas' => $aktifitas,
                'waktu' => now(),
                'keterangan' => 'checkin',
                'status' => 'proses'
            ]);
        }
        $title = "Proses Transaksi";
        $identitas_pasien = $this->kasirRepository->identitasPasien($kasir->id);
        $layanan = $this->kasirRepository->daftarLayanan($kasir->id);
        $obat_pasien_rajal = $this->kasirRepository->obatPasienRajal($kasir->id);

        return view('admin.kasir.proses', compact(
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
            'diskon' => 'numeric|max:100|nullable',
            'pajak' => 'numeric|max:100|nullable',
        ]);

        $diskon = $request->diskon;
        $pajak = $request->pajak;

        if ($diskon != null) {
            $kasir->update([
                'diskon' => $diskon,
            ]);
        } else {
            $kasir->update([
                'diskon' => 0,
            ]);
        }
        if ($pajak != null) {
            $kasir->update([
                'pajak' => $pajak,
            ]);
        } else {
            $kasir->update([
                'pajak' => 0,
            ]);
        }

        return response()->json([
            'message' => 'Update berhasil'
        ]);
    }

    public function updateStatus(Kasir $kasir, Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'dibayar' => 'required|numeric',
        ]);
        $attr = $request->only([
            'metode_pembayaran', 'status_pembayaran', 'dibayar'
        ]);
        $attr['status'] = 'sudah dilayani';
        $attr['tanggal_pembayaran'] = now();
        $attr['admin'] = auth()->id();
        $attr['kode'] = kodePembayaranRajal();

        DB::transaction(function () use ($attr, $kasir) {
            $kasir->update($attr);

            $pemeriksaan = DB::table('pemeriksaan as p')
                ->selectRaw('p.pasien_id')
                ->whereId($kasir->pemeriksaan_id)
                ->first();
            // Aktivitas user
            activity("memproses pasien {$this->namaPasien($pemeriksaan->pasien_id)} dikasir");

            $posisi_pasien = $this->kasirRepository->posisiPasien($kasir->id);
            if ($posisi_pasien->status == 'proses transaksi') {
                $posisi = PosisiPasienRajal::findOrFail($posisi_pasien->posisi_pasien_rajal_id);
                $posisi->update([
                    'status' => 'proses obat'
                ]);

                $posisi_detail_pasien_rajal_last = PosisiDetailPasienRajal::where('posisi_pasien_rajal_id', $posisi->id)->latest('waktu');
                $posisi_detail_pasien_rajal_last->update(['status' => 'selesai']);

                $user = auth()->user()->name;
                $aktifitas = "Pasien selesai diproses di kasir oleh {$user}";
                $posisi_detail_pasien_rajal = PosisiDetailPasienRajal::create([
                    'posisi_pasien_rajal_id' => $posisi->id,
                    'aktifitas' => $aktifitas,
                    'waktu' => now(),
                    'keterangan' => 'checkout',
                    'status' => 'selesai'
                ]);
            }
        });

        return response()->json([
            'message' => 'Transaksi berhasil dilakukan',
            'url' => route('kasir.index')
        ], 200);
    }

    public function show(Kasir $kasir)
    {
        if (request()->ajax()) {
            $total = $this->totalTagihan($kasir->id);
            return response()->json([
                'total' => formatAngka($total, true),
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

    public function tambahDeposit(Kasir $kasir, Request $request)
    {
        $attr = $request->validate([
            'deposit_awal' => 'required|numeric|min:1'
        ]);

        $kasir->deposit_awal = $kasir->deposit_awal + $attr['deposit_awal'];
        if (!$kasir->tanggal_deposit) {
            $kasir->tanggal_deposit = now();
        }
        $kasir->update();

        return response()->json([
            'message' => 'Deposit pasien berhasil ditambahkan'
        ], 200);
    }

    public function detail(Kasir $kasir)
    {
        $title = "Detail Transaksi";
        $identitas_pasien = $this->kasirRepository->identitasPasien($kasir->id);
        $layanan = $this->kasirRepository->daftarLayanan($kasir->id);
        $obat_pasien_rajal = $this->kasirRepository->obatPasienRajal($kasir->id);

        return view('admin.kasir.detail', compact(
            'identitas_pasien',
            'layanan',
            'obat_pasien_rajal',
            'title',
            'kasir'
        ));
    }

    public function printInvoice(Kasir $kasir)
    {
        $title = 'Invoice';
        $identitas_pasien = $this->kasirRepository->identitasPasien($kasir->id);
        $layanan = $this->kasirRepository->daftarLayanan($kasir->id);
        $obat_pasien_rajal = $this->kasirRepository->obatPasienRajal($kasir->id);
        $total = $this->totalTagihan($kasir->id);
        return view('admin.kasir.pdf.invoice', compact(
            'title',
            'obat_pasien_rajal',
            'layanan',
            'identitas_pasien',
            'total',
            'kasir'
        ));
    }

    public function laporan()
    {
        $title = 'Laporan Kasir';
        $kategori_pasien = $this->kategoriPasien();
        $metode_pembayaran = $this->metodePembayaran();
        $status_pembayaran = $this->statusPembayaran();
        return view('admin.laporan.kasir.index', compact(
            'title',
            'kategori_pasien',
            'metode_pembayaran',
            'status_pembayaran'
        ));
    }

    public function ekspor(Request $request)
    {
        $title = 'Laporan';
        $attr = $request->validate([
            'dari' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:sampai',
            ],
            'sampai' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:dari'
            ],
            'ekstensi' => 'required',
            'kategori_pasien' => 'required',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
        ]);

        $tanggal_awal = Carbon::parse($request->dari)->startOfDay();
        $tanggal_akhir = Carbon::parse($request->sampai)->endOfDay();
        $kategori_pasien = $attr['kategori_pasien'];
        $metode_pembayaran = $attr['metode_pembayaran'];
        $status_pembayaran = $attr['status_pembayaran'];

        $data['data'] = $this->kasirRepository->laporan($tanggal_awal, $tanggal_akhir)
            ->when($kategori_pasien ?? false, function ($query) use ($kategori_pasien) {
                if ($kategori_pasien == 'semua') {
                    return false;
                }
                return $query->where('kp.id', $kategori_pasien);
            })
            ->when($metode_pembayaran ?? false, function ($query) use ($metode_pembayaran) {
                if ($metode_pembayaran == 'semua') {
                    return false;
                }
                return $query->where('k.metode_pembayaran', $metode_pembayaran);
            })
            ->when($status_pembayaran ?? false, function ($query) use ($status_pembayaran) {
                if ($status_pembayaran == 'semua') {
                    return false;
                }
                return $query->where('k.status_pembayaran', $status_pembayaran);
            })
            ->get();
        $data['dari'] = $attr['dari'];
        $data['sampai'] = $attr['sampai'];
        $data['grand_total'] = 0;
        foreach ($data['data'] as $total) {
            $data['grand_total'] += totalTagihan($total->kasir_id);
        }

        if ($attr['ekstensi'] == 'pdf') {
            return view('admin.laporan.kasir.pdf', compact(
                'data',
                'attr',
                'title'
            ));
        }
        if ($attr['ekstensi'] == 'excel') {
            return Excel::download(new KasirExport($data), 'kasir.xlsx');
        }
    }
}
