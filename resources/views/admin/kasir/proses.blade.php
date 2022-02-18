@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div id="url-kasir" data-url="{{ route('kasir.proses', $kasir->id) }}" class="d-none"></div>
    <div class="nk-content mt-5">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a href="{{ route('kasir.index') }}"
                                        class="btn btn-outline-dark d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <div class="fw-normal">
                                    <h2>{{ $title }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block-head nk-block-head-sm float-right">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="fw-normal">
                                    <button onclick="addForm(`{{ route('kasir.tambah-deposit', $kasir->id) }}`)"
                                        class="btn btn-success shadow py-3 mr-2"><span class="text-dark">Tambah
                                            Deposit Pasien</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Identitas Pasien --}}
                    <div id="identitas-pasien"
                        class="accordion border mt-5 border-right-0 border-top-0 rounded-top border-primary">
                        <div class="accordion-item">
                            <a href="#" class="accordion-head" data-toggle="collapse" data-target="#accordion-item-1">
                                <h6 class="title">Identitas Pasien</h6>
                                <span class="accordion-icon"></span>
                            </a>
                            <div class="accordion-body collapse show" id="accordion-item-1" data-parent="#identitas-pasien">
                                <div class="accordion-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nama</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                        {!! $identitas_pasien->nama_pasien !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Jenis Kelamin</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                        {!! $identitas_pasien->jenis_kelamin !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                    <span class="profile-ud-value">
                                                        {!! $identitas_pasien->no_rekam_medis !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tanggal Lahir</span>
                                                    <span class="profile-ud-value">
                                                        {!! tanggal($identitas_pasien->tanggal_lahir) !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Umur</span>
                                                    <span class="profile-ud-value">
                                                        {!! usia($identitas_pasien->tanggal_lahir) !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Kategori Pasien</span>
                                                    <span class="profile-ud-value text-capitalize">
                                                        {!! $identitas_pasien->kategori_pasien !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nomor HP</span>
                                                    <span class="profile-ud-value">
                                                        {!! $identitas_pasien->no_hp !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Alamat</span>
                                                    <span class="profile-ud-value text-justify">
                                                        {!! $identitas_pasien->alamat !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Deposit Awal</span>
                                                    <span class="profile-ud-value deposit-awal">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tanggal Deposit Awal</span>
                                                    <span class="profile-ud-value">
                                                        {!! $identitas_pasien->tanggal_deposit ? tanggalJam($identitas_pasien->tanggal_deposit) : 'Belum ada deposit' !!}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Identitas Pasien --}}
                    <form action="{{ route('kasir.update-status', $kasir->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="nk-tb-list is-separate my-3">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text">
                                        <h5>No</h5>
                                    </span></div>
                                <div class="nk-tb-col"><span class="sub-text">
                                        <h5>Tanggal Layanan</h5>
                                    </span></div>
                                <div class="nk-tb-col"><span class="sub-text">
                                        <h5>Layanan</h5>
                                    </span></div>
                                <div class="nk-tb-col"><span class="sub-text">
                                        <h5 class="text-center">Tarif</h5>
                                    </span></div>
                            </div>
                            @forelse ($layanan as $item)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ $loop->iteration }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ tanggalJam($item->tanggal_layanan) }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="fs-15px">{{ $item->jenis_tagihan }}</p>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <p class="text-right pr-3 fs-18px ff-mono">
                                            {{ formatAngka($item->subtotal, true) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <h4 class="text-center">Belum ada layanan</h4>
                                    </div>
                                    <div class="nk-tb-col"></div>
                                </div>
                            @endforelse
                            {{-- Diskon --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Diskon</p>
                                </div>
                                <div class="nk-tb-col tb-col-md w-25">
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">
                                                <h4 class="pt-1">%</h4>
                                            </span>
                                        </div>
                                        <input name="diskon" type="number" class="form-control form-control-lg"
                                            autocomplete="off"
                                            onkeyup="setTotal(`{{ route('kasir.update-tagihan', $kasir->id) }}`, this)">
                                    </div>
                                </div>
                            </div>
                            {{-- End Diskon --}}

                            {{-- Pajak --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Pajak</p>
                                </div>
                                <div class="nk-tb-col tb-col-md w-25">
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">
                                                <h4 class="pt-1">%</h4>
                                            </span>
                                        </div>
                                        <input name="pajak" autocomplete="off" type="number"
                                            class="form-control form-control-lg"
                                            onkeyup="setTotal(`{{ route('kasir.update-tagihan', $kasir->id) }}`, this)">
                                    </div>
                                </div>
                            </div>
                            {{-- End Pajak --}}
                            {{-- Metode Pembayaran --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Metode Pembayaran</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <div class="form-control-wrap">
                                        <select class="form-control-lg form-control form-select select2"
                                            style="position:absolute;" name="metode_pembayaran"
                                            data-placeholder="Pilih metode pembayaran">
                                            <option label="Pilih data" disabled selected value=""></option>
                                            <option value="bpjs">BPJS</option>
                                            <option value="cash">Cash</option>
                                            <option value="deposit">Bayar Dengan Uang Deposit</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="debit">Debit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- End Metode Pembayaran --}}

                            {{-- Status Pembayaran --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Status Pembayaran</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <div class="form-control-wrap">
                                        <select class="form-control-lg form-control form-select select2"
                                            style="position:absolute;" name="status_pembayaran"
                                            data-placeholder="Pilih status pembayaran">
                                            <option label="Pilih data" disabled selected value=""></option>
                                            <option value="lunas">Lunas</option>
                                            <option value="piutang">Piutang ( BPJS )</option>
                                            <option value="belum lunas">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- End Status Pembayaran --}}

                            {{-- Dibayar --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Dibayar</p>
                                </div>
                                <div class="nk-tb-col tb-col-md w-35">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" autocomplete="off" onkeyup="bayar(this)" name="dibayar"
                                                class="form-control form-control-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Dibayar --}}

                            {{-- Sisa --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px">Kembalian</p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <h4 class="text-right pr-3 fs-18px ff-mono kembalian"></h4>
                                </div>
                            </div>
                            {{-- End Sisa --}}

                            {{-- Grand Total --}}
                            <div class="nk-tb-item">
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <p class="fs-15px"></p>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <h5 class="fs-15px">Grand Total</h5>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <h4 class="text-right pr-3 fs-18px ff-mono grand-total"></h4>
                                </div>
                            </div>
                            {{-- End Grand Total --}}
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <button onclick="simpanTransaksi(this.form)" class="btn btn-lg btn-success"><span
                                        class="text-simpan">Simpan</span>
                                    <span class="loading-simpan d-none ml-2 spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> <em
                                        class="ml-1 icon ni ni-check-round-cut"></em></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('admin.kasir.partials._modal_form')
@endsection

@push('js')
    <script>
        const urlKasir = $('#url-kasir').data('url');
        const modalTambahDeposit = '.modal-tambah-deposit';

        getGrandTotal()

        async function getGrandTotal() {
            await $.get(urlKasir)
                .done(response => {
                    let total = response.total,
                        deposit_awal = response.deposit_awal
                    $('.grand-total').text(total);
                    $('.deposit-awal').text(deposit_awal);
                })
        }

        function setTotal(url, attr) {
            event.preventDefault();
            let diskon = $('input[name=diskon]').val(),
                pajak = $('input[name=pajak]').val();
            $.post({
                    url: url,
                    data: {
                        _method: 'put',
                        diskon: diskon,
                        pajak: pajak,
                    }
                })
                .done(response => {
                    getGrandTotal();
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alertError();
                })
        }

        function simpanTransaksi(attr) {
            event.preventDefault()
            let url = $(attr).attr('action');
            $.post({
                    url: url,
                    data: $(attr).serialize(),
                    beforeSend: function() {
                        $(attr).find(".tombol-simpan").attr("disabled", true);
                        $(attr).find(".text-simpan").text("Menyimpan . . .");
                        $(attr).find(".loading-simpan").removeClass("d-none");
                    },
                    complete: function() {
                        $(attr).find(".loading-simpan").addClass("d-none");
                        $(attr).find(".text-simpan").text("Simpan");
                        $(attr).find(".tombol-simpan").attr("disabled", false);
                    },
                })
                .done(response => {
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 2000)
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();
                })
        }

        function addForm(url) {
            $(modalTambahDeposit).modal('show');
            $(`${modalTambahDeposit} form`).attr('action', url);
        }

        function simpanDeposit(attr) {
            event.preventDefault()
            let url = $(attr).attr('action');
            $.post({
                    url: url,
                    data: $(attr).serialize(),
                    beforeSend: function() {
                        $(attr).find(".tombol-simpan").attr("disabled", true);
                        $(attr).find(".text-simpan").text("Menyimpan . . .");
                        $(attr).find(".loading-simpan").removeClass("d-none");
                    },
                    complete: function() {
                        $(attr).find(".loading-simpan").addClass("d-none");
                        $(attr).find(".text-simpan").text("Simpan");
                        $(attr).find(".tombol-simpan").attr("disabled", false);
                    },
                })
                .done(response => {
                    $(modalTambahDeposit).modal('hide');
                    alertSuccess(response.message);
                    getGrandTotal();
                    $(`${modalTambahDeposit} input[name=deposit_awal]`).val('');
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);

                        return;
                    }
                    alertError();
                })
        }

        function bayar(attr) {
            let dibayar = parseInt($(attr).val());
            $.get(urlKasir)
                .done(response => {
                    let total = response.totalAngka,
                        kembalian = dibayar - total,
                        rupiahKembalian = rupiah(kembalian);
                    $('.kembalian').text(rupiahKembalian)
                })
                .fail(errors => {
                    alertError(errors.responseJSON.errors);
                })
        }

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            }).format(number);
        }
    </script>
@endpush
