@extends('layouts.admin.master', ['title' => $title])
@push('css')
    <style>
        .title__description {
            text-align: justify!important;
        }
    </style>
@endpush

@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Proses Obat Pasien</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('data.antrian.bpjs') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em>
                                <span>Kembali</span>
                            </a>
                            <a href="#" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-content">
                                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tabItem1" data-toggle="tab">
                                            <em class="icon ni ni-user-circle"></em>
                                            <span>Personal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tabItem2" data-toggle="tab">
                                            <em class="icon ni ni-repeat"></em>
                                            <span>Detail Obat Pasien</span>
                                        </a>
                                    </li>
                                </ul><!-- .nav-tabs -->

                            <div class="card-inner">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                        {{-- Informasi pasien --}}
                                        <div class="nk-block">
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nama</span>
                                                        <span
                                                            class="profile-ud-value text-capitalize title__description">
                                                            {{ $pasien->nama_pasien }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                        <span
                                                            class="profile-ud-value text-capitalize title__description">
                                                            {{ $pasien->kode }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Umur</span>
                                                        <span
                                                            class="profile-ud-value title__description">
                                                            {{ usia($pasien->tanggal_lahir) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Kategori Pasien</span>
                                                        <span
                                                            class="profile-ud-value text-capitalize title__description">
                                                            {{ $pasien->kategori_pasien }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal Lahir</span>
                                                        <span
                                                            class="profile-ud-value title__description">
                                                            {{ tanggal($pasien->tanggal_lahir) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Diagnosa</span>
                                                        <span
                                                            class="profile-ud-value"></span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Alamat</span>
                                                        <span
                                                            class="profile-ud-value title__description">
                                                        {{ $pasien->alamat_pasien }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tindakan</span>
                                                        <span
                                                            class="profile-ud-value">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Informasi pasien --}}

                                        {{-- Form Obat --}}
                                        <div class="nk-divider divider md"></div>
                                        <div class="nk-block-head nk-block-head-sm nk-block-between">
                                            <h5 class="title">Ubah Data Obat</h5>
                                        </div>
                                        <form class="form-validate"
                                            action="">
                                            <div class="nk-block">
                                                <div class="row g-gs">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Nama<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control wrap" name="" id=""
                                                                value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- </form> --}}
                                            </div>
                                            {{-- End form Pemeriksaan --}}
                                        </div>
                                        
                                <div class="tab-pane" id="tabItem2">
                                    {{-- Table RM --}}
                                    <div class="nk-block nk-block-lg">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Tanggal Periksa</th>
                                                    <th scope="col">Nama Obat</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Harga Obat</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                
                                                    <tr>
                                                        <td class="text-center" colspan="8">
                                                            <h6>Belum ada
                                                                riwayat</h6>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Table RM --}}
                                </div>
                            </div><!-- .card-content -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div> 
@endsection
