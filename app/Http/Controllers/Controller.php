<?php

namespace App\Http\Controllers;

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
            ->select(['id', 'nama','keterangan'])
            ->where('parent_id',0)
            ->get();
    }

    public function jenis_satuan()
    {
        return DB::table('satuan')
            ->select('id', 'nama', 'jumlah')
            ->get();
    }
}
