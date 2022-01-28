@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-3">
                        <a href="" class="nk-block-des text-soft"><em class="icon ni ni-arrow-left-fill-c"></em>
                            Kembali
                        </a>
                        <div class="nk-block-des">
                            <h4 class="title nk-block-title">Form Tambah Medis</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                    </div>
                                    <form action="{{ route('data.store-medis') }}" method="post" class="nk-wizard nk-wizard-simple is-alter">
                                        @csrf
                                        <div class="nk-wizard-head">
                                            <h5>Step 1</h5>
                                        </div>
                                        <div class="nk-wizard-content">
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Nik <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" name="nik" id="nik" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Nama Lengkap <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="nama" name="nama">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Nomer Str <span class="text-danger">
                                                            *</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="no_str" name="no_str">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Spesialis 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select class="form-control" name="spesialis" >
                                                                    <option value="" disabled selected>
                                                                        Pilih spesialis ...</option>
                                                                        @foreach ($poli as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama }}
                                                                    </option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                            </div>
                                        </div>
                                        <div class="nk-wizard-head">
                                            <h5>Step 2</h5>
                                        </div>
                                        <div class="nk-wizard-content">
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Tempat Lahir</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" >
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
                                                        <label class="form-label" for="#">
                                                            Tanggal Lahir</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control date-picker-alt" id="tanggal_lahir" data-date-format="yyyy-mm-dd" name="tanggal_lahir" >
                                                        </div>
                                                    </div>
                                                </div> <!-- .col -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">
                                                            Email</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email"class="form-control" id="email" name="email" >
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                            </div>
                                        </div>
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">No Hp</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control " id="no_hp" name="no_hp" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">
                                                            Alamat</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control form-control-sm" name="alamat">
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                         <div class="row g-3">
                                            <div class="col-lg-7 offset-lg-5">
                                                <div class="form-group mt-2">
                                                    <button type="button" class="btn btn-lg btn-primary" 
                                                    onclick="submitForm(this.form)" 
                                                    >Simpan</button>
                                                    <button type="reset"  title="Kosongkan form" 
                                                            class="btn btn-lg btn-secondary">Reset</button>
                                                    <button type="button" class="btn btn-lg btn-warning button-cancel">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>  {{-- .form --}}
                                </div><!-- .nk-block -->    
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
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
    });

        // alert success
        function alert_success(message) {
            Toast.fire({
                icon: "success",
                title: message,
            });
        }

        // alert error
        function alert_error(
            message = "Terjadi kesalahan, silahkan hubungi developer"
        ) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,
            });
        }
        // Simpan 
        function submitForm(originalForm) {
            $(originalForm).find('.form-control').removeClass('is-invalid');
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(response => {
                    alert_success(response.message);
                    setInterval(() => {
                        window.location.reload();
                    }, 3000);

                    $('[name=nik]').val('');
                    $('[name=nama]').val('');
                    $('[name=no_str]').val('');
                    $('[name=spesialis]').val('');
                    $('[name=tempat_lahir]').val('');
                    $('[name=tanggal_lahir]').val('');
                    $('[name=tanggal_lahir]').val('');
                    $('[name=email]').val('');
                    $('[name=no_hp]').val('');
                    $('[name=alamat]').val('');
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alert_error();
                })
        }
    </script>
@endpush