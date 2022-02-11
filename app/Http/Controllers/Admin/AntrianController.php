<?php



namespace App\Http\Controllers\Admin;


use App\Models\Layanan;


use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use ElephantIO\Client;

use ElephantIO\Engine\SocketIO\Version2X;

use App\Repositories\Interfaces\AntrianInterface;

use App\Repositories\AntrianRepositoriy;



class AntrianController extends Controller

{
    private $AntrianRepository;

    public function __construct(AntrianInterface $AntrianRepository)
    {
        $this->AntrianRepository = $AntrianRepository;
    }


    public function antrian()
    {
        $title = 'Antrian Dashboard';

       
        return view('admin.pendaftaran.antrian.panggil_antrian', compact(
            'title'
        ));
    }

    public function loket()
    {

    
        $title = 'Antrian Loket';

       
        return view('admin.pendaftaran.loketantrian', compact(
            'title',
        ));
    }

    public function panggil()
    {
        $data = $this->AntrianRepository->antrian_fo_umum()
        ->first();
        $title = 'Antrian Panggil';
        return view('admin.pendaftaran.panggilantrian', compact(
            'title'
        ));
    
        
    }

    

    public function antrian_umum()
    {
        $antrian = DB::table('antrian_fo')->insert([
            'antrian_fo_id'=>2,
            'tujuan'=>null,
            'tanggal'=>now(),
            'nomor_antrian'=>'U0001',
            'kategori_pasien'=>'UMUM',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        $data = $this->AntrianRepository->antrian_fo_umum()
        ->first();

        $title = 'Antrian';
       
        return view('admin.pendaftaran.umum', compact(
            'data',
            'title',
        ));
    }

    public function antrian_asuransi()
    {

    
        $antrian = DB::table('antrian_fo')->insert([
            'antrian_fo_id'=>2,
            'tujuan'=>null,
            'tanggal'=>now(),
            'nomor_antrian'=>'A0001',
            'kategori_pasien'=>'ASURANSI',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        $data = $this->AntrianRepository->antrian_fo_umum()
        ->first();

        $title = 'Antrian';
       
        return view('admin.pendaftaran.asuransi', compact(
            'data',
            'title',
        ));
    }

    public function antrian_bpjs(Request $request)
    {
        $antrian = DB::table('antrian_fo')->insert([
            'antrian_fo_id'=>2,
            'tujuan'=>null,
            'tanggal'=>now(),
            'nomor_antrian'=>'B0001',
            'kategori_pasien'=>'BPJS',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);


        $data = $this->AntrianRepository->antrian_fo_umum()
        ->first();
        $title = 'Antrian';
       
        return view('admin.pendaftaran.bpjs', compact(
            'data',
            'title',
        ));
    }


    public function loket_1()
    {
        $title = 'Antrian Dashboard';

       
        return view('admin.pendaftaran.panggil.loket_1', compact(
            'title'
        ));
    }

    public function loket_2()
    {
        $title = 'Antrian Dashboard';

       
        return view('admin.pendaftaran.panggil.loket_2', compact(
            'title'
        ));
    }

    public function loket_3()
    {
        $title = 'Antrian Dashboard';

       
        return view('admin.pendaftaran.panggil.loket_3', compact(
            'title'
        ));
    }
}