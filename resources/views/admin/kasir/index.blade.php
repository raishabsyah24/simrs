@extends('layouts.admin.master', ['title' => $title])
@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
                            </div>
                        </div>
                        <div class="nk-block-between">
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block-between mt-4">
                            <div class="nk-block-head-content"></div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                       data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="more-options">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                       class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                       data-toggle="dropdown" aria-expanded="false">Filter Berdasarkan
                                                        Kategori</a>
                                                    <div class="dropdown-menu dropdown-menu-right" >
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="" onclick="filterKategori(`semua`)">
                                                                    <span class="text-uppercase">
                                                                        Semua
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            @foreach ($kategori_pasien as $item)
                                                                <li>
                                                                    <a data-id="{{ $item->id }}" href="#"
                                                                       onclick="filterKategori(`{{ $item->id }}`)"><input
                                                                            type="hidden" name="kategori" />
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
                                                        Status Dilayani</a>
                                                    <div class="dropdown-menu dropdown-menu-right" >
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="" onclick="filterStatus(`semua`)">
                                                                    <span class="text-uppercase">
                                                                        Semua
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                   onclick="filterStatus(`sudah dilayani`)"><input
                                                                        type="hidden" name="status" />
                                                                    <span class="text-uppercase">
                                                                           Sudah Dilayani
                                                                        </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                   onclick="filterStatus(`belum dilayani`)"><input
                                                                        type="hidden" name="status" />
                                                                    <span class="text-uppercase">
                                                                           Belum Dilayani
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
                        @include('admin.kasir.fetch')
                        <input type="hidden" name="page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.fetch-data').removeClass('d-none');
            $('.loader').addClass('d-none');
        })

        async function fetchData(page = '', query = '', kategori = '', status = '') {
            await $.get(`/kasir/fetch-data?page=${page}&query=${query}&kategori=${kategori}&status=${status}`)
                .done(data => {
                    $('.loader').addClass('d-none');
                    $('.fetch-data').removeClass('d-none');
                    $('.fetch-data').html(data)
                })
                .fail((errors) => {
                    alertError();
                    return;
                });
        }

        function search(el) {
            let query = $(el).val(),
                page = $('input[name=page]').val();
            $('.loader').removeClass('d-none');
            $('.fetch-data').addClass('d-none');
            fetchData(page, query);
        }

        function filterKategori(kategori) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val(),
                status = $("input[name=status]").val();
            fetchData(page, query, kategori, status);
        }

        function filterStatus(status) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val(),
                kategori = $("input[name=kategori]").val();
            fetchData(page, query, kategori, status);
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1],
                query = $('input[name=query]').val();
            $('.loader').removeClass('d-none');
            $('.fetch-data').addClass('d-none');
            fetchData(page, query);
        });
    </script>
@endpush
