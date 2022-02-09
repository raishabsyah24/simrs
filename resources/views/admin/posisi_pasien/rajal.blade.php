@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub"><a class="back-to"
                                        href="{{ route('pendaftaran.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a></div>
                                <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Notifications</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner">
                                                <div class="timeline">
                                                    <ul class="timeline-list">
                                                        {{-- <li class="timeline-item">
                                                            <div class="timeline-status bg-primary is-outline"></div>
                                                            <div class="timeline-date">13 Nov <em
                                                                    class="icon ni ni-alarm-alt"></em></div>
                                                            <div class="timeline-data">
                                                                <h6 class="timeline-title">Submited KYC Application</h6>
                                                                <div class="timeline-des">
                                                                    <p>Re-submitted KYC Application form.</p>
                                                                    <span class="time">09:30am</span>
                                                                </div>
                                                            </div>
                                                        </li> --}}
                                                        @foreach ($data as $item)
                                                            <li class="timeline-item">
                                                                @if ($item->status == 'proses')
                                                                    <div class="timeline-status bg-primary is-outline">
                                                                    </div>
                                                                @else
                                                                    <div class="timeline-status bg-primary"></div>
                                                                @endif
                                                                <div class="timeline-date mr-5">{!! tanggalJam($item->waktu) !!}
                                                                </div>
                                                                <div class="timeline-data">
                                                                    <h6 class="timeline-title">{!! $item->aktifitas !!}</h6>
                                                                    <div class="timeline-des">
                                                                        {{-- <p>Keterangan</p> --}}
                                                                        <span
                                                                            class="badge badge-dim badge-success">{!! $item->keterangan !!}</span>
                                                                        {{-- @dd($data->last()->status) --}}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        {{-- <li class="timeline-item">
                                                            <div class="timeline-status bg-pink"></div>
                                                            <div class="timeline-date">13 Nov <em
                                                                    class="icon ni ni-alarm-alt"></em></div>
                                                            <div class="timeline-data">
                                                                <h6 class="timeline-title">Submited KYC Application</h6>
                                                                <div class="timeline-des">
                                                                    <p>Re-submitted KYC Application form.</p>
                                                                    <span class="time">09:30am</span>
                                                                </div>
                                                            </div>
                                                        </li> --}}
                                                    </ul>
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
    </div>
@endsection

@push('js')
@endpush
