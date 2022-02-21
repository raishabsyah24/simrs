@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content ">
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
                            <a href="{{ url('apotek/bpjs') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
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
                                {{-- <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Informasi Pasien</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nama</span>
                                                    <span class="profile-ud-value">{{ $pasien->nama_pasien }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Alamat</span>
                                                    <span class="profile-ud-value"></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Umur</span>
                                                    <span class="profile-ud-value">{{ usia($pasien->tanggal_lahir) }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                    <span class="profile-ud-value">IO</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tanggal Lahir</span>
                                                    <span class="profile-ud-value">{{ $pasien->tanggal_lahir }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Kategori Pasien</span>
                                                    <span class="profile-ud-value">IO</span>
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
                                                    <span class="profile-ud-value">{{ $pasien->tanggal_pemeriksaan }}</span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div><!-- .nk-block -->
                                   
                                </div><!-- .card-inner --> --}}
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
                <div class="card my-3">
                    <div class="card-body">
                        <div class="nk-divider divider md"></div>
                        <div class="nk-block">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Detail Obat Pasien</h5>
                            </div><!-- .nk-block-head -->
                            <table class="table table-hover">
                                <thead class="bg-dark text-white">
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Obat</th>
                                    <th >Signa</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" class="d-flex justify-content-end">Subtotal</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 @forelse($obat as $item)
                                  <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->nama_generik }}</td>
                                    <td>{{ $item->signa1 }} x {{ $item->signa2 }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ formatAngka($item->harga_obat) }}</td>
                                    <td class="text-right">Rp. {{ formatAngka($item->subtotal) }}</td>
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
                                      <td colspan="3"></td>
                                      <td><h5>Total</h5></td>
                                      <td colspan="2" class="text-right">{{ formatAngka($obat->sum('subtotal'), true) }}</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection