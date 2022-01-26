@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title align-center">Form Tambah Obat</h4>
                        </div>
                    </div>
                    <div class="card form-obat">
                        <div class="card-inner">
                            <form action="{{ route('order.store.obat') }}" method="post" class="gy-3">
                                @csrf
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-name">Nama Paten</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="nama_paten" id="nama_paten" placeholder="Nama paten">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Nama Generik</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="nama_generik" id="nama_generik" placeholder="Nama generik">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Komposisi</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="komposisi" id="komposisi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Satuan</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="satuan_id">
                                                    @foreach ($jenis_satuan as $item)
                                                  <option value={{ $item->id }}>{{ $item->nama }} ~
                                                      {{ ($item->jumlah) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Stok</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" 
                                                    name="stok" placeholder="Stok opname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="minimal_stok" placeholder="Min stok">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="maksimal_stok" placeholder="Max stok">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-off">Harga Jual</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <span class="align-start">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga jual">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-off">Expired Date</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <span class="align-start">Exp</span>
                                                </div>
                                                <input type="text" class="form-control date-picker-alt" name="ed" id="ed" placeholder="Exp date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="button" class="btn btn-lg btn-primary" 
                                            onclick="submitForm(this.form)">Tambah</button>
                                            <button type="reset"  title="Kosongkan form" 
                                                    class="btn btn-lg btn-secondary">Reset</button>
                                            <button type="button" class="btn btn-lg btn-warning button-cancel">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- card -->
                </div><!-- .nk-block -->
                </div><!-- .components-preview -->
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

                    $('[name=nama_generik]').val('');
                    $('[name=nama_paten]').val('');
                    $('[name=komposisi]').val('');
                    $('[name=satuan_id]').val('');
                    $('[name=stok]').val('');
                    $('[name=minimal_stok]').val('');
                    $('[name=maksimal_stok]').val('');
                    $('[name=ed]').val('');
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