@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <nav>
            <ul class="breadcrumb breadcrumb-arrow">
                <li class="breadcrumb-item active">List Obat</li>
            </ul>
        </nav>
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{!! $title !!}</h3>
                            <div class="nk-block-des text-soft">
                                <p>Total Obat {{ formatAngka($total) }}</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <a href="#" class="btn btn-white btn-dim btn-outline-primary" onclick="modalAddObat()">
                                                                    <em class="icon ni ni-plus"></em>
                                                                    <span>Tambah Obat</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                               <a href="#" class="btn btn-white btn-dim btn-outline-primary">
                                                                <em class="icon ni ni-reports"></em>
                                                                <span>Export ke PDF</span>
                                                            </a>
                                                            </li>
                                                        </ul>
                                                    </div><!-- .toggle-expand-content -->
                                                </div><!-- .toggle-wrap -->
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
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
                                @include('admin.apotek.data_obat._fetch-data')
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
@include('admin.apotek.data_obat.partials._modal_blade')
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.fetch-data').removeClass('d-none');
            $('.loader').addClass('d-none');
        })

        async function fetchData(page = '', query = '', sortBy = 'desc') {
            await $.get(`/obat/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}`)
                .done(data => {
                    $('.loader').addClass('d-none');
                    $('.fetch-data').removeClass('d-none');
                    $('.fetch-data').html(data)
                })
        }

        function search(el) {
            let query = $(el).val(),
                page = $('input[name=page]').val();
            $('.loader').removeClass('d-none');
            $('.fetch-data').addClass('d-none');
            fetchData(page, query);
        }

        function sortBy(sortBy) {
            let page = $('input[name=page]').val(),
                query = $('input[name=query]').val();
            $('.loader').removeClass('d-none');
            $('.fetch-data').addClass('d-none');
            fetchData(page, query, sortBy);
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1],
                query = $('input[name=query]').val();
            $('.loader').removeClass('d-none');
            $('.fetch-data').addClass('d-none');
            fetchData(page, query);
        })

        function modalAddObat () {
            $('.modal-obat').modal('show');
        }

        function minus(){
            event.preventDefault();
            console.log('ok');
        }

        function plus(){
            event.preventDefault();
            console.log('ok');
        }
    </script>
@endpush