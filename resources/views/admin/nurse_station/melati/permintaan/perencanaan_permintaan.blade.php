@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">MELATI</h3>
                            </div>
                        </div>
                        <h3 class="nk-block-title page-title">Permintaan</h3>
                        {{-- Filter date --}}
                        <p class="mt-3">Filter berdasarkan tanggal</p>
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <form>
                                    <div class="form-group d-flex float-right">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input placeholder="Dari" type="text" name="dari"
                                                class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                        </div>
                                        <p class="mx-2 mt-1">Sampai</p>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input placeholder="Sampai" name="sampai" type="text"
                                                class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                        </div>
                                        <ul class="nk-block-tools ml-2 mb-3">
                                            <li class="nk-block-tools-opt">
                                                <button onclick="filterDate(this.form)" type="submit"
                                                    class="btn btn-dim btn-outline-dark"><em
                                                        class="icon ni ni-filter-fill"></em>Filter</button>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools ml-2 mb-3">
                                    <ul class="nk-block-tools ml-2 mb-3">
                                        <li class="nk-block-tools-opt">
                                           
                                        </ul>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                               Buat Permintaan
                                            </button>
                                        </div>
                                        
                                    <li class="ml-5">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" onkeyup="search(this)" class="form-control"
                                                autocomplete="off" name="query" id="default-04" placeholder="Cari data">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- Loader --}}
                    <div class="loader card-inner p-0">
                        <div class="d-flex justify-content-center my-5">
                            <div class="spinner-grow text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
    
                 {{-- Table --}}
                <div class="nk-block fetch-data d-none">
                        @include('admin.nurse_station.melati.permintaan.fetch_permintaan')
                        <input type="hidden" name="page" value="1" />
                </div>
            </div>
        </div>
    </div>
</div>
@includeIf('admin.nurse_station.melati.permintaan._modal')
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $(".fetch-data").removeClass("d-none");
        $(".loader").addClass("d-none");
    });
    // Obat
    
    async function searchObat(url, attr) {
        if ($('.dropdown-obat').hasClass('d-none')) {
            $('.dropdown-obat').removeClass('d-none');
        }
        
        let obat = $(attr).val();
        
        await $.get(url, {
            obat: obat
        })
        .done(output => {
            console.log(output);
            if (output != '') {
                $('.dropdown-obat').html(output);
            }
        })
    }
    
    function pilihObat(url) {
        event.preventDefault();
        $('.dropdown-obat').addClass('d-none');
        $.post({
            url: url,
            type: 'post',
            data: {
                obat_apotek_id: obat_apotek_id,
                periksa_dokter_id: periksa_dokter_id
            }
        })
        .done(response => {
            let status = response.status;
            $('[name=obat]').val('')
            if (status == false) {
                $('input[name=obat]').prop('disabled', true);
                alertError('Pasien bpjs sudah mencapai limit obat',
                'Silahkan kurangi jumlah obat atau kurangi obat pasien');
            } else {
                alertSuccess(response.message);
                let url = response.url;
                $.get(url)
                .done(output => {
                    $('table .data-obat').html(output);
                    reloadTableObat();
                })
            }
        })
    }
    
    
    
    function updateQuantity(url, attr) {
        let qty = $(attr).val();
        $('input[name=obat]').prop('disabled', false);
        
        $.post({
            url: url,
            data: {
                _method: "PUT",
                jumlah: qty,
            },
        })
        .done(response => {
            let limit = response.limit;
            if (limit == 'limit') {
                $(attr).val(1);
                $('input[name=obat]').prop('disabled', true);
                alertError('Pasien bpjs sudah mencapai limit obat',
                'Silahkan kurangi jumlah obat atau kurangi obat pasien');
            }
            reloadTableObat();
        })
    }
    
    function hapusObat(url, id) {
        event.preventDefault();
        $.post({
            url: url,
            data: {
                _method: "DELETE",
                id: id
            },
        })
        .done(response => {
            let input = response.input;
            if (input == true) {
                $('[name=obat]').prop('disabled', false)
            }
            alertSuccess(response.message)
            reloadTable();
        })
    }
    
    </script>
@endpush