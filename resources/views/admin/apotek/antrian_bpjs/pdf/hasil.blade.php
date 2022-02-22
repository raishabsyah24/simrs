@extends('layouts.print.master')

@push('css')
@endpush
    <style>
        .medich__contact {
            margin: 0 0 15px 20px;
        }
        
        .admin__note  {
            box-shadow: none!important;
            border: 0!important;
        }

        .description {
            cursor: default;
        }

        .firdaus-brands {
            text-align: center;
            align-items: center;
        }
        
    </style>
@section('print-content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="invoice-brand firdaus-brands">
                        <img src="/backend/images/logo-rs.jpeg">
                    </div>
                    <div class="invoice-contact medich__contact">
                        <div class="invoice-contact-info mt-3">
                            <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em>
                                    <span>Jl.Siak Blok J5/14, Kel. Sukapura, <br> Cilincing, Jakarta Utara, DKI Jakarta</span></li>
                                <li><em class="icon ni ni-call-fill fs-14px"></em>
                                    <span>(021) 4407322</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                    </ul><!-- .nav-tabs -->
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Informasi Pasien</h5>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nama Pasien</span>
                                                        <span class="profile-ud-value">{{ $query->nama_pasien }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Berat Badan</span>
                                                        <span class="profile-ud-value">Abu Bin Ishtiyak</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal Lahir</span>
                                                        <span class="profile-ud-value">{{ $query->tanggal_lahir }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal </span>
                                                        <span class="profile-ud-value">10 Aug, 1980</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Umur</span>
                                                        <span class="profile-ud-value">{{ usia($query->tanggal_lahir) }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Ruangan </span>
                                                        <span class="profile-ud-value">10 Aug, 1980</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                        <span class="profile-ud-value">{{ $query->no_rekam_medis }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Riwayat Alergi Obat </span>
                                                        <span class="profile-ud-value">10 Aug, 1980</span>
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
                                                        <span class="profile-ud-value">{{ $query->nama_dokter }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal Periksa</span>
                                                        <span class="profile-ud-value">{{ $query->tanggal_pemeriksaan }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tujuan Poli</span>
                                                        <span class="profile-ud-value">{{ $query->spesialis }}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-divider divider md"></div>
                                        <div class="nk-block">
                                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                <h5 class="title">Catatan Tambahan</h5>
                                            </div><!-- .nk-block-head -->
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id">
                                                            <span class="">#</span>
                                                        </th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Nama Obat</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-none d-md-block">
                                                                    <span>Signa</span>
                                                                    <span>Jumlah</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount" colspan="3">
                                                            <span class="tb-tnx-total">Harga</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">
                                                                Subtotal
                                                            </span>
                                                        </th>
                                                     </tr>
                                                 </thead>
                                                <tbody>
                                                    @forelse ($drug as $item)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <span>{{ $loop->iteration }}</span>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">
                                                                    {{ $item->nama_generik }}
                                                                </span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">
                                                                    {{ $item->signa1 }} x {{ $item->signa2 }}
                                                                </span>
                                                                <span class="date">
                                                                    {{ $item->jumlah }}
                                                                </span>
                                                            </div>
                                                            <td class="tb-tnx-amount" colspan="3">
                                                                <div class="tb-tnx-total">
                                                                    <span class="amount">
                                                                        Rp. {{ formatAngka($item->harga_obat) }}
                                                                    </span>
                                                                </div>
                                                                <div class="tb-tnx-status">
                                                                    <span class="badge badge-dot badge-success">
                                                                       Rp. {{ formatAngka($item->subtotal) }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center" colspan="8">
                                                                <h6>Belum ada
                                                                    riwayat</h6>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td>
                                                            <h5>Total</h5>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ formatAngka($drug->sum('subtotal'), true) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                         </div><!-- .bq-note -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-block">
                                            <div class="container">
                                                <div class="nk-content-inner">
                                                    <div class="nk-content-body">
                                                        <div class="row justify-content-center">
                                                            <h4 class="nk-block-title fw-normal">
                                                                Perubahan Resep
                                                            </h4>
                                                        </div>
                                                        <div class="row my-4 justify-content-center">
                                                            <div class="col-md-12">
                                                                <table class="table table-bordered text-center">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Tertulis</th>
                                                                        <th>Menjadi</th>
                                                                        <th>Petugas Farmasi</th>
                                                                        <th>Disetujui</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr style="height: 125px">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-content -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function printPromot() {
            window.print();
        }
    </script>
@endpush
