@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a class="back-to" href="{{ route('dokter.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <h4 class="nk-block-title page-title align-center">Form {{ $title }}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <form action="{{ route('dokter.store') }}" method="post" enctype="multipart/form-data"
                                    class="gy-3">
                                    @csrf
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="site-name">Nama Lengkap <span
                                                        class="text-danger">*</span>
                                                    <span class="form-note">Nama beserta gelar dokter.</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        placeholder="contoh : dr. Muhammad, Sp.PD" name="nama"
                                                        autocomplete="off" placeholder="Nama">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">NIK <span class="text-danger">*</span>
                                                    <span class="form-note">Nomor Induk Kependudukan.</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="nik"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Nomor STR
                                                    <span class="form-note">Nomor Surat Tanda Registrasi jika
                                                        ada.</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="no_str"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Kelamin <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
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
                                                                    name="jenis_kelamin" value="perempuan" id="sex-female"
                                                                    autocomplete="off">
                                                                <label for="sex-female" class="custom-control-label"><i
                                                                        class="fas fa-female mr-1"></i>
                                                                    Perempuan</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Tempat Lahir <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="tempat_lahir"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Lahir <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input data-date-format="yyyy-mm-dd" name="tanggal_lahir" type="text"
                                                        class="form-control date-picker-alt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Nomor Handphone <span
                                                        class="text-danger">*</span>
                                                    <span class="form-note">Nomor handphone yang ada whatsapp.</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="no_hp"
                                                        autocomplete="off" placeholder="contoh : 086421932132">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Username <span class="text-danger">*</span>
                                                    <span class="form-note">Username (digunakan untuk username
                                                        user).</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="username"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="text-danger">*</span>
                                                    <span class="form-note">Email aktif (digunakan untuk login
                                                        user).</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="email"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Bergabung
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input data-date-format="yyyy-mm-dd" name="tanggal_bergabung"
                                                        type="text" class="form-control date-picker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Spesialis <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <select class="form-select select2" style="position:absolute;"
                                                        data-search="on" name="poli_id" data-placeholder="Pilih data">
                                                        <option label="Pilih data" disabled selected value=""></option>
                                                        @foreach ($poli as $item)
                                                            <option data-kategori="{{ $item->nama }}"
                                                                value="{{ $item->id }}">
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Foto Dokter
                                                    <span class="form-note">Foto dokter maksimal ukuran 2 MB.</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" name="foto" class="custom-file-input" id="foto">
                                                        <label class="custom-file-label" for="foto">Pilih foto</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Alamat <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-sm" name="alamat" required
                                                        autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center after">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label">Jadwal Praktek <span
                                                        class="text-danger">*</span>
                                                    <span class="form-note">Tekan tombol tambah jika ada hari
                                                        lain</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <select class="form-control" name="hari[]" data-placeholder="Hari">
                                                        <option value="" disabled selected>Pilih hari</option>
                                                        <option value="senin">Senin</option>
                                                        <option value="selasa">Selasa</option>
                                                        <option value="rabu">Rabu</option>
                                                        <option value="kamis">Kamis</option>
                                                        <option value="jum'at">Jum'at</option>
                                                        <option value="sabtu">Sabtu</option>
                                                        <option value="minggu">Minggu</option>
                                                    </select>
                                                </div>
                                                <div class="row mt-3 d-flex">
                                                    <div class="col-lg-5">
                                                        <div class="form-control-wrap">
                                                            <input type="time" name="jam_mulai[]" class="form-control "
                                                                placeholder="Jam mulai praktek">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">Sampai</div>
                                                    <div class="col-lg-5">
                                                        <div class="form-control-wrap">
                                                            <input type="time" name="jam_selesai[]" class="form-control "
                                                                placeholder="Jam selesai praktek">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button onclick="tambahWaktuPraktek()" class="btn btn-dark mb-5 mt-1">
                                                <em class="icon ni ni-plus"></em>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- Form copy --}}
                                    <div class="copy d-none">
                                        <div class="row g-3 align-center isi" id="1">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div class="mt-3 form-control-wrap">
                                                        <select class="form-control" name="hari[]"
                                                            data-placeholder="Hari">
                                                            <option value="" disabled selected>Pilih hari</option>
                                                            <option value="senin">Senin</option>
                                                            <option value="selasa">Selasa</option>
                                                            <option value="rabu">Rabu</option>
                                                            <option value="kamis">Kamis</option>
                                                            <option value="jum'at">Jum'at</option>
                                                            <option value="sabtu">Sabtu</option>
                                                            <option value="minggu">Minggu</option>
                                                        </select>
                                                    </div>
                                                    <div class="row mt-3 d-flex">
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_mulai[]"
                                                                    class="form-control" placeholder="Jam mulai praktek">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">Sampai</div>
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control"
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button onclick="hapusField(this)" id="1"
                                                    class="btn btn-danger mb-5 mt-3 btn-tambah">
                                                    <em class="icon ni ni-trash-alt"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-12 offset-lg-5">
                                            <div class="form-group mt-2">
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
@endsection

@push('js')
    <script>
        let i = 1;

        function tambahWaktuPraktek() {
            event.preventDefault();
            i++;
            let html = $(".copy").html();
            $('.isi').attr('id', i);
            $('.btn-tambah').attr('id', i);
            // console.log(html);
            $(".after").after(html);
        }

        function hapusField(attr) {
            event.preventDefault();
            // let btn = $(attr).attr("id");
            // console.log(btn);
            // $('.isi').attr('id', btn).remove();
        }

        // Simpan 
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
    </script>
@endpush
