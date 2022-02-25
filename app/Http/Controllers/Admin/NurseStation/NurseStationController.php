<?php

namespace App\Http\Controllers\Admin\NurseStation;

use App\Repositories\Interfaces\NurseStationInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NurseStationController extends Controller
{
    private $nurseStationRepository;
    public $perPage = 12;

    public function __construct(NurseStationInterface $nurseStationRepository)
    {
        $this->nurseStationRepository = $nurseStationRepository;
    }
    public function index()
    {
        $title = 'Nurse Station';

        return view('admin.nurse_station.index', compact(
            'title'
        ));
    }
}
