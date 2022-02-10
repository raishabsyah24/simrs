@extends('layouts.admin.master')

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
                            <a href="{{ url('apotek/bpjs') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em>
                                <span>Kembali</span>
                            </a>
                            <a href="#" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
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
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nama</span>
                                                    <span class="profile-ud-value text-capitalize title__description">
                                                        {{ $pasien->nama_pasien }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                    <span
                                                        class="profile-ud-value text-capitalize title__description">
                                                        {{ $pasien->no_rekam_medis }}
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
                                                    <span class="profile-ud-label">Kategori </span>
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
                                                        {{ $pasien->tanggal_lahir }}
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
                                                        {{ $pasien->alamat }}
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

                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head nk-block-head-sm nk-block-between">
                                            <h5 class="title">Admin Note</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block nk-block-lg">
                                            {{-- Table detail obat --}}
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Tanggal Periksa</th>
                                                        <th scope="col">Nama Obat</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga Obat</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($data as $item)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td></td>
                                                            <td>{{ $item->nama_generik }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <span class="badge-dim badge-{{ $badge->random() }}">
                                                                    {{ $item->status_menerima ?? '' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td class="text-center" colspan="8">
                                                                <h6>Belum ada
                                                                    riwayat</h6>
                                                            </td>
                                                        </tr>
                                                </tbody>
                                                @endforelse
                                            </table>
                                            <div class="form-group mt-1">
                                                <div class="col-lg-12 offset-col-md-5 d-flex justify-content-center">
                                                    <button type="button" class="btn btn-success" 
                                                    onclick="approvePasien('{{ route('apotek.pasien-bpjs-update', $pasien->pemeriksaan_id) }}')">Konfirmasi
                                                    </button>
                                                </div>
                                            </div>
                                            {{-- End detail obat --}}
                                        </div>
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-content -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        // Fungsi update status pasien
        function approvePasien(url, pemeriksaan_id) {
            console.log(url);
            event.preventDefault();
            $.post({
                    url: url,
                    type: 'POST',
                    data: {
                        pemeriksaan : pemeriksaan_id

                    },
                })
                .done(response => {
                    alertSuccess(response.message);
                    // setInterval(() => {
                    //     window.location.reload();
                    // }, 5000);
                })
        }
    </script>
@endpush