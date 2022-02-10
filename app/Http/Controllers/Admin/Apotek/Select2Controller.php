<?php

namespace App\Http\Controllers\Admin\Apotek;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DokterInterface;

class Select2Controller extends Controller
{
    protected $dokterRepository;

    public function __construct(DokterInterface $dokterRepository)
    {
        $this->dokterRepository = $dokterRepository;
    }
    public function searchObat(Request $request)
    {
        $nama_obat = $request->get('obat');

        $obat = DB::table('obat as o')
            ->selectRaw('oa.id as obat_id, o.nama_paten, o.nama_generik')
            ->join('obat_apotek as oa', 'oa.obat_id', '=', 'o.id')
            ->when($nama_obat ?? false, function ($query) use ($nama_obat) {
                return $query->where('o.nama_paten', 'like', '%' . $nama_obat . '%')
                    ->orWhere('o.nama_generik', 'like', '%' . $nama_obat . '%');
            })
            ->where('oa.stok', '>=', 'oa.minimal_stok')
            ->get();
        return $obat;
    }
}
