@extends('layouts.admin.master')

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="title nk-block-title">Tambahan Obat Pasien</h4>

                            </div>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('store.obat-bpjs') }}" method="post" 
                                class="form-validate is-alter" novalidate="novalidate">
                                    @csrf
                                    <input type="hidden" name="periksa_dokter_id" value="" required="">
                                    <div class="row g-gs">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">Nama Obat</label>
                                                <div class="form-control-wrap">
                                                    <select class="select2obat form-control" name="obat_apotek_id" required="">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Jumlah</label>
                                                <div class="form-control-wrap number-spinner-wrap">
                                                    <button onclick="minus()" class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                                    <input type="number" class="form-control number-spinner" value="0" name="jumlah" id="jumlah"
                                                    required="">
                                                    <button onclick="plus()" class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>

        function minus(){
            event.preventDefault();
            console.log('ok');
        }

        function plus(){
            event.preventDefault();
            console.log('ok');
        }
        
        $(document).ready(function(){
            // Search nama obat 
            $('.select2obat').select2({
                    placeholder: 'Cari...',
                    // theme: 'bootstrap',
                    ajax: {
                    url: '/search-obat-apotek',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                        results:  $.map(data, function (item) {
                            //   return {
                            //   text: item.nama_paten,
                            //   id: item.id
                            //   }
                            if(item.id!=0) {
                                    return { 
                                        id: item.id, 
                                        text: item.nama_paten +' ('+ `${item.nama_generik}`+ ' )'};
                                }
                            else
                                {
                                    return {
                                        id: item.id, text: item.nama_generik
                                }}
                            })
                        };
                    },
                    cache: true
                    },
                    debug:false
            });  
        })
    </script>
@endpush