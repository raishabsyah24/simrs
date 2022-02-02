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

    public function panggil(){

        return view('antrian');

    } 



    public function antrian_baru(){

        $day = Carbon::now()->format('d');

        $month = Carbon::now()->addMonth(1)->format('m');

        $year = Carbon::now()->format('Y');



        // $antrian = Antrian::where('status','GENERATE')

        //             ->whereDate('time_generate', date('Y-m-d'))

        //             ->orderBy('time_generate', 'asc')

        //             ->get();

        return view('admin.pendaftaran.antrian.antrian_baru',compact('antrian'));

    } 



    // public function generate(){

    //     return view('generate');

    // }



    // public function printAntrian($nama){

    //     $antrian = Antrian::where('type_antrian',$nama)

    //                 ->whereDate('time_generate', date('Y-m-d'))

    //                 ->orderBy('time_generate', 'desc')

    //                 ->first();



    //     if(!empty($antrian)){

    //         $nomor = $antrian->nomor+1;

    //     }else{

    //         $nomor = 100;

    //     }

    //     $simpan_antrian = new Antrian();

    //     $simpan_antrian->nomor = $nomor;

    //     $simpan_antrian->time_generate = date('Y-m-d H:i:s');

    //     $simpan_antrian->time_status = date('Y-m-d H:i:s');

    //     $simpan_antrian->type_antrian = $nama;

    //     $simpan_antrian->inisial = $nama;

    //     $simpan_antrian->status = "GENERATE";

    //     $simpan_antrian->save();



    //     $version = new Version2X("http://127.0.0.1:7000");

    //     $client = new Client($version);

    //     $client->initialize();

    //     $client->emit('send data', ['antrian' => 1]);

    //     $client->close();

    // }



    // public function suara(){

    //     $antrian = Antrian::where('id_antrian',$_GET['id'])

    //     ->whereDate('time_generate', date('Y-m-d'))

    //     ->first();



    //     $panggil = str_replace("", ". ",$antrian->inisial.'. '.$antrian->nomor);



    //     $version = new Version2X("http://127.0.0.1:7000");

    //     $client = new Client($version);

    //     $client->initialize();

    //     $client->emit('send data', ['suara' =>  1,'panggil' => $panggil]);

    //     $client->close();

        

    // }



    public function ada_antrian(){

        // $antrian = Antrian::where('id_antrian',$_GET['id'])

        // ->whereDate('time_generate', date('Y-m-d'))

        // ->first();

        $antrian->status = "ADA";

        $antrian->save();

        return view('admin.pendaftaran.antrian.antrian',compact('antrian'));

        // $version = new Version2X("http://127.0.0.1:7000");

        // $client = new Client($version);

        // $client->initialize();

        // $client->emit('send data', ['ada' => 1]);

        // $client->close();

        

    }



    // public function tidak_ada_antrian(){

    //     $antrian = Antrian::where('id_antrian',$_GET['id'])

    //     ->whereDate('time_generate', date('Y-m-d'))

    //     ->first();

    //     $antrian->status = "TIDAK ADA";

    //     $antrian->save();



    //     $version = new Version2X("http://127.0.0.1:7000");

    //     $client = new Client($version);

    //     $client->initialize();

    //     $client->emit('send data', ['ada' => 1]);

    //     $client->close();

        

    // }

}