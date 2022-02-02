<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $data = $this->dokterRepository->semuaDokter()
            ->orderBy('d.created_at', 'desc')
            ->paginate($this->perPage);
        $title = 'Dokter';
        $badge = $this->badge();
        return view('admin.dokter.index', compact(
            'title',
            'data',
            'total',
            'badge'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $sortBy = $request->get('sortBy');
            $data = $this->dokterRepository->semuaDokter()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('u.id', 'like', '%' . $q . '%')
                        ->orWhere('u.name', 'like', '%' . $q . '%')
                        ->orWhere('u.username', 'like', '%' . $q . '%')
                        ->orWhere('u.email', 'like', '%' . $q . '%')
                        ->orWhere('u.status', 'like', '%' . $q . '%')
                        ->orWhere('r.name', 'like', '%' . $q . '%');
                })
                ->orderBy('u.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.user.fetch', compact('data'))->render();
        }
    }
}
