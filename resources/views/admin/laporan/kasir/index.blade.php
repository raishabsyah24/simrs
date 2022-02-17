@extends('layouts.admin.master', ['title' => $title])
@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{!! $title !!}</h3>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
