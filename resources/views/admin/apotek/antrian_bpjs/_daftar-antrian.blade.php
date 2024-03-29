@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <nav>
            <ul class="breadcrumb breadcrumb-arrow">
                <li class="breadcrumb-item active">List Antrian</li>
            </ul>
        </nav>
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{!! $title !!}</h3>
                            <div class="nk-block-des text-soft">
                                <p>Total Antrian Apotek {{ formatAngka($total) }}</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
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
                        </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle">
                                <div class="card-title-group">
                                    <div class="card-tools">
                                    </div><!-- .card-tools -->
                                    <div class="card-tools mr-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                    data-target="search"><em class="icon ni ni-search"></em></a>
                                            </li><!-- li -->
                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                            <li>
                                                <div class="toggle-wrap">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle"
                                                        data-target="cardTools"><em
                                                            class="icon ni ni-menu-right"></em></a>
                                                    <div class="toggle-content" data-content="cardTools">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li class="toggle-close">
                                                                <a href="#" class="btn btn-icon btn-trigger toggle"
                                                                    data-target="cardTools"><em
                                                                        class="icon ni ni-arrow-left"></em></a>
                                                            </li><!-- li -->
                                                            <!-- li -->
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#"
                                                                        class="btn btn-trigger btn-icon dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        <em class="icon ni ni-setting"></em>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                                        <ul class="link-check">
                                                                            <li><span>Order</span></li>
                                                                            <li><a href="#"
                                                                                    onclick="sortBy('desc')">DESC</a>
                                                                            </li>
                                                                            <li><a href="#"
                                                                                    onclick="sortBy('asc')">ASC</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div><!-- .dropdown -->
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- .toggle-content -->
                                                </div><!-- .toggle-wrap -->
                                            </li><!-- li -->
                                        </ul><!-- .btn-toolbar -->
                                    </div><!-- .card-tools -->
                                </div><!-- .card-title-group -->
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="card-body">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search"
                                                data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" name="query" onkeyup="search(this)"
                                                class="form-control border-transparent form-focus-none"
                                                placeholder="Cari data">
                                            <button class="search-submit btn btn-icon"><em
                                                    class="icon ni ni-search"></em></button>
                                        </div>
                                    </div>
                                </div><!-- .card-search -->
                            </div>
                            <!-- .card-inner data -->
                            <div class="loader card-inner p-0">
                                <div class="d-flex justify-content-center my-5">
                                    <div class="spinner-grow text-secondary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0 fetch-data d-none">
                                @include('admin.apotek.antrian_bpjs._fetch-data_bpjs')
                                <input type="hidden" name="page" value="1">
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="/backend/pages/apotek/index.js"></script>
@endpush