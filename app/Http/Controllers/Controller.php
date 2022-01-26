<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
    // public function jenis_satuan()
    // {
    //     $jenis_satuan = Satuan::select(
    //         [
    //             'id', 'nama', 'jumlah'
    //         ]
    //     )
    //         ->get();

    //     return $jenis_satuan;
    // }

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
            ->select(['id', 'nama'])
            ->get();
    }

    public function jenis_satuan()
    {
        return DB::table('satuan')
            ->select('id', 'nama', 'jumlah')
            ->get();
    }
}
