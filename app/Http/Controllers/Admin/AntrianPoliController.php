<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AntrianPoliInterface;
use App\Repositories\Interfaces\DashboardInterface;
use App\Repositories\Interfaces\PendaftaranInterface;
use Illuminate\Http\Request;

class AntrianPoliController extends Controller
{
    private $antrianPoliRepository;

    public function __construct(AntrianPoliInterface $antrianPoliRepository)
    {
        $this->antrianPoliRepository = $antrianPoliRepository;
    }


    public function antrianPoliJantung()
    {
        $data = $this->antrianPoliRepository->antrianPoliJantung();
        $title = 'Antrian Pasien Poli Jantung';
        return view('admin.antrian.jantung.index', compact(
            'title',
            'data',
        ));
    }

    public function dataAntrianPoliJantung()
    {
        $data = $this->antrianPoliRepository->antrianPoliJantung();
        $output = '';
        foreach ($data as $key => $item){
            if($item->jenis_kelamin == 'laki-laki'){
                $jk = 'L';
            }else {
                $jk = 'P';
            }
            $output .= '
            <tr class="nk-tb-item">
                <td class="nk-tb-col tb-col-md">
                    <h5 class="tb-lead text-capitalize">'.$key + 1 .'</h5>
                </td>
                <td class="nk-tb-col tb-col-md">
                    <h5 class="tb-lead text-capitalize">'. $item->no_antrian_periksa .'</h5>
                </td>
                <td class="nk-tb-col tb-col-md">
                    <a href="">
                        <div class="user-card">
                            <div class="user-avatar bg-primary">
                                    <span class="text-uppercase">
                                        ' . $jk . '
                                    </span>
                            </div>
                            <div class="user-info">
                                    <h5 class="tb-lead">'. $item->nama_pasien .'
                                        <span class="dot dot-success d-md-none ml-1"></span>
                                    </h5>
                            </div>
                        </div>
                    </a>
                </td>
                <td class="nk-tb-col tb-col-md">
                    <h5 class="tb-lead text-capitalize">'. $item->nama_dokter .'</h5>
                </td>
                <td class="nk-tb-col tb-col-md">
                    <h5 class="tb-lead">'. tanggalJam($item->created_at) .'</h5>
                </td>
           </tr>
            ';
        }

        return response()->json([
            'output' => $output
        ],200);
    }


    public function antrianPoliAnak()
    {
        $title = "Antrian Pasien Poli Anak";
        return view('admin.antrian.anak.index', compact(
            'title'
        ));
    }
}
