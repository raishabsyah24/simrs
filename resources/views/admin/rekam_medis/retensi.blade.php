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
                                    Retensi
                                </h3>
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="row mt-2">
                                @foreach ($total as $item)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg3">
                                                <div class="card-inner pb-0">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">
                                                                {{ $item[0] }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount fw-normal">
                                                                {{ formatAngka($item[1]) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .nk-ecwg -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        @include('admin.pendaftaran.fetch')
                        <input type="hidden" name="page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/pages/pendaftaran.js') }}"></script>
@endpush
