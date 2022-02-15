<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\KasirInterface;

class KasirController extends Controller
{
    private $kasirRepository;

    public function __construct(KasirInterface $kasirRepository)
    {
        $this->kasirRepository = $kasirRepository;
    }

    public function index()
    {
        $data = $this->kasirRepository->kasir();
        // return $data;
        return view('admin.kasir.index', compact(
            'data'
        ));
    }
}
