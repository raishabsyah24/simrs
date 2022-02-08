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
                                <h3 class="nk-block-title page-title">
                                    {!! $title !!}
                                </h3>
                            </div>
                        </div>
                        {{-- Head --}}
                        <div class="nk-block-between mt-4">
                            <div class="nk-block-head-content"></div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="more-options">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input onkeyup="search(this)" type="text" name="query"
                                                        autocomplete="off" class="form-control"
                                                        placeholder="Cari data . . ." />
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-toggle="dropdown" aria-expanded="false">Filter Berdasarkan
                                                        Poli</a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="" onclick="filterPoli(`semua`)">
                                                                    <span class="text-uppercase">
                                                                        Semua
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            @foreach ($poli as $item)
                                                                <li>
                                                                    <a data-id="{{ $item->id }}" href="#"
                                                                        onclick="filterPoli(`{{ $item->nama }}`)"><input
                                                                            type="hidden" name="poli" />
                                                                        <span class="text-uppercase">
                                                                            {{ $item->nama }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-toggle="dropdown" aria-expanded="false">Filter Berdasarkan
                                                        Status</a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="" onclick="filterStatus(`semua`)">
                                                                    <span class="text-uppercase">
                                                                        Semua
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="filterStatus(`sudah diperiksa`)"><input
                                                                        type="hidden" name="poli" />
                                                                    <span class="text-uppercase">
                                                                        Diperiksa
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="filterStatus(`belum diperiksa`)"><input
                                                                        type="hidden" name="poli" />
                                                                    <span class="text-uppercase">
                                                                        Belum Diperiksa
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="loader card-inner p-0">
                        <div class="d-flex justify-content-center my-5">
                            <div class="spinner-grow text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block fetch-data d-none">
                        @include('admin.poli_station.fetch')
                        <input type="hidden" name="page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @includeIf('admin.poli_station.partials._modal_form')
    @includeIf('admin.poli_station.partials._modal_detail')
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(".fetch-data").removeClass("d-none");
            $(".loader").addClass("d-none");
        });

        async function fetchData(
            page = "",
            query = "",
            sortBy = "desc",
            poli = "",
            status = ""
        ) {
            await $.get(
                    `/poli-station/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}&poli=${poli}&status=${status}`
                )
                .done((data) => {
                    $(".loader").addClass("d-none");
                    $(".fetch-data").removeClass("d-none");
                    $(".fetch-data").html(data);
                })
                .fail((error) => {
                    $(".loader").addClass("d-none");
                    modalError();
                });
        }

        function search(el) {
            let query = $(el).val(),
                page = $("input[name=page]").val(),
                status = $("input[name=status]").val(),
                poli = $("input[name=poli]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc", poli, status);
        }

        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            let page = $(this).attr("href").split("page=")[1],
                poli = $("input[name=poli]").val(),
                status = $("input[name=status]").val(),
                query = $("input[name=query]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc", poli, status);
        });

        function filterPoli(poli) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                status = $("input[name=status]").val(),
                query = $("input[name=query]").val();
            fetchData(page, query, "desc", poli, status);
        }

        function filterStatus(status) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                poli = $("input[name=poli]").val(),
                query = $("input[name=query]").val();
            fetchData(page, query, "desc", poli, status);
        }

        function periksa(url, nama_pasien) {
            event.preventDefault();
            $('.modal-periksa').modal('show');
            $('.modal-periksa .modal-title').text(`Periksa ${nama_pasien}`);
            $('.modal-periksa form').attr('action', url);
        }

        function submitForm(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);

                    }
                })
                .done(response => {
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();

                })
        }

        function detailPasien(url) {
            event.preventDefault();
            $('.modal-detail').modal('show');
            $.get(url)
                .done(response => {
                    let data = response.data;
                    $('.modal-detail .nama').text(data.nama);
                    $('.modal-detail .tanggal-lahir').text(data.tanggal_lahir);
                    $('.modal-detail .tb').text(data.tb);
                    $('.modal-detail .bb').text(data.bb);
                    $('.modal-detail .td').text(data.td);
                    $('.modal-detail .su').text(data.su);
                    $('.modal-detail .bmi').text(data.bmi);
                })
        }
    </script>
@endpush
