<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faskes;
use App\Models\Kasir;
use App\Models\PosisiDetailPasienRajal;
use App\Models\PosisiPasienRajal;
use App\Repositories\Interfaces\KasirInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\KasirExport;
use Maatwebsite\Excel\Facades\Excel;



class KasirController extends Controller
{
    public $kasirRepository;
    public function __construct(KasirInterface $kasirRepository){
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
            ->when($q ?? false, function ($query) use ($q){
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
                }else if ($kategori == 'semua') {
                    return false;
                }
                return $query->where('k.status', $status)
                    ->orWhere('kp.id', $kategori);
            })
            ->paginate($this->perPage);
        return view(
            'admin.kasir.fetch',
            compact('data','badge')
        )
            ->render();
    }

    public function proses(Kasir $kasir)
    {
        if(request()->ajax()){
            $total = $this->totalTagihan($kasir->id);
            return response()->json([
                'totalAngka' => $total,
                'total' => formatAngka($total, true),
                'deposit_awal' => formatAngka($kasir->deposit_awal, true),
            ], 200);
        }

        $posisi_pasien = $this->kasirRepository->posisiPasien($kasir->id);
        if($posisi_pasien->status == 'proses kasir'){
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
//        dd($attr);
        $diskon = $request->diskon;
        $pajak = $request->pajak;

            if($diskon != null){
                $kasir->update([
                    'diskon' => $diskon,
                ]);
            }else{
                $kasir->update([
                    'diskon' => 0,
                ]);
            }
            if($pajak != null){
                $kasir->update([
                    'pajak' => $pajak,
                ]);
            }else{
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
            'metode_pembayaran','status_pembayaran','dibayar'
        ]);
        $attr['status'] = 'sudah dilayani';
        $attr['tanggal_pembayaran'] = now();
        $attr['admin'] = auth()->id();
        $attr['kode'] = kodePembayaran();
        DB::transaction(function () use ($attr, $kasir){
            $kasir->update($attr);

            $posisi_pasien = $this->kasirRepository->posisiPasien($kasir->id);
            if($posisi_pasien->status == 'proses transaksi'){
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
        if(request()->ajax()){
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
        if(!$kasir->tanggal_deposit){
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
        $data = Faskes::limit(20)->get();
        return view('admin.kasir.pdf.invoice', compact(
            'title',
            'data'
        ));
    }

    public function laporan()
    {
        $title = 'Laporan Kasir';
        return view('admin.laporan.kasir.index', compact(
            'title'
        ));
    }

    public function ekspor(Request $request)
    {
        $attr = $request->validate([
            'dari' => 'required|date',
            'sampai' => 'required|date',
            'ekstensi' => 'required',
        ]);
        $tanggal_awal = Carbon::parse($attr['dari'])->startOfDay();
        $tanggal_akhir = Carbon::parse($attr['sampai'])->endOfDay();
        $data = $this->kasirRepository->laporan($tanggal_awal, $tanggal_akhir);
        $grand_total = 0;
        foreach ($data as $total){
            $grand_total += totalTagihan($total->kasir_id);
        }

        if($attr['ekstensi'] == 'pdf' ){
            return view('admin.laporan.kasir.pdf', compact(
                'data',
                'attr',
                'grand_total'
            ));
        }
        if($attr['ekstensi'] == 'excel' ){
            return Excel::download(new KasirExport($data), 'kasir.xlsx');
        }
    }
}
