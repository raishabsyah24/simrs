@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div class="nk-content mt-5">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a class="back-to" href="{{ route('kasir.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <div class="fw-normal">
                                    <h2 class="float-left mb-5">{{ $title }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    Identitas Pasien--}}
                    <div id="identitas-pasien" class="mt-5 accordion border border-right-0 border-top-0 rounded-top border-primary">
                        <div class="accordion-item">
                            <a href="#" class="accordion-head" data-toggle="collapse" data-target="#accordion-item-1">
                                <h6 class="title">Identitas Pasien</h6>
                                <span class="accordion-icon"></span>
                            </a>
                            <div class="accordion-body collapse show" id="accordion-item-1" data-parent="#identitas-pasien">
                                <div class="accordion-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nama</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                  {!! $identitas_pasien->nama_pasien !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Jenis Kelamin</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                    {!! $identitas_pasien->jenis_kelamin !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                    <span class="profile-ud-value">
                                                    {!! $identitas_pasien->no_rekam_medis !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tanggal Lahir</span>
                                                    <span class="profile-ud-value">
                                                    {!! tanggal($identitas_pasien->tanggal_lahir) !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Umur</span>
                                                    <span class="profile-ud-value">
                                                    {!! usia($identitas_pasien->tanggal_lahir) !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Kategori Pasien</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                    {!! $identitas_pasien->kategori_pasien !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor HP</span>
                                                    <span class="profile-ud-value">
                                                    {!! $identitas_pasien->no_hp !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Alamat</span>
                                                    <span class="profile-ud-value text-justify">
                                                    {!! $identitas_pasien->alamat !!}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Deposit Awal</span>
                                                    <span class="profile-ud-value deposit-awal">
                                                        </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tanggal Deposit Awal</span>
                                                    <span class="profile-ud-value">
                                                    {!! $identitas_pasien->tanggal_deposit ? tanggalJam($identitas_pasien->tanggal_deposit) : 'Belum ada deposit' !!}
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    End Identitas Pasien--}}
                        <div class="nk-tb-list is-separate my-3">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text"><h5>No</h5></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><h5>Tanggal Layanan</h5></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><h5>Layanan</h5></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><h5 class="text-center">Tarif</h5></span></div>
                            </div>
                            @forelse ($layanan as $item)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ $loop->iteration }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ tanggalJam($item->tanggal_layanan) }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ $item->jenis_tagihan }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="text-right pr-3 fs-18px ff-mono">{{ formatAngka($item->subtotal, true) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <h4 class="text-center">Belum ada layanan</h4>
                                    </div>
                                    <div class="nk-tb-col"></div>
                                </div>
                            @endforelse
                            {{--                        Diskon--}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Diskon</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="text-right pr-3 fs-18px ff-mono">{!! $kasir->diskon !!} %</p>
                                </div>
                            </div>
                            {{--                        End Diskon--}}

                            {{--                        Pajak--}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Pajak</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="text-right pr-3 fs-18px ff-mono">{!! $kasir->pajak !!} %</p>
                                </div>
                            </div>
                            {{--                        End Pajak--}}

                            {{--                        Metode Pembayaran--}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Metode Pembayaran</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="text-right pr-3 fs-18px ff-mono text-uppercase">{!! $kasir->metode_pembayaran !!}</p>
                                </div>
                            </div>
                            {{--                        End Metode Pembayaran--}}

                            {{--                        Status Pembayaran--}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Status Pembayaran</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="text-right pr-3 fs-18px ff-mono text-uppercase">{!! $kasir->status_pembayaran !!}</p>
                                </div>
                            </div>
                            {{--                        End Status Pembayaran--}}

                            {{--                        Grand Total--}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <h5 class="fs-15px">Grand Total</h5>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <h4 class="text-right pr-3 fs-18px ff-mono">{{ formatAngka(totalTagihan($kasir->id), true) }}</h4>
                                </div>
                            </div>
                            {{--                        End Grand Total--}}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
