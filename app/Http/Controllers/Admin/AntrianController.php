<?php



namespace App\Http\Controllers\Admin;


use App\Models\Layanan;


use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use ElephantIO\Client;

use ElephantIO\Engine\SocketIO\Version2X;



class AntrianController extends Controller

{
    public function antrian()
    {
        $title = 'Pendaftaran';
        return view('admin.pendaftaran.antrianindex', compact(
            'title'
        ));
    }

    public function loket()
    {

    
        $title = 'Pendaftaran';

       
        return view('admin.pendaftaran.loketantrian', compact(
            'title'
        ));
    }

    public function panggil()
    {

    
        $title = 'Pendaftaran';

       
        return view('admin.pendaftaran.panggilantrian', compact(
            'title'
        ));
    }

    

    public function antrian_umum()
    {

    
        $title = 'Pendaftaran';

       
        return view('admin.pendaftaran.umum', compact(
            'title'
        ));
    }

    public function antrian_asuransi()
    {

    
        $title = 'Pendaftaran';

       
        return view('admin.pendaftaran.asuransi', compact(
            'title'
        ));
    }

    public function antrian_bpjs()
    {

    
        $title = 'Pendaftaran';

       
        return view('admin.pendaftaran.bpjs', compact(
            'title'
        ));
    }
}