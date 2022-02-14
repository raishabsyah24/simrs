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

                                <form action="{{ route('dokter.update-jadwal-praktek', $dokter->id) }}" method="post"
                                    enctype="multipart/form-data" class="gy-3">
                                    @csrf
                                    @method('put')
                                    {{-- Senin --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Jadwal Praktek
                                                    <span class="form-note">Kosongkan jam jika dihari dalam form tidak
                                                        ada jadwal</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="senin" name="hari[]"
                                                            class="form-control">
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
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Selasa --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="selasa" name="hari[]"
                                                            class="form-control">
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
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Rabu --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="rabu" name="hari[]"
                                                            class="form-control">
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
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Kamis --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="kamis" name="hari[]"
                                                            class="form-control">
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
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Jum'at --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="jum'at" name="hari[]"
                                                            class="form-control">
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
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Sabtu --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="sabtu" name="hari[]"
                                                            class="form-control">
                                                    </div>
                                                    <div class="row mt-3 d-flex">
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_mulai[]"
                                                                    class="form-control " placeholder="Jam mulai praktek">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">Sampai</div>
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Minggu --}}
                                    <div class="row align-center after">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <div class="mt-3 form-control-wrap">
                                                    <div class="form-control-wrap">
                                                        <input type="text" readonly value="minggu" name="hari[]"
                                                            class="form-control">
                                                    </div>
                                                    <div class="row mt-3 d-flex">
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_mulai[]"
                                                                    class="form-control " placeholder="Jam mulai praktek">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">Sampai</div>
                                                        <div class="col-lg-5">
                                                            <div class="form-control-wrap">
                                                                <input type="time" name="jam_selesai[]"
                                                                    class="form-control "
                                                                    placeholder="Jam selesai praktek">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-12 offset-lg-5">
                                            <div class="form-group mt-2">
                                                <button type="submit" onclick="submitForm(this.form)"
                                                    class="tombol-simpan btn btn-lg btn-primary">
                                                    <span class="text-simpan">Update</span>
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
