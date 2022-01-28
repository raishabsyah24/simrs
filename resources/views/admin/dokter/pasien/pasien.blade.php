@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to"
                                    href="{{ route('dokter.daftar-pasien') }}"><em
                                        class="icon ni ni-arrow-left"></em><span>Kembali</span></a></div>
                            <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
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
                                                {{-- Informasi pasien --}}
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
                                                    </div>
                                                </div>
                                                {{-- End Informasi pasien --}}

                                                {{-- Form Pemeriksaan --}}
                                                <div class="nk-divider divider md"></div>
                                                <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                    <h5 class="title">Pemeriksaan</h5>
                                                </div>
                                                <form class="form-validate"
                                                    action="{{ route('dokter.store-pasien', $periksa_dokter_id) }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="nk-block">
                                                        <div class="row g-gs">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Keluhan Pasien<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="keluhan" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Subjektif<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="subjektif" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Objektif<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="objektif" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Assesment<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control form-control-sm"
                                                                            name="assesment" autocomplete="off"></textarea>
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
                                                                                    <input type="radio" value="lab"
                                                                                        class="custom-control-input"
                                                                                        name="plan" id="lab">
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
                                                                                        name="plan" value="radiologi"
                                                                                        id="radiologi" autocomplete="off">
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
                                                                                        name="plan" value="perempuan"
                                                                                        id="terapi" autocomplete="off">
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Status Lanjutan<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap ">
                                                                        <select class="form-select select2"
                                                                            style="position:absolute;"
                                                                            name="status_lanjutan"
                                                                            data-placeholder="Pilih data">
                                                                            <option label="Pilih data" disabled selected
                                                                                value=""></option>
                                                                            <option value="dirujuk">Dirujuk</option>
                                                                            <option value="selesai">Selesai</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Jadwal Kontrol</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-calendar"></em>
                                                                        </div>
                                                                        <input data-date-format="yyyy-mm-dd"
                                                                            name="jadwal_kontrol" type="text"
                                                                            class="form-control date-picker">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- </form> --}}
                                                    </div>
                                                    {{-- End form Pemeriksaan --}}

                                                    {{-- Obat pasien --}}
                                                    <div class="nk-divider divider md"></div>
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Obat Pasien</h5>
                                                    </div>
                                                    <div class="nk-block">
                                                        {{-- <form class="form-validate"> --}}
                                                        @csrf
                                                        <div class="row g-gs">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Masukan nama obat<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-control-wrap">
                                                                        <input
                                                                            onkeyup="searchObat(`{{ $periksa_dokter_id }}`,`{{ route('dokter.search-obat') }}`,this)"
                                                                            class="form-control form-control-lg"
                                                                            name="obat" placeholder="Masukan nama obat"
                                                                            autocomplete="off">
                                                                        <div class="dropdown-obat"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">No</th>
                                                                        <th class="text-center">Nama Obat</th>
                                                                        <th class="text-center">Dosis</th>
                                                                        <th class="text-center">Satuan</th>
                                                                        <th class="text-center">Signa</th>
                                                                        <th>Harga Obat</th>
                                                                        <th>Subtotal</th>
                                                                        <th class="text-center">Opsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="data-obat">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        {{-- Button submit --}}
                                                        <div class="col-md-7 offset-lg-5 mt-4">
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
                                                        {{-- </form> --}}
                                                    </div>
                                                </form>
                                                {{-- End Obat pasien --}}
                                            </div>
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
                                                </div>
                                                {{-- Table RM --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        reloadTable();

        async function searchObat(id, url, attr) {
            if ($('.dropdown-obat').hasClass('d-none')) {
                $('.dropdown-obat').removeClass('d-none');
            }

            let obat = $(attr).val();

            await $.get(url, {
                    obat: obat,
                    periksa_dokter_id: id
                })
                .done(output => {
                    if (output != '') {
                        $('.dropdown-obat').html(output);
                    }
                })
        }

        function pilihObat(obat_apotek_id, periksa_dokter_id, url) {
            event.preventDefault();
            $('.dropdown-obat').addClass('d-none');
            $.post({
                    url: url,
                    type: 'post',
                    data: {
                        obat_apotek_id: obat_apotek_id,
                        periksa_dokter_id: periksa_dokter_id
                    }
                })
                .done(response => {
                    $('[name=obat]').val('')
                    alertSuccess(response.message);
                    let url = response.url;
                    $.get(url)
                        .done(output => {
                            $('table .data-obat').html(output);
                            reloadTable();
                        })
                })
        }

        function reloadTable() {
            setTimeout(() => {
                $.get(`/dokter/obat-pasien/{{ $periksa_dokter_id }}`)
                    .done(response => {
                        let limit = response.limit;
                        if (limit == 'limit') {
                            $('input[name=obat]').prop('disabled', true);
                            alertError('Limit bos');
                        }
                        $('table .data-obat').html(response.output);
                    })
            }, 600);
        }

        function updateQuantity(url, attr, obat_pasien_periksa_rajal_id) {
            let qty = $(attr).val();
            $('input[name=obat]').prop('disabled', false);

            $.post({
                    url: url,
                    data: {
                        _method: "PUT",
                        jumlah: qty,
                        obat_pasien_periksa_rajal_id: obat_pasien_periksa_rajal_id,
                    },
                })
                .done(response => {
                    console.log(response);
                    let limit = response.limit;
                    if (limit == 'limit') {
                        $(attr).val(1);
                        $('input[name=obat]').prop('disabled', true);
                        alertError('Pasien bpjs sudah mencapai limit obat',
                            'Silahkan kurangi jumlah obat atau kurangi obat pasien');
                    }
                    reloadTable();
                })
        }

        function hapusObat(url, id) {
            $.post({
                    url: url,
                    data: {
                        _method: "DELETE",
                        id: id
                    },
                })
                .done(response => {
                    alertSuccess(response.message)
                    reloadTable();
                })
        }

        function submitForm(originalForm) {
            event.preventDefault();
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
                    console.log(response);
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
        }
    </script>
@endpush
