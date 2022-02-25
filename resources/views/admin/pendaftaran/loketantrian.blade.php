@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
<!DOCTYPE html>

<html lang="en">

<head>

  <title>Bootstrap Example</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>

<style>

    .generate {

        margin: 250px auto;

        padding: 10px;

    }

</style>

<div class="container">

    <div class="row justify-content-center generate">

        <div onclick="antrian('A')" class="col-lg-3 mt-3 btn btn-primary btn-lg">

        <h1>UMUM</h1>
    </a>

<<<<<<< HEAD
        </div>

        <div onclick="antrian('B')" class="col-lg-3 mt-3 btn btn-primary btn-lg mx-5">
=======
<a href="{{route('antrian.asuransi')}}"  target="pendaftaran.loket" class="col-lg-3 mt-3 btn btn-primary btn-lg mx-5">
>>>>>>> 411fff7 (selasa 8/2/22 22:12)

        <h1>ASURANSI</h1>

        </div>

<<<<<<< HEAD
        <div onclick="antrian('C')" class="col-lg-3 mt-3 btn btn-primary btn-lg">
=======
<a href="{{route('antrian.bpjs')}}"  target="pendaftaran.loket" class="col-lg-3 mt-3 btn btn-primary btn-lg">
>>>>>>> 411fff7 (selasa 8/2/22 22:12)

        <h1>BPJS</h1>

        </div>

    </div>

</div>



</body>

<script>

function antrian(id){

    $.ajax({

        url: '{{url("generate")}}/' + id,

        type: "GET",

        dataType: "html",

        success: function(data) {

            alert('berhasil generate');

        }

    });

}

</script>

</html>

@endsection

@push('js')
    <script src="{{ asset('backend/pages/pendaftaran.js') }}"></script>
@endpush

