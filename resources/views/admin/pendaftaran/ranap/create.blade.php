@extends('layouts.admin.master', ['title' => $title])

@push('css')
    <style>
        .modal-full {
            max-width: 90%;
            margin: 2% 5%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100vh;
            display: flex;
        }

    </style>
@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a href="{{ route('pendaftaran.rawat-inap.index') }}"
                                        class="btn btn-outline-dark d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <div class="fw-normal">
                                    <h2>{{ $title }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="title nk-block-title"><a
                                            href="{{ route('pendaftaran.rawat-inap.createPasienSudahPernahDaftar') }}">Pasien
                                            sudah
                                            pernah daftar<em class="icon ni ni-arrow-right"></em></a></h4>
                                </div>
                            </div>
                            <div class="card shadow card-bordered">
                                <div class="card-inner">
                                    <form class="form-validate" action="{{ route('pendaftaran.rawat-inap.store') }}">
                                        @csrf
                                        <div class="row g-gs">
                                            {{-- Form Kategori pasien --}}
                                            <div class="col-md-12"><span
                                                    class=" mt-3 bg-teal-dim rounded col-md-12 pt-3 preview-title-lg overline-title  text-dark">Kategori
                                                    Pasien</span>
                                            </div>
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
                                            <div class="col-md-6 d-none asuransi">
                                                <div class="form-group">
                                                    <label class="form-label">Asuransi <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <a href="" onclick="formAsuransi(`{{ route('asuransi.store') }}`)"
                                                        class="float-right" data-toggle="tooltip" data-placement="top"
                                                        title="Klik untuk menambahkan perusahaan asuransi">
                                                        Perusahaan asuransi belum
                                                        ada?
                                                    </a>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select select2" style="position:absolute;"
                                                            data-search="on" name="asuransi_id"
                                                            data-placeholder="Pilih asuransi">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($asuransi as $item)
                                                                <option data-asuransi="{{ $item->nama }}"
                                                                    value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 asuransi d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Asuransi <span
                                                            class="text-danger">*</span> </label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" class="form-control"
                                                            name="no_asuransi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bpjs d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor BPJS <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" class="form-control"
                                                            name="no_bpjs">
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
                                            {{-- <div class="col-md-6 d-none bpjs">
                                                <div class="form-group">
                                                    <label class="form-label">Faskes <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select select2" style="position:absolute;"
                                                            data-search="on" name="faskes_id"
                                                            data-placeholder="Pilih faskes">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($faskes as $item)
                                                                <option data-kategori="{{ $item->nama }}"
                                                                    value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- Form Identitas penanggung jawab pasien --}}
                                            <div class="col-md-12"><span
                                                    class=" mt-3 bg-teal-dim rounded col-md-12 pt-3 preview-title-lg overline-title  text-dark">Identitas
                                                    Penanggung Jawab
                                                    Pasien</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pasien Sama Dengan Penanggung Jawab ?<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <ul class="custom-control-group">
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" value="ya"
                                                                        class="custom-control-input"
                                                                        name="penanggung_jawab_sama_dengan_pasien" id="ya"
                                                                        onclick="penanggungJawabPasien('ya')">
                                                                    <label for="ya" class="custom-control-label"><em
                                                                            class="icon ni ni-check-thick"></em>Ya,
                                                                        Sama</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" class="custom-control-input"
                                                                        onclick="penanggungJawabPasien('tidak')"
                                                                        name="penanggung_jawab_sama_dengan_pasien"
                                                                        value="tidak" id="tidak" autocomplete="off">
                                                                    <label for="tidak" class="custom-control-label"><em
                                                                            class="icon ni ni-cross"></em>
                                                                        Tidak</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 penanggung-jawab-pasien d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Lengkap Penanggung Jawab <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" class="form-control"
                                                            name="nama_penanggung_jawab">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 penanggung-jawab-pasien d-none">
                                                <div class="form-group">
                                                    <label class="form-label">NIK KTP <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            name="nik_penanggung_jawab">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 penanggung-jawab-pasien d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Handphone /
                                                        WA <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-call"></em>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            name="no_hp_penanggung_jawab" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 penanggung-jawab-pasien d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Kelamin <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <ul class="custom-control-group">
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" value="laki-laki"
                                                                        class="custom-control-input"
                                                                        name="jenis_kelamin_penanggung_jawab" id="L">
                                                                    <label for="L" class="custom-control-label"><i
                                                                            class="fas fa-male mr-1"></i>Laki-laki</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" class="custom-control-input"
                                                                        name="jenis_kelamin_penanggung_jawab"
                                                                        value="perempuan" id="P" autocomplete="off">
                                                                    <label for="P" class="custom-control-label"><i
                                                                            class="fas fa-female mr-1"></i>
                                                                        Perempuan</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Hubungan Dengan Pasien <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            name="hubungan_dengan_pasien">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 penanggung-jawab-pasien d-none">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control form-control-sm"
                                                            name="alamat_penanggung_jawab" required
                                                            autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Form Identitas pasien --}}
                                            <div class="col-md-12"><span
                                                    class=" mt-3 bg-teal-dim rounded col-md-12 pt-3 preview-title-lg overline-title  text-dark">Identitas
                                                    Pasien</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Lengkap Pasien <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" class="form-control"
                                                            name="nama">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">NIK KTP <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            name="nik">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Kelamin <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <ul class="custom-control-group">
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" value="laki-laki"
                                                                        class="custom-control-input" name="jenis_kelamin"
                                                                        id="sex-male">
                                                                    <label for="sex-male" class="custom-control-label"><i
                                                                            class="fas fa-male mr-1"></i>Laki-laki</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-pro no-control">
                                                                    <input type="radio" class="custom-control-input"
                                                                        name="jenis_kelamin" value="perempuan"
                                                                        id="sex-female" autocomplete="off">
                                                                    <label for="sex-female" class="custom-control-label"><i
                                                                            class="fas fa-female mr-1"></i>
                                                                        Perempuan</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tempat Lahir <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            name="tempat_lahir">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Lahir <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-calendar"></em>
                                                        </div>
                                                        <input data-date-format="yyyy-mm-dd" name="tanggal_lahir"
                                                            type="text" class="form-control date-picker-alt">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Agama <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select select2" style="position:absolute;"
                                                            name="agama" data-placeholder="Pilih agama">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            <option value="islam">Islam</option>
                                                            <option value="protestan">Protestan</option>
                                                            <option value="katolik">Katolik</option>
                                                            <option value="hindu">Hindu</option>
                                                            <option value="budha">Budha</option>
                                                            <option value="khonghucu">Khonghucu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Golongan Darah</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="golongan_darah"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Handphone /
                                                        WA <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-call"></em>
                                                        </div>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email </label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-mail"></em>
                                                        </div>
                                                        <input type="text" class="form-control" name="email"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-subject">Pekerjaan</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="pekerjaan"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Status Perkawinan</label>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select select2" style="position:absolute;"
                                                            name="status_perkawinan"
                                                            data-placeholder="Pilih status perkawinan">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            <option value="belum kawin">Belum Kawin</option>
                                                            <option value="kawin">Kawin</option>
                                                            <option value="duda">Duda</option>
                                                            <option value="janda">Janda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control form-control-sm" name="alamat"
                                                            required autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Akhir Form Identitas pasien --}}

                                            <div class="col-md-12"><span
                                                    class=" mt-3 bg-teal-dim rounded col-md-12 pt-3 preview-title-lg overline-title  text-dark">Pendaftaran</span>
                                            </div>

                                            {{-- Form order pemeriksaan --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nurse Station <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <select
                                                            onchange="pilihNS(`{{ route('pendaftaran.rawat-inap.nurse-station') }}`, this)"
                                                            class="form-select select2" style="position:absolute;"
                                                            data-search="on" name="nurse_station_id"
                                                            data-placeholder="Pilih tujuan pasien">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($nurse_station as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Ruangan / Kamar <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <input readonly type="text" class="form-control" name="ruangan"
                                                            autocomplete="off">
                                                        <input type="hidden" class="form-control" name="ruangan_id"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-none umum">
                                                <div class="form-group">
                                                    <label class="form-label">Deposit Awal <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap ">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" autocomplete="off" name="deposit_awal"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Term Condition --}}
                                            <div class="col-md-12">
                                                <div id="faqs" class="accordion">
                                                    {{-- Persetujuan Umum --}}
                                                    <div class="accordion-item border border-bottom-0">
                                                        <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                                            data-target="#faq-q1">
                                                            <h6 class="title">Persetujuan Umum (General Concent)
                                                            </h6>
                                                            <span class="accordion-icon"></span>
                                                        </a>
                                                        <div class="accordion-body collapse" id="faq-q1"
                                                            data-parent="#faqs">
                                                            <div class="accordion-inner">
                                                                <p>If your <strong>end product</strong> including the item
                                                                    is going to be free to the end user then a
                                                                    <strong>Regular License</strong> is what you need. An
                                                                    <strong>Extended License</strong> is required if the
                                                                    <strong>end user</strong> must pay to use the
                                                                    <strong>end product</strong>.
                                                                </p>
                                                                <p>You may charge your client for your services to create an
                                                                    end product, even under the <strong>Regular
                                                                        License</strong>. <strong>But you can’t use one of
                                                                        our Standard Licenses on multiple clients or
                                                                        jobs.</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Persetujuan Aturan RS Firdaus Terkait Kondisi Pandemi --}}
                                                    <div class="accordion-item border">
                                                        <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                                            data-target="#faq-q2">
                                                            <h6 class="title">Persetujuan Aturan RS Firdaus
                                                                Terkait Kondisi Pandemi</h6>
                                                            <span class="accordion-icon"></span>
                                                        </a>
                                                        <div class="accordion-body collapse" id="faq-q2"
                                                            data-parent="#faqs">
                                                            <div class="accordion-inner">
                                                                <p>If your <strong>end product</strong> including the item
                                                                    is going to be free to the end user then a
                                                                    <strong>Regular License</strong> is what you need. An
                                                                    <strong>Extended License</strong> is required if the
                                                                    <strong>end user</strong> must pay to use the
                                                                    <strong>end product</strong>.
                                                                </p>
                                                                <p>You may charge your client for your services to create an
                                                                    end product, even under the <strong>Regular
                                                                        License</strong>. <strong>But you can’t use one of
                                                                        our Standard Licenses on multiple clients or
                                                                        jobs.</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-control-lg custom-checkbox">
                                                    <input type="checkbox" value="ya" class="custom-control-input"
                                                        id="customCheck2"
                                                        name="pasien_sudah_membaca_dan_setuju_dengan_peraturan">
                                                    <label class="custom-control-label" for="customCheck2">Pasien sudah
                                                        membaca informasi persetujuan umum dan persetujuan aturan dari RS
                                                        Firdaus dan setuju</label>
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

    @includeIf('admin.asuransi.partials._modal_form')
    @includeIf('admin.pendaftaran.ranap.partials._modal_bed')
@endsection

@push('js')
    <script>
        const modalBed = '.modal-bed';

        function penanggungJawabPasien(value) {
            if (value == 'tidak') {
                $('.penanggung-jawab-pasien').removeClass('d-none')
            } else {
                $('.penanggung-jawab-pasien').addClass('d-none')
            }
        }

        const pilihNS = (url, attr) => {
            let ns = $(attr).val();
            $('[name=ruangan_id] .kamar').remove();
            $.get(url, {
                    nurse_station_id: ns
                })
                .done(response => {
                    let data = response.data;
                    console.log(response);
                    $(modalBed).modal('show');
                    $(`${modalBed} .modal-body`).html(response.output);
                })
                .fail(error => {
                    alertError()
                })
        }

        const pilihRuangan = (ruangan_id, ruangan) => {
            $(modalBed).modal('hide');
            $('input[name=ruangan_id]').val(ruangan_id);
            $('input[name=ruangan]').val(ruangan);
        }

        const kategoriPasienDaftar = (attr) => {
            let kategori = $(attr).val();
            if (kategori == 1) {
                $('.bpjs').removeClass('d-none')
            } else {
                $('.bpjs').addClass('d-none')
            }
            if (kategori == 2) {
                $('.umum').removeClass('d-none')
            } else {
                $('.umum').addClass('d-none')
            }
            if (kategori == 3) {
                $('.asuransi').removeClass('d-none')
            } else {
                $('.asuransi').addClass('d-none')
            }
        }

        function submitForm(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(originalForm).find('.form-control').removeClass('select2-hidden-accessible');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);

                    }
                })
                .done(response => {
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();
                })
        }

        const formAsuransi = (url) => {
            event.preventDefault();
            $('.modal-asuransi').modal('show')
            $(`.modal-asuransi form`).attr('action', url);
            $('.modal-form [name=_method]').val('post');
        }

        function submitAsuransi(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(originalForm).find('.form-control').removeClass('select2-hidden-accessible');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: $(originalForm).serialize(),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);
                    }
                })
                .done(response => {
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    pindahHalaman(reloadHalaman(), 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();
                })
        }
    </script>
@endpush
