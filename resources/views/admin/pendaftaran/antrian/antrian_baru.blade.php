<div class="col-lg-3 mt-3">

    <h2>Antrian A</h2>

        @foreach($antrian as $antrianA)

            @if($antrianA->type_antrian == 'A')

            <div class="panel-group">

                <div class="panel panel-primary">

                    <div class="panel-body">

                        <h1>{{$antrianA->nama}}</h1>

                        <h3>Nomor {{$antrianA->inisial}}{{$antrianA->nomor}}</h3>

                        <button onclick="panggilAntrian('<?= $antrianA->id_antrian ?>')" type="button" class="btn btn-primary">Panggil</button>

                        <button onclick="adaAntiran('<?= $antrianA->id_antrian ?>')" type="button" class="btn btn-primary">Ada</button>

                        <button onclick="tidakAdaAntiran('<?= $antrianA->id_antrian ?>')" type="button" class="btn btn-primary">Tidak Ada</button>

                    </div>

                </div>

            </div>

            @endif

        @endforeach

</div>

<div class="col-lg-3 mt-3"  id="antrianB">

    <h2>Antrian B</h2>

        @foreach($antrian as $antrianB)

            @if($antrianB->type_antrian == 'B')

                <div class="panel-group">

                    <div class="panel panel-primary">

                        <div class="panel-body">

                            <h1>{{$antrianB->nama}}</h1>

                            <h3>Nomor {{$antrianB->inisial}}{{$antrianB->nomor}}</h3>

                            <button onclick="panggilAntrian('<?= $antrianB->id_antrian ?>')" type="button" class="btn btn-primary">Panggil</button>

                            <button onclick="adaAntiran('<?= $antrianB->id_antrian ?>')" type="button" class="btn btn-primary">Ada</button>

                            <button onclick="tidakAdaAntiran('<?= $antrianB->id_antrian ?>')" type="button" class="btn btn-primary">Tidak Ada</button>

                            

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

</div>

<div class="col-lg-3 mt-3" id="antrianC">

    <h2>Antrian C</h2>

        @foreach($antrian as $antrianC)

            @if($antrianC->type_antrian == 'C')

                <div class="panel-group">

                    <div class="panel panel-primary">

                        <div class="panel-body">

                            <h1>{{$antrianC->nama}}</h1>

                            <h3>Nomor {{$antrianC->inisial}}{{$antrianC->nomor}}</h3>

                            <button onclick="panggilAntrian('<?= $antrianC->id_antrian ?>')" type="button" class="btn btn-primary">Panggil</button>

                            <button onclick="adaAntiran('<?= $antrianC->id_antrian ?>')" type="button" class="btn btn-primary">Ada</button>

                            <button onclick="tidakAdaAntiran('<?= $antrianC->id_antrian ?>')" type="button" class="btn btn-primary">Tidak Ada</button>

                            

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

</div>

<div class="col-lg-3 mt-3" id="antrianD">

    <h2>Antrian D</h2>

        @foreach($antrian as $antrianD)

            @if($antrianD->type_antrian == 'D')

                <div class="panel-group">

                    <div class="panel panel-primary">

                        <div class="panel-body">

                            <h1>{{$antrianD->nama}}</h1>

                            <h3>Nomor {{$antrianD->inisial}}{{$antrianD->nomor}}</h3>

                            <button onclick="panggilAntrian('<?= $antrianD->id_antrian ?>')" type="button" class="btn btn-primary">Panggil</button>

                            <button onclick="adaAntiran('<?= $antrianD->id_antrian ?>')" type="button" class="btn btn-primary">Ada</button>

                            <button onclick="tidakAdaAntiran('<?= $antrianD->id_antrian ?>')" type="button" class="btn btn-primary">Tidak Ada</button>

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

</div>

<script>

function panggilAntrian(id,nomor){

    $.ajax({

        url: '{{url("panggil")}}?id=' + id,

        type: "GET",

        dataType: "html",

        success: function(data) {

            //alert('berhasil generate');

        }

    });

}

function adaAntiran(id){

    $.ajax({

        url: '{{url("ada-antrian")}}?id=' + id,

        type: "GET",

        dataType: "html",

        success: function(data) {

            $('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});

        }

    });

}



function tidakAdaAntiran(id){

    $.ajax({

        url: '{{url("tidak-ada")}}?id=' + id,

        type: "GET",

        dataType: "html",

        success: function(data) {

            $('#antrianMasuk').load("{{url('antrian-baru')}}", function(e) {});

        }

    });

}

</script>