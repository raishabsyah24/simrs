@extends('layouts.admin.master', ['title' => $title])
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
                                                        Kategori</a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="">
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
                                            <li class="nk-block-tools-opt">
                                                <a href="{{ route('pendaftaran.rawat-inap.create') }}"
                                                    class="btn btn-primary d-md-inline-flex"><em
                                                        class="icon ni ni-plus"></em><span>Tambah</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- .nk-block-head-content -->
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
                        @include('admin.pendaftaran.ranap.fetch')
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
            $(".fetch-data").removeClass("d-none");
            $(".loader").addClass("d-none");
        });

        async function fetchData(
            page = "",
            query = "",
            sortBy = "desc",
            kategori = "",
            poli = ""
        ) {
            await $.get(
                    `/pendaftaran/rawat-inap/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}&kategori=${kategori}&poli=${poli}`
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
                kategori = $("input[name=kategori]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc");
        }

        function sortBy(sortBy) {
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, sortBy);
        }

        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            let page = $(this).attr("href").split("page=")[1],
                kategori = $("input[name=kategori]").val(),
                query = $("input[name=query]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc", kategori);
        });

        function filterKategori(kategori) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val(),
                poli = $("input[name=poli]").val();
            fetchData(page, query, "desc", kategori, poli);
        }

        function filterPoli(poli) {
            event.preventDefault();
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val(),
                kategori = $("input[name=kategori]").val();
            fetchData(page, query, "desc", kategori, poli);
        }

        function hapusPasien(url) {
            event.preventDefault();
            confirmDelete(url);
        }
    </script>
    {{-- <script src="{{ asset('backend/pages/pendaftaran/index.js') }}"></script> --}}
@endpush
