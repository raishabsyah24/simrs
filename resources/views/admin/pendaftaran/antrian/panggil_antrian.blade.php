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

const main = new LocketAudio();

function play(num) {
	main.playAudio(num);
}

function LocketAudio() {
  this.queue = [];

  this.playAudio = function(num) {
    let self = this;
    self.queue.push(num);
    document.getElementById("list_antrian").innerHTML = JSON.stringify(self.queue);
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
        document.getElementById("list_antrian").innerHTML = JSON.stringify(self.queue);
        audio.onended = function() {
    			self._call();
				};
      }, 1500);
    }
  }
}
</script>

<div class="container">

    <div class="column justify-content-center generate">

        
<div>
<button onclick="play(1)">1</button>
<button onclick="play(2)">2</button>
<button onclick="play(3)">3</button>
<button onclick="play(4)">4</button>
<button onclick="play(5)">5</button>
</div>
<div>
  <p>List antrian: <span id="list_antrian">[]</span></p>
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

