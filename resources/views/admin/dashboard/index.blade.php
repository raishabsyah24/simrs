@extends('layouts.admin.master', ['title' => 'Dashboard'])

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                        data-toggle="dropdown"><em
                                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                                class="d-none d-md-inline">Last</span> 30
                                                            Days</span><em
                                                            class="dd-indc icon ni ni-chevron-right"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Last 30 Days</span></a>
                                                            </li>
                                                            <li><a href="#"><span>Last 6 Months</span></a>
                                                            </li>
                                                            <li><a href="#"><span>Last 1 Years</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                                        class="icon ni ni-reports"></em><span>Reports</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            @role('super_admin|pendaftaran|admin')
                                @foreach ($total as $item)
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg6">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">{{ $item[0] }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount">
                                                                {{ $item[1] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endrole
                            @role('dokter')
                                <div class="col-xxl-3 col-sm-6">
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner p-0">
                                                <div class="card-title-group mb-3">
                                                    <div class="card-title">
                                                        <h6 class="title mt-2 ml-2">Total Pasien Saya Bulan {{ date('F') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-list">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col">
                                                            <h6>No.</h6>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <h6>Tanggal</h6>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <h6>Jumlah Pasien</h6>
                                                        </div>
                                                    </div>
                                                    @forelse ($dokter['data'] as $item)
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col">
                                                                <span class="tb-lead text-center">{!! $loop->iteration !!}</span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span class="tb-lead">{!! tanggal($item->tanggal) !!}</span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span class="tb-lead">{!! formatAngka($item->jumlah) !!}</span>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col">
                                                                <span class="tb-sub"></span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span class="tb-lead">Belum ada</span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span class="tb-sub"></span>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <span class="tb-sub"></span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="tb-lead">Total</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span
                                                                class="tb-lead">{{ $dokter['data']->sum('jumlah') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endrole
                            <div class="col-xxl-6">
                                <div class="card card-full">
                                    <div class="nk-ecwg nk-ecwg8 h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">Sales Statistics</h6>
                                                </div>
                                            </div>
                                            <ul class="nk-ecwg8-legends">
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#6576ff"></span>
                                                        <span>Total Order</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#eb6459"></span>
                                                        <span>Canceled Order</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="nk-ecwg8-ck">
                                                <canvas class="ecommerce-line-chart-s4" id="salesStatistics"></canvas>
                                            </div>
                                            <div class="chart-label-group pl-5">
                                                <div class="chart-label">01 Jul, 2020</div>
                                                <div class="chart-label">30 Jul, 2020</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/js/charts/chart-ecommerce.js?ver=2.9.1') }}"></script>
@endpush
