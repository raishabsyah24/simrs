<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\DokterInterface;
use Illuminate\Support\Facades\DB;


class TenagaMedisController extends Controller
{
    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }
    public function dataMedis()
    {
        $data = $this->dokterRepository->tenagaMedis();
        $total = $this->dokterRepository->tenagaMedis()->count();
        $title = 'Daftar Tenaga Medis';
        return view('admin.user.medis.index', compact(
            'title',
            'data',
            'total'
        ));
    }

    public function createMedis()
    {
        $title = 'Tambah Medis';
        $data = $this->dokterRepository->tenagaMedis();
        $poli = $this->poli();
        return view('admin.user.medis.create', compact(
            'title',
            'poli',
            'data'
        ));
    }

    public function storeMedis(Request $request)
    {
        // dd($request->all());

        // Insert ke table user
        $permissions = ['create', 'read', 'update'];
        $role = 3;
        $user['password'] = bcrypt('admin');
        $user = User::create([
            'name' => $request->nama,
            'username' => Str::lower($request->nama),
            'email' => $request->email,
            'password' => bcrypt('admin')
        ]);

        $user->assignRole($role);
        $user->givePermissionTo($permissions);
        $role = Role::where('name', $role)->first();

        // Insert ke table dokter
        $dokter = Dokter::create([
            // 'user_id' => $user->id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'spesialis' => $request->spesialis,
            'no_str' => $request->no_str,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);

        return response()->json([
            'url' => route('data.store-medis'),
            'message' => 'Tambah dokter berhasil!'
        ], 200);
    }
}
