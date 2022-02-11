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
  '6': 'https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=music&amp;utm_content=14487'
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

    <div class="row justify-content-center generate">

        <a href="{{route('panggil.loket1')}}" class="col-lg-3 mt-3 btn btn-primary btn-lg">

        <h1>LOKET 1</h1>

</a>

<a href="{{route('panggil.loket1')}}" class="col-lg-3 mt-3 btn btn-primary btn-lg mx-5">

        <h1>LOKET 2</h1>

</a>

<a href="{{route('panggil.loket1')}}" class="col-lg-3 mt-3 btn btn-primary btn-lg">

        <h1>LOKET 3</h1>

</a>

<div>
<p><span id="list_antrian"></span></p>
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

