@extends('layouts.admin.master', ['title' => $title])

@push('css')
    <style>
        #data {
            display: block;
        }
    </style>
@endpush

@section('admin-content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Pasien / <strong class="text-primary small">
                                    {{ $pasien->nama_pasien }}
                                </strong>
                            </h3>
                            <div class="nk-block-des text-soft">
                                <ul class="list-inline">
                                    <li>No. Antrian Apotek: <span class="text-base">UD003054</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ url('apotek/data-umum') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-content">
                                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">
                                            <em class="icon ni ni-user-circle"></em>
                                            <span>Personal</span>
                                        </a>
                                    </li>
                                </ul><!-- .nav-tabs -->
                                <div id="informasi-pasien" class="accordion">
                                    <div class="accordion-item">
                                        <a href="#" class="accordion-head" data-toggle="collapse" data-target="#accordion-item-1">
                                            <h6 class="title">Informasi Pasien</h6>
                                            <span class="accordion-icon"></span>
                                        </a>
                                        <div class="accordion-body collapse show" id="accordion-item-1" data-parent="#informasi-pasien">
                                            <div class="accordion-inner">
                                                <div class="nk-block">
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nama</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->nama_pasien }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Alamat</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->alamat }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Umur</span>
                                                                <span class="profile-ud-value">
                                                                    {{ usia($pasien->tanggal_lahir) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->no_rekam_medis }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Tanggal Lahir</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->tanggal_lahir }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Kategori Pasien</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->kategori_pasien }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <h6 class="title overline-title text-base">Informasi Lainnya</h6>
                                                    </div><!-- .nk-block-head -->
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nama Dokter</span>
                                                                <span class="profile-ud-value">{{ $pasien->nama_dokter }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Tujuan Poli</span>
                                                                <span class="profile-ud-value">{{ $pasien->spesialis }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Tanggal Periksa</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $pasien->tanggal_pemeriksaan }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .profile-ud-list -->
                                                </div><!-- .nk-block -->
                                            </div>
                                        </div>
                                    </div>
                                  </div>  
                            </div><!-- .card-content -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
                
                <div class="row my-4">
                    <div class="col-12">
                        <div class="nk-block">
                            <div class="card card-bordered card-stretch">
                                <div class="card-inner-group">
                                    <div class="card-inner p-0">
                                        <div class="nk-tb-list nk-tb-ulist is-compact">
                                            <div class="nk-tb-item nk-tb-head">
                                                
                                            <div class="nk-tb-col nk-tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">No</h5>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">Nama Obat</h5>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">Signa</h5>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">Jumlah</h5>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">Harga</h5>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="sub-text">
                                                    <h5 class="title">Subtotal</h5>
                                                </span>
                                            </div>
                                              
                                            </div><!-- .nk-tb-item -->
                                            @forelse ($obat as $item)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-md">
                                                    <p class="fs-15px">
                                                        {!! $loop->iteration !!}
                                                    </p>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-md">
                                                    <p class="fs-15px">
                                                        {!! $item->nama_generik !!}
                                                    </p>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <p class="fs-15px">
                                                        {!! $item->signa1 !!} x  {!! $item->signa2 !!}
                                                    </p>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <p class="fs-15px">
                                                        {!! $item->jumlah !!}
                                                    </p>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <p class="fs-15px">
                                                       Rp. {!! formatAngka($item->harga_obat) !!}
                                                    </p>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <ul class="list-status">
                                                        <li>
                                                            <em class="icon text-success ni ni-check-circle"></em> 
                                                            <p class="fs-15px">
                                                               Rp. {!! formatAngka($item->subtotal) !!}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">   
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            @empty
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <h4 class="text-center">Belum ada layanan</h4>
                                                </div>
                                                <div class="nk-tb-col"></div>
                                            </div>
                                            @endforelse
                                           <div class="nk-tb-item">
                                               <div class="nk-tb-col nk-tb-col-md">
                                                   
                                               </div>
                                               <div class="nk-tb-col nk-tb-col-md">
                                                   
                                               </div>
                                               <div class="nk-tb-col nk-tb-col-md">
                                                   
                                               </div>
                                               <div class="nk-tb-col nk-tb-col-md">
                                                   
                                               </div>
                                               <div class="nk-tb-col nk-tb-col-md">
                                                  <h5 class="title">Total</h5>
                                               </div>
                                               <div class="nk-tb-col nk-tb-col-md">
                                                    <p class="fs-15px text-success">
                                                        {!! formatAngka($obat->sum('subtotal'), true) !!}
                                                    </p>
                                               </div>
                                           </div>
                                        </div><!-- .nk-tb-list -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
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