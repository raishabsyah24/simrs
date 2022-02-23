@extends('layouts.admin.master', ['title' => $title])

@push('css')
@endpush

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item active">Layanan</li>
                </ul>
            </nav>
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{!! $title !!}</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <button onclick="addForm(`{{ route('layanan.store') }}`)" class="btn btn-primary"><em
                                        class="icon ni ni-plus"></em>
                                    Tambah Layanan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                        </div>
                                        <div class="card-tools mr-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                        data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li>
                                                <li class="btn-toolbar-sep"></li>
                                                <li>
                                                    <div class="toggle-wrap">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle"
                                                            data-target="cardTools"><em
                                                                class="icon ni ni-menu-right"></em></a>
                                                        <div class="toggle-content" data-content="cardTools">
                                                            <ul class="btn-toolbar gx-1">
                                                                <li class="toggle-close">
                                                                    <a href="#" class="btn btn-icon btn-trigger toggle"
                                                                        data-target="cardTools"><em
                                                                            class="icon ni ni-arrow-left"></em></a>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown">
                                                                        <a href="#"
                                                                            class="btn btn-trigger btn-icon dropdown-toggle"
                                                                            data-toggle="dropdown">
                                                                            <em class="icon ni ni-setting"></em>
                                                                        </a>
                                                                        <div
                                                                            class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                                            <ul class="link-check">
                                                                                <li><span>Order</span></li>
                                                                                <li><a href="#"
                                                                                        onclick="sortBy('desc')">DESC</a>
                                                                                </li>
                                                                                <li><a href="#"
                                                                                        onclick="sortBy('asc')">ASC</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search"
                                                    data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text" name="query" onkeyup="search(this)"
                                                    class="form-control border-transparent form-focus-none"
                                                    placeholder="Cari data">
                                                <button class="search-submit btn btn-icon"><em
                                                        class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Loader --}}
                                <div class="loader card-inner p-0">
                                    <div class="d-flex justify-content-center my-5">
                                        <div class="spinner-grow text-secondary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Table --}}
                                <div class="card-inner p-0 fetch-data d-none">
                                    @include('admin.layanan.fetch')
                                    <input type="hidden" name="page" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('admin.layanan.partials.modal_form')
@endsection

@push('js')
    <script src="{{ asset('backend/pages/layanan.js') }}"></script>
    <script>
        const modal = '.modal-form';


        function addForm(url) {
            $(modal).modal("show");
            $(".modal-title").text("Form Tambah Layanan");
            $(`${modal} form`).attr('action', url)
        }

        async function editForm(url) {
            await $.get(url)
                .done(response => {
                    resetForm(`${modal} form`);
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text("Ubah Data Layanan");
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('put');
                    loopForm(response.data);
                })
                .fail(errors => {
                    alertError();
                    return;
                });

        }

        function submitForm(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
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
                    $(modal).modal('hide');
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
