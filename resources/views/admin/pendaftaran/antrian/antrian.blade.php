<?php

header('Access-Control-Allow-Origin:  *');

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Bootstrap Example</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://code.responsivevoice.org/responsivevoice.js?key="></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>



<div class="container">

    <div class="row justify-content-center" id="antrianMasuk">

            

    </div>

</div>



</body>



<script src="{{url('server_io/socket.io.js')}}"></script>

<script>



var socket = io.connect('http://localhost:7000/');



$('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});



socket.on('new data', function (data) {

    if(data['antrian'] ==  1){

        $('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});

    }

    if(data['ada'] ==1 ){

        $('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});

    }



    if(data['tidak_ada'] ==1 ){

        $('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});

    }



    if(data['suara'] == 1){

        $("#m_modal_4").show();

        $('#antrianNO').text(data['namabesar']);

        $('#data-antrian').load('index.php?r=queue/data-antrian', function(e) {});

        var lang = window.navigator.languages ? window.navigator.languages[0] : null;

        lang = lang || window.navigator.language || window.navigator.browserLanguage || window.navigator.userLanguage;

        if (lang.indexOf('-') !== -1)

            lang = lang.split('-')[0];

        if (lang.indexOf('_') !== -1)

            lang = lang.split('_')[0];

        console.log(lang);

        var say = "Nomor, antrian, "+data['panggil'];

        var voice = 'Indonesian Female';

        setTimeout(responsiveVoice.speak(say, voice),1153000);

    }

    

});

</script>

</html>