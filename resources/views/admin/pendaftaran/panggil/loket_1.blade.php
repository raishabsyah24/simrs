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

<script>
    const audioMap = {
  '1': 'https://freesound.org/data/previews/67/67739_7037-lq.mp3',
  '2': 'https://freesound.org/data/previews/67/67750_7037-lq.mp3',
  '3': 'https://freesound.org/data/previews/67/67752_7037-lq.mp3',
  '4': 'https://freesound.org/data/previews/67/67753_7037-lq.mp3',
  '5': 'https://freesound.org/data/previews/67/67754_7037-lq.mp3',
  '6': 'https://freesound.org/s/254031/'
}

const main = new umum()

function play(num) {
	main.playAudio(num);
}

function umum() {
  this.queue = [];

  this.playAudio = function(num) {
    let self = this;
    self.queue.push(num);
    document.getElementById("umum").innerHTML = JSON.stringify(self.queue);
    if (self.queue.length === 1) {
      self._call();
    }
  }

  this._call = function() {
    let self = this;
    
    if (self.queue.length) {
      setTimeout(() => {
				var audio = new Audio(audioMap[self.queue[0]]);
				audio.play();
        self.queue.shift();
        document.getElementById("umum").innerHTML = JSON.stringify(self.queue);
        audio.onended = function() {
    			self._call();
				};
      }, 1500);
    }
  }
}

function asuransi() {
  this.queue = [];

  this.playAudio = function(num) {
    let self = this;
    self.queue.push(num);
    document.getElementById("asuransi").innerHTML = JSON.stringify(self.queue);
    if (self.queue.length === 1) {
      self._call();
    }
  }

  this._call = function() {
    let self = this;
    
    if (self.queue.length) {
      setTimeout(() => {
				var audio = new Audio(audioMap[self.queue[0]]);
				audio.play();
        self.queue.shift();
        document.getElementById("asuransi").innerHTML = JSON.stringify(self.queue);
        audio.onended = function() {
    			self._call();
				};
      }, 2000);
    }
  }
}
</script>

<div class="container">

    <div class="row justify-content-center generate">

        <a onclick="play(1)" class="col-lg-3 mt-3 btn btn-primary btn-lg">

        <h1>UMUM</h1>
        <p>List antrian: <span id="umum">[]</span></p>
    </a>

<a onclick="play(2)" class="col-lg-3 mt-3 btn btn-primary btn-lg mx-5">

        <h1>ASURANSI</h1>
        <p>List antrian: <span id="asuransi">[]</span></p>

</a>

<a onclick="play(3)" class="col-lg-3 mt-3 btn btn-primary btn-lg">

        <h1>BPJS</h1>
        <p>List antrian: <span id="list_antrian">[]</span></p>

</a>

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

