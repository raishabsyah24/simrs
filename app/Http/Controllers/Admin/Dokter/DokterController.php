<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DokterRequest;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Interfaces\DokterInterface;

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
        // $data = $this->dokterRepository->semuaDokter()->get();
        // return $data;
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
                        ->orWhere('p.spesialis', 'like', '%' . $q . '%')
                        ->orWhere('dp.hari_praktek', 'like', '%' . $q . '%')
                        ->orWhere('dp.jam_mulai', 'like', '%' . $q . '%')
                        ->orWhere('dp.jam_selesai', 'like', '%' . $q . '%');
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

    public function store(Request $request)
    {
        $attr = $request->all();
        $name = str_replace(' ', '_', $request->nama);
        $username = Str::lower($name);
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
        $attr['username'] = $username;
        $attr['password'] = bcrypt('firdaus');

        // Insert ke table user 
        $user = User::create($attr);

        // Insert ke table profile
        $attr['user_id'] = $user->id;
        $profile = Profile::create($attr);

        // Insert ke tabel dokter
        $dokter = Dokter::create($attr);

        // Insert ke table dokter_poli
        $dokter_poli = 

        return true;
    }
}
