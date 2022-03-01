<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $pasienBpjs = 1;
    public function badge()
    {
        return $badge = collect([
            'primary',
            'secondary',
            'warning',
            'danger',
            'success',
            'info',
        ]);
    }

    public function roles()
    {
        return DB::table('roles')
            ->select('id', 'name')
            ->whereNotIn('name', ['super_admin'])
            ->get();
    }

    public function permissions()
    {
        return DB::table('permissions')
            ->select('id', 'name')
            ->whereNotIn('name', ['full_permission'])
            ->get();
    }

    public function nurseStation()
    {
        return DB::table('nurse_station')
            ->select(['id', 'nama'])
            ->get();
    }

    public function asuransi()
    {
        return DB::table('asuransi')
            ->select(['id', 'nama'])
            ->get();
    }

    public function kategoriPasien()
    {
        return DB::table('kategori_pasien')
            ->select(['id', 'nama'])
            ->get();
    }

    public function faskes()
    {
        return DB::table('faskes')
            ->select(['id', 'nama'])
            ->limit(5)
            ->get();
    }

    public function poli()
    {
        return DB::table('poli')
            ->select(['id', 'nama'])
            ->get();
    }

    public function layanan()
    {
        return DB::table('layanan')
            ->select(['id', 'nama', 'keterangan'])
            ->where('parent_id', 0)
            ->get();
    }

    public function jenis_satuan()
    {
        return DB::table('satuan')
            ->select('id', 'nama', 'jumlah')
            ->get();
    }

    public function totalTagihan(int $kasir_id)
    {
        $kasir = DB::table('kasir')
            ->selectRaw('
            id, total_tagihan, diskon, pajak
            ')
            ->where('id', $kasir_id)
            ->first();

        $diskon = ($kasir->diskon / 100) * $kasir->total_tagihan;
        $pajak = ($kasir->pajak / 100) * $kasir->total_tagihan;
        $total_tagihan = $kasir->total_tagihan;
        $total = ($total_tagihan - $diskon) + $pajak;
        return $total;
    }

    public function metodePembayaran()
    {
        return
            [
                ['semua', 'Semua'],
                ['bpjs', 'BPJS'],
                ['asuransi', 'Asuransi'],
                ['cash', 'Cash'],
                ['deposit', 'Bayar Dengan Deposit Pasien'],
                ['transfer', 'Transfer'],
                ['debit', 'Debit'],
            ];
    }

    public function statusPembayaran()
    {
        return
            [
                ['semua', 'Semua'],
                ['lunas', 'Lunas'],
                ['piutang bpjs', 'Piutang BPJS'],
                ['piutang asuransi', 'Piutang Asuransi'],
                ['belum lunas', 'Belum Lunas']
            ];
    }

    public function namaPasien(int $pasien_id)
    {
        $pasien = Pasien::select(['id', 'nama'])->whereId($pasien_id)->first();
        return $pasien->nama;
    }

    public function namaPoli(int $poli_id)
    {
        $poli = Poli::select(['id', 'nama'])->whereId($poli_id)->first();
        return $poli->nama;
    }


    public function kategoriLayanan()
    {
        return DB::table('layanan')
            ->select(['id', 'nama', 'parent_id'])
            ->where('parent_id', 0)
            ->whereNotIn('id', [1])
            ->get();
    }
}
