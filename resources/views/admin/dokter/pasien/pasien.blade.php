@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ $pasien->nama_pasien }}</h3>
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em
                                                    class="icon ni ni-user-circle-fill"></em><span>Informasi
                                                    Pasien</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem2"><em
                                                    class="icon ni ni-property"></em><span>Rekam Medis</span></a>
                                        </li>
                                    </ul>
                                    <div class="card-inner">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <div class="nk-block">
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nama</span>
                                                                <span
                                                                    class="profile-ud-value text-capitalize">{{ $pasien->nama_pasien }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Jenis Kelamin</span>
                                                                <span
                                                                    class="profile-ud-value text-capitalize">{{ $pasien->jenis_kelamin }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Umur</span>
                                                                <span
                                                                    class="profile-ud-value">{{ usia($pasien->tanggal_lahir) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Kategori Pasien</span>
                                                                <span
                                                                    class="profile-ud-value text-capitalize">{{ $pasien->kategori_pasien }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Tanggal Lahir</span>
                                                                <span
                                                                    class="profile-ud-value">{{ tanggal($pasien->tanggal_lahir) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $pasien->no_rekam_medis }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Golongan Darah</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $pasien->golongan_darah ?? '' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Alamat</span>
                                                                <span
                                                                    class="profile-ud-value text-justify">{{ $pasien->alamat }}</span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .profile-ud-list -->
                                                </div>
                                                <div class="nk-divider divider md"></div>
                                                {{-- Form Pemeriksaan --}}
                                                <div class="nk-block">
                                                    <form class="form-validate" action="">
                                                        @csrf
                                                        <div class="row g-gs">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Keluhan Pasien<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="alamat" required
                                                                            autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Subjektif<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="alamat" required
                                                                            autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Objektif<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="alamat" required
                                                                            autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Plan
                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <ul class="custom-control-group">
                                                                            <li>
                                                                                <div
                                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                                    <input type="radio" value="laki-laki"
                                                                                        class="custom-control-input"
                                                                                        name="jenis_kelamin" id="lab">
                                                                                    <label for="lab"
                                                                                        class="custom-control-label"><i
                                                                                            class="fas fa-vials mr-1"></i>Cek
                                                                                        Laboratorium</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div
                                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                                    <input type="radio"
                                                                                        class="custom-control-input"
                                                                                        name="jenis_kelamin"
                                                                                        value="perempuan" id="radiologi"
                                                                                        autocomplete="off">
                                                                                    <label for="radiologi"
                                                                                        class="custom-control-label"><i
                                                                                            class="fas fa-radiation mr-1"></i>
                                                                                        Cek Radiologi</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div
                                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                                    <input disabled type="radio"
                                                                                        class="custom-control-input"
                                                                                        name="jenis_kelamin"
                                                                                        value="perempuan" id="terapi"
                                                                                        autocomplete="off">
                                                                                    <label for="terapi"
                                                                                        class="custom-control-label"><i
                                                                                            class="fas fa-female mr-1"></i>
                                                                                        Cek Terapi</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Button submit --}}
                                                            <div class="col-md-7 offset-lg-5">
                                                                <div class="form-group">
                                                                    <button type="submit" onclick="submitForm(this.form)"
                                                                        class="tombol-simpan btn btn-lg btn-primary">
                                                                        <span class="text-simpan">Simpan</span>
                                                                        <span
                                                                            class="loading-simpan d-none ml-2 spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                {{-- <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Form Pemeriksaan</h5>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Website Setting</h5>
                                                            </div>
                                                            <form action="#" class="gy-3">
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="site-name">Site Name</label>
                                                                            <span class="form-note">Specify the name of
                                                                                your website.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    id="site-name"
                                                                                    value="DashLite Admin Template">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Site Email</label>
                                                                            <span class="form-note">Specify the email
                                                                                address of your website.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    id="site-email"
                                                                                    value="info@softnio.com">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Site
                                                                                Copyright</label>
                                                                            <span class="form-note">Copyright
                                                                                information of your website.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    id="site-copyright"
                                                                                    value="© 2022, DashLite. All Rights Reserved.">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Allow
                                                                                Registration</label>
                                                                            <span class="form-note">Enable or disable
                                                                                registration from site.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <ul
                                                                            class="custom-control-group g-3 align-center flex-wrap">
                                                                            <li>
                                                                                <div
                                                                                    class="custom-control custom-radio checked">
                                                                                    <input type="radio"
                                                                                        class="custom-control-input"
                                                                                        checked="" name="reg-public"
                                                                                        id="reg-enable">
                                                                                    <label class="custom-control-label"
                                                                                        for="reg-enable">Enable</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio"
                                                                                        class="custom-control-input"
                                                                                        name="reg-public" id="reg-disable">
                                                                                    <label class="custom-control-label"
                                                                                        for="reg-disable">Disable</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio"
                                                                                        class="custom-control-input"
                                                                                        name="reg-public" id="reg-request">
                                                                                    <label class="custom-control-label"
                                                                                        for="reg-request">On Request</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Main
                                                                                Website</label>
                                                                            <span class="form-note">Specify the URL if
                                                                                your main website is external.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    name="site-url"
                                                                                    value="https://www.softnio.com">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3 align-center">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="site-off">Maintanance Mode</label>
                                                                            <span class="form-note">Enable to make
                                                                                website make offline.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-switch">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="reg-public" id="site-off">
                                                                                <label class="custom-control-label"
                                                                                    for="site-off">Offline</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col-lg-7 offset-lg-5">
                                                                        <div class="form-group mt-2">
                                                                            <button type="submit"
                                                                                class="btn btn-lg btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div><!-- tab pane -->
                                            <div class="tab-pane" id="tabItem2">
                                                {{-- Table RM --}}
                                                <div class="nk-block nk-block-lg">
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Tanggal Kunjungan</th>
                                                                <th scope="col">Poli</th>
                                                                <th scope="col">Dokter</th>
                                                                <th scope="col">Subjektif</th>
                                                                <th scope="col">Objektif</th>
                                                                <th scope="col">Assesment</th>
                                                                <th scope="col">Plan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($rekam_medis as $item)
                                                                <tr>
                                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                    <td>{{ tanggal($item->tanggal_periksa) }}</td>
                                                                    <td>{{ $item->poli }}</td>
                                                                    <td>{{ $item->dokter }}</td>
                                                                    <td>{{ $item->subjektif }}</td>
                                                                    <td>{{ $item->objektif }}</td>
                                                                    <td>{{ $item->assesment }}</td>
                                                                    <td>{{ $item->plan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    {{-- <table class="datatable-init nowrap nk-tb-list is-separate"
                                                        data-auto-responsive="false">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col"><span>Tanggal Kunjungan</span>
                                                                </th>
                                                                <th class="nk-tb-col"><span>Poli</span></th>
                                                                <th class="nk-tb-col"><span>Dokter</span></th>
                                                                <th class="nk-tb-col"><span>Subjektif</span></th>
                                                                <th class="nk-tb-col"><span>Objektif</span></th>
                                                                <th class="nk-tb-col"><span>Assessment</span></th>
                                                                <th class="nk-tb-col"><span>Plan</span></th>
                                                            </tr><!-- .nk-tb-item -->
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($data as $item)
                                                                <tr class="nk-tb-item">
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-lead">{{ tanggal($item->tanggal_periksa) }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-lead text-capitalize">{{ $item->poli }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-sub">{{ $item->dokter }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-sub">{{ $item->subjektif }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-sub">{{ $item->objektif }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-sub">{{ $item->assesment }}</span>
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        <span
                                                                            class="tb-sub">{{ $item->plan }}</span>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td>Tidak ada</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table> --}}
                                                </div>
                                                {{-- Table RM --}}
                                            </div>
                                            <!--tab pane-->
                                        </div>
                                        <!--tab content-->
                                    </div>
                                    <!--card inner-->
                                </div><!-- .card-content -->
                            </div><!-- .card-aside-wrap -->
                        </div>
                        <!--card-->
                    </div>
                    <!--nk block lg-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
