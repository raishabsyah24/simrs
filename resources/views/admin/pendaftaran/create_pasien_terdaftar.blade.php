@extends('layouts.admin.master', ['title' => $title])
@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a href="{{ route('pendaftaran.index') }}"
                                        class="btn btn-outline-dark d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <div class="fw-normal">
                                    <h2>{{ $title }}</h2>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <form class="form-validate"
                                        action="{{ route('pendaftaran.storePasienSudahPernahDaftar') }}">
                                        @csrf
                                        <div class="row g-gs">
                                            {{-- Form Identitas pasien --}}
                                            <div class="col-md-12"><span
                                                    class="ml-1 preview-title-lg overline-title">Identitas Pasien</span>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="form-label">NIK / Nama Pasien <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            onkeyup="searchData(`{{ route('pendaftaran.search-pasien') }}`,this)"
                                                            autofocus placeholder="Masukan nama pasien / NIK KTP pasien"
                                                            autocomplete="off" type="text" class="form-control"
                                                            name="pasien">
                                                        <div class="dropdown-pasien d-none">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Card pasien --}}
                                            <div class="col-sm-6 d-none offset-lg-4 card-pasien col-lg-4 col-xxl-3">
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="team">
                                                            <div class="user-card user-card-s2">
                                                                <div class="user-avatar md bg-info">
                                                                    <span>JL</span>
                                                                    <div class="status dot dot-lg dot-success"></div>
                                                                </div>
                                                                <div class="user-info">
                                                                    <h6 class="nama-pasien"></h6>
                                                                    <span class="sub-text nik-pasien"></span>
                                                                </div>
                                                            </div>
                                                            <div class="team-view">
                                                                <button type="button" onclick="showModalPasien()"
                                                                    class="btn btn-round btn-outline-light w-150px"><span>Lihat
                                                                        Detail</span></button>
                                                            </div>
                                                        </div><!-- .team -->
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card -->
                                            </div>


                                            <div class="col-md-12">
                                                <span class="ml-1 mt-2 preview-title-lg overline-title">
                                                    Pemeriksaan</span>
                                            </div>

                                            {{-- Form order pemeriksaan --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Kategori Pasien <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select onchange="kategoriPasienDaftar(this)"
                                                            class="form-select select2" style="position:absolute;"
                                                            name="kategori_pasien" data-placeholder="Pilih kategori pasien">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($kategori_pasien as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Periksa <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-calendar"></em>
                                                        </div>
                                                        <input data-date-format="yyyy-mm-dd" name="tanggal" type="text"
                                                            class="form-control date-picker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bpjs d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor SEP <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="no_sep"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-none bpjs">
                                                <div class="form-group">
                                                    <label class="form-label">Faskes <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select data-search="on" class="form-select select2"
                                                            style="position:absolute;" class="form-control"
                                                            name="faskes_id" data-placeholder="Pilih faskes">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($faskes as $item)
                                                                <option data-kategori="{{ $item->nama }}"
                                                                    value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Poli <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select data-search="on"
                                                            onchange="pilihPoli(`{{ route('pendaftaran.dokter-poli') }}`, this)"
                                                            class="form-select select2" style="position:absolute;"
                                                            name="poli_id" data-placeholder="Pilih tujuan pasien">
                                                            <option data-search="on" label="Pilih data" disabled selected
                                                                value=""></option>
                                                            @foreach ($poli as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dokter <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select data-search="on" class="form-select select2 dokter-poli"
                                                            style="position:absolute;" name="dokter_id"
                                                            data-placeholder="Pilih dokter">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tujuan <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select select2 dokter-poli"
                                                            style="position:absolute;" data-search="on" name="layanan_id"
                                                            data-placeholder="Pilih layanan pasien">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($layanan as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->keterangan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Informasi Tambahan</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control form-control-sm"
                                                            name="informasi_tambahan" required
                                                            autocomplete="off"></textarea>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('admin.pendaftaran.partials._modal_detail_pasien')
@endsection

@push('js')
    <script src="{{ asset('backend/pages/pendaftaran/create_sudah_daftar.js') }}"></script>
@endpush
