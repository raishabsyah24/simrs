@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

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
                        @include('admin.dokter.pasien.fetch')
                        <input type="hidden" name="page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/pages/periksa_pasien_rajal/index.js') }}"
@endpush
