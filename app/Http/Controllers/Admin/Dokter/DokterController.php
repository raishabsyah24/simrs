<?php

namespace App\Http\Controllers\Admin\Dokter;

use App\Models\Poli;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Profile;
use App\Models\DokterPoli;
use Illuminate\Support\Str;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DokterRequest;
use App\Repositories\Interfaces\DokterInterface;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    private $dokterRepository;
    private $perPage = 15;
    private $defaultPassword = 'firdaus';

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }

    public function index()
    {
<<<<<<< HEAD
=======
        // $data = $this->dokterRepository->semuaDokter()->get();
        // return $data;
>>>>>>> aef3444 (baru ni)
        $data = $this->dokterRepository->semuaDokter()
            ->orderBy('d.created_at', 'desc')
            ->paginate($this->perPage);
        $title = 'Dokter';
        $badge = $this->badge();
        $poli = $this->poli();
        return view('admin.dokter.index', compact(
            'title',
            'data',
            'badge',
            'poli'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $poli = $request->get('poli');
            $data = $this->dokterRepository->semuaDokter()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('d.id', 'like', '%' . $q . '%')
                        ->orWhere('d.nama', 'like', '%' . $q . '%')
                        ->orWhere('d.email', 'like', '%' . $q . '%')
                        ->orWhere('d.no_str', 'like', '%' . $q . '%')
                        ->orWhere('d.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('d.foto', 'like', '%' . $q . '%')
                        ->orWhere('d.status', 'like', '%' . $q . '%')
                        ->orWhere('d.tanggal_bergabung', 'like', '%' . $q . '%')
                        ->orWhere('d.no_hp', 'like', '%' . $q . '%')
                        ->orWhere('p.spesialis', 'like', '%' . $q . '%');
                })
                ->when($poli ?? false, function ($query) use ($poli) {
                    if ($poli == 'semua') {
                        return false;
                    }
                    return $query->where('p.nama', $poli);
                })
                ->orderBy('d.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.dokter.fetch', compact('data'))->render();
        }
    }

    public function create()
    {
        $title = 'Tambah Dokter';
        $poli = $this->poli();
        return view('admin.dokter.create', compact(
            'title',
            'poli'
        ));
    }

    public function store(DokterRequest $request)
    {
        $attr = $request->all();

        DB::transaction(function () use ($attr, $request) {
            $poli = Poli::find($attr['poli_id']);
            $attr['spesialis'] = $poli->nama;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = $attr['nama'] . '_' . time() . uniqid() . '.' . $extension;
                $path = $file->storeAs('dokter/', $filename);
                $attr['foto'] = $filename;
            }
            $attr['name'] = $request->nama;
            $attr['password'] = bcrypt($this->defaultPassword);

<<<<<<< HEAD
            // Insert ke table user
=======
            // Insert ke table user 
>>>>>>> aef3444 (baru ni)
            $user = User::create($attr);

            // Set role dokter
            $role = 'dokter';
            $permission = ['create', 'read', 'update', 'delete'];
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(3);
            $role->givePermissionTo([$permission]);

            // Insert ke table profile
            $attr['user_id'] = $user->id;
            $profile = Profile::create($attr);

            // Insert ke tabel dokter
            $dokter = Dokter::create($attr);

            // Insert ke table dokter_poli
            $dokter_poli = new DokterPoli();
            $dokter_poli->dokter_id = $dokter->id;
            $dokter_poli->poli_id = $poli->id;
            $dokter_poli->save();

            // Insert ke table jadwal prkatek
            for ($i = 0; $i < count($attr['hari']); $i++) {
                JadwalDokter::create([
                    'dokter_id' => $dokter->id,
                    'hari' => $attr['hari'][$i],
                    'jam_mulai' => $attr['jam_mulai'][$i],
                    'jam_selesai' => $attr['jam_selesai'][$i],
                ]);
            }
        });

        return response()->json([
            'message' => 'Dokter berhasil ditambahkan',
            'url' => route('dokter.index')
        ], 200);
    }

    public function edit(Dokter $dokter)
    {
        $title = 'Ubah Data Dokter';
        $poli = $this->poli();
        $dokter_poli = DokterPoli::where('dokter_id', $dokter->id)->first();
        return view('admin.dokter.edit', compact(
            'title',
            'poli',
            'dokter',
            'dokter_poli'
        ));
    }

    public function update(DokterRequest $request, Dokter $dokter,)
    {
        $attr = $request->all();

        DB::transaction(
            function () use ($dokter, $attr, $request) {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $extension = $file->getClientOriginalExtension();
                    $filename = $attr['nama'] . '_' . time() . uniqid() . '.' . $extension;
                    // Hapus foto lama
                    Storage::delete('dokter/' . $dokter->foto);

                    // Insert foto baru
                    $path = $file->storeAs('dokter/', $filename);
                    $attr['foto'] = $filename;
                }

                // Update data dokter
                $dokter->update($attr);

                // Update spesialis dokter
                $dokter_poli = DokterPoli::where('dokter_id', $dokter->id)->first();
                $dokter_poli->update(['poli_id' => $attr['poli_id']]);
            }
        );

        return response()->json([
            'message' => 'Dokter berhasil diubah',
            'url' => route('dokter.index')
        ], 200);
    }

<<<<<<< HEAD
    public function gantiJadwal(Dokter $dokter)
    {
        $title = 'Ganti Jadwal Praktek Dokter';

        return view('admin.dokter.ganti_jadwal_praktek', compact(
            'title',
            'dokter',
        ));
    }

    public function updateJadwal(Dokter $dokter, Request $request)
    {
        $attr = $request->all();
        $jadwal_dokter = DB::table('jadwal_dokter')
            ->where('dokter_id', $dokter->id)
            ->delete();

        // Insert ke table jadwal prkatek
        for ($i = 0; $i < count($attr['hari']); $i++) {
            $jadwal_terbaru = JadwalDokter::create([
                'dokter_id' => $dokter->id,
                'hari' => $attr['hari'][$i],
                'jam_mulai' => $attr['jam_mulai'][$i],
                'jam_selesai' => $attr['jam_selesai'][$i],
            ]);
        }

        $jadwal = DB::table('jadwal_dokter')
            ->where('dokter_id', $dokter->id)
            ->whereNull('jam_mulai')
            ->whereNull('jam_selesai')
            ->delete();

        return response()->json([
            'message' => 'Jadwal dokter berhasil diubah',
            'url' => route('dokter.index')
        ], 200);
    }

=======
>>>>>>> aef3444 (baru ni)
    public function delete(Dokter $dokter)
    {
        DB::transaction(function () use ($dokter) {
            $user = User::findOrFail($dokter->user_id);
            $role = $user->getRoleNames();
            $permission = $user->getPermissionNames();

            // $role->revokePermissionTo($permission);
            // $permission->removeRole($role);
            // $user->revokePermissionTo($permission);
            // $user->removeRole($role);

            $profile = Profile::where('user_id', $user->id)->first();
            $profile->delete();
            $user->delete();

            $jadwal_dokter = JadwalDokter::where('dokter_id', $dokter->id)->get();
            foreach ($jadwal_dokter as $jadwal) {
                $jadwal->delete();
            }

            $dokter_poli = DokterPoli::where('dokter_id', $dokter->id)->first();
            $dokter_poli->delete();

            $dokter->delete();
        });

        return response()->json([
            'message' => 'Dokter berhasil dihapus',
            'url' => route('dokter.index')
        ], 200);
    }
}
