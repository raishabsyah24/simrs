@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub"><a class="back-to"
                                        href="{{ route('pendaftaran.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a></div>
                                <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
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
                                            <div class="col-md-12">
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
                                                    <label class="form-label">Layanan <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="form-control-wrap ">
                                                        <select data-search="on" class="form-select select2 dokter-poli"
                                                            style="position:absolute;" name="layanan_id"
                                                            data-placeholder="Pilih layanan pasien">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            @foreach ($layanan as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
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
                                                        <select class="form-select select2" style="position:absolute;"
                                                            name="tujuan">
                                                            <option label="Pilih data" disabled selected value=""></option>
                                                            <option value="periksa">Periksa</option>
                                                            <option value="lab">Lab</option>
                                                            <option value="radiologi">Radiologi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Informasi Tambahan</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control form-control-sm" name="keterangan"
                                                            required autocomplete="off"></textarea>
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
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>

    @includeIf('admin.pendaftaran.partials._modal_detail_pasien')
@endsection

@push('js')
    {{-- <script src="{{ asset('backend/pages/pendaftaran.js') }}"></script> --}}
    <script>
        function searchData(url, attr) {
            $('.card-pasien').addClass('d-none');
            let data = $(attr).val();
            $.get(url, {
                    data: data
                })
                .done(output => {
                    if (output != '') {
                        $('.dropdown-pasien').removeClass('d-none');
                        $('.dropdown-pasien').fadeIn();
                        $('.dropdown-pasien').html(output);
                    }
                    if (data == '') {
                        $('.dropdown-pasien').addClass('d-none');
                    }
                })
                .fail((error) => {
                    alertError();
                });
        }

        function pilihData(id, url) {
            $('.dropdown-pasien').addClass('d-none');
            $.get(url, {
                    id: id
                })
                .done(response => {
                    let pasien = response.data;
                    $('.card-pasien').removeClass('d-none');
                    $('[name=pasien]').val(pasien.id);
                    if (pasien.jenis_kelamin == 'laki-laki') {
                        $('.nama-pasien').text('Tn. ' + pasien.nama);
                    } else {
                        $('.nama-pasien').text('Ny. ' + pasien.nama);
                    }
                    $('.nik-pasien').text(pasien.nik);
                    $('.tanggal-lahir-pasien').text(response.usia);
                    $('.jenis-kelamin-pasien').text(pasien.jenis_kelamin);
                    $('.no-hp-pasien').text(pasien.no_hp);
                    $('.alamat-pasien').text(pasien.alamat);
                    $('.tanggal-periksa-pasien').text(response.tanggal_periksa);
                    $('.poli-pasien').text(pasien.tujuan);
                    $('.dokter-pasien').text(pasien.dokter);
                })
                .fail(error => {
                    alertError();
                });
        }

        function showModalPasien() {
            $('.modal-detail-pasien').modal('show');
        }

        function pilihPoli(url, attr) {
            let poli = parseInt($(attr).val());
            $("[name=dokter_id] .dokter-id").remove();
            $.get(url, {
                    poli_id: poli,
                })
                .done((response) => {
                    let data = response.data;
                    data.forEach(function(item) {
                        $("[name=dokter_id]").append(
                            `<option class="dokter-id" value="${item.id}">${item.nama_dokter} (${item.jam_mulai} - ${item.jam_selesai})</option>`
                        );
                    });
                })
                .fail((error) => {
                    alertError();
                });
        }

        function kategoriPasienDaftar(attr) {
            let bpjs = parseInt($(attr).val());
            if (bpjs === 1) {
                $(".bpjs").removeClass("d-none");
            } else {
                $(".bpjs").addClass("d-none");
            }
        }

        function submitForm(originalForm) {
            event.preventDefault();
            $(originalForm).find(".form-control").removeClass("error");
            $(originalForm)
                .find(".form-control")
                .removeClass("select2-hidden-accessible");
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr("action"),
                    data: new FormData(originalForm),
                    beforeSend: function() {
                        $(originalForm).find(".tombol-simpan").attr("disabled", true);
                        $(originalForm).find(".text-simpan").text("Menyimpan . . .");
                        $(originalForm).find(".loading-simpan").removeClass("d-none");
                    },
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    complete: function() {
                        $(originalForm).find(".loading-simpan").addClass("d-none");
                        $(originalForm).find(".text-simpan").text("Simpan");
                        $(originalForm).find(".tombol-simpan").attr("disabled", false);
                    },
                })
                .done((response) => {
                    $(originalForm).find(".tombol-simpan").attr("disabled", true);
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
                .fail((errors) => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();
                });
        }
    </script>
@endpush
