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
                                <h3 class="nk-block-title page-title">GUDANG FARMASI</h3>
                            </div>
                        </div>
                        <h3 class="nk-block-title page-title">PO</h3>
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
                                               Buat PO
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

                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PO GUDANG FARMASI FIRDAUS HOSPITAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form class="image-upload" method="post" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Nomor PO</label>
                        <input type="text" name="name" id="name" class="form-control"/>
                    </div>  
                    <div class="form-group">
                        <label>Nama Pembuat PO</label>
                        <input type="text" name="name" id="name" class="form-control"/>
                    </div>  <div class="form-group">
                        <label>Perusahaan tujuan</label>
                        <input type="text" name="name" id="name" class="form-control"/>
                    </div>  <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="name" id="name" class="form-control"/>
                    </div>  


                    <div class="form-group">
                        <label>Pembuat PO</label>
                        <input type="text" name="auther_name" id="auther_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Jumalh Obat</label>
                        <textarea name="description" class="textarea form-control" id="description" cols="40" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="formSubmit">Save</button>
            </div>
        </div>
    </div>
</div>

                    {{-- Table --}}
                    <div class="nk-block fetch-data d-none">
                        @include('admin.gudang.po.fetch_po')
                        <input type="hidden" name="page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/pages/activity_log.js') }}"></script>
@endpush
