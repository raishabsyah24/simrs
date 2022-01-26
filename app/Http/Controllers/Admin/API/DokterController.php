<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $data = Dokter::when($q ?? false, function ($query) use ($q) {
            return $query->where('id', 'like', '%' . $q . '%')
                ->orWhere('user_id', 'like', '%' . $q . '%')
                ->orWhere('nama', 'like', '%' . $q . '%')
                ->orWhere('spesialis', 'like', '%' . $q . '%')
                ->orWhere('no_str', 'like', '%' . $q . '%')
                ->orWhere('tempat_lahir', 'like', '%' . $q . '%')
                ->orWhere('tanggal_lahir', 'like', '%' . $q . '%')
                ->orWhere('jenis_kelamin', 'like', '%' . $q . '%')
                ->orWhere('no_hp', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->orWhere('alamat', 'like', '%' . $q . '%')
                ->orWhere('foto', 'like', '%' . $q . '%');
        })
            ->latest()
            ->get();

        return $data;
    }
}
