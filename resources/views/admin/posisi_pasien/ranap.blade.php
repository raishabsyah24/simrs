@extends('layouts.admin.master', ['title' => $title])
@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub"><a class="back-to"
                                        href="{{ route('pendaftaran.rawat-jalan.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a></div>
                                <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-10">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Jumlah Waktu Yang Dikeluarkan Pasien
                                                            <br>{{ jumlahWaktuPasien($data->first()->waktu, $data->last()->waktu) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner">
                                                <div class="timeline">
                                                    <ul class="timeline-list">
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
                                                                        <span
                                                                            class="badge badge-dim badge-success">{!! $item->keterangan !!}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
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
