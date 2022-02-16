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
                                    <a class="back-to" href="{{ route('kasir.index') }}"><em
                                            class="icon ni ni-arrow-left"></em><span>Kembali</span></a>
                                </div>
                                <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
{{--                    Identitas Pasien--}}
                    <div id="identitas-pasien" class="accordion border border-right-0 border-top-0 rounded-top border-primary">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    End Identitas Pasien--}}
                    <div class="nk-tb-list is-separate my-3">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text"><h5>No</h5></span></div>
                            <div class="nk-tb-col"><span class="sub-text"><h5>Tanggal Layanan</h5></span></div>
                            <div class="nk-tb-col"><span class="sub-text"><h5>Layanan</h5></span></div>
                            <div class="nk-tb-col"><span class="sub-text"><h5 class="text-center">Tarif</h5></span></div>
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
                                    <p class="text-right pr-3 fs-18px ff-mono">{{ formatAngka($item->subtotal, true) }}</p>
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
{{--                        Diskon--}}
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">%</span>
                                        </div>
                                        <input name="diskon" type="number" class="form-control form-control-lg">
                                    <button onclick="setDiskon(`{{ route('kasir.update-tagihan', $kasir->id) }}`, this)" data-toggle="tooltip" data-placement="top" title="Simpan Diskon" class="ml-2 btn-sm btn btn-success"><em class="icon ni ni-check-thick"></em>
                                    </button>
                                    </div>

                                </div>
                            </div>
                        </div>
{{--                        End Diskon--}}

{{--                        Pajak--}}
{{--                        <div class="nk-tb-item">--}}
{{--                            <div class="nk-tb-col tb-col-md">--}}
{{--                                <span></span>--}}
{{--                            </div>--}}
{{--                            <div class="nk-tb-col tb-col-md">--}}
{{--                                <span></span>--}}
{{--                            </div>--}}
{{--                            <div class="nk-tb-col tb-col-md">--}}
{{--                                <p class="fs-15px">Pajak</p>--}}
{{--                            </div>--}}
{{--                            <div class="nk-tb-col tb-col-md">--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <span class="input-group-text" id="basic-addon1">%</span>--}}
{{--                                        </div>--}}
{{--                                        <input type="number" onkeyup="setTotal(`{{ route('kasir.updateTagihan', $kasir->id) }}`)" name="pajak" class="form-control form-control-lg">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        End Pajak--}}

{{--                        Grand Total--}}
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
{{--                        End Grand Total--}}
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <button onclick="submitForm(`{{ route('kasir.update-status', $kasir->id) }}`, `{{ $identitas_pasien->kategori_pasien_id }}`)" class="btn btn-lg btn-success">Simpan <em class="ml-1 icon ni ni-check-round-cut"></em></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const urlKasir = $('#url-kasir').data('url');

        getGrandTotal()

        async function getGrandTotal(){
            await $.get(urlKasir)
                .done(response => {
                    let total = response.total;
                    $('.grand-total').text(total);
                })
        }

        function setDiskon(url, attr){
            event.preventDefault();
            let diskon =$('input[name=diskon]').val();
            $.post({
                url: url,
                data : {
                    _method : 'put',
                    diskon : diskon
                }
            })
            .done(response => {
                getGrandTotal();
                $(attr).addClass('d-none')
                $('input[name=diskon]').attr('disabled', true);
                alertSuccess(response.message);
            })
            .fail(errors => {
                if (errors.status === 422) {
                    loopErrors(errors.responseJSON.errors);
                    return;
                }
                alertError();
            })
        }

        function submitForm(url, kategori_pasien){
            event.preventDefault();
            $.post({
                url : url,
                data : {
                    _method : 'put',
                    kategori_pasien : kategori_pasien
                }
            })
                .done(response => {
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 2000);
                })
                .fail(errors => {
                    alertError();
                })
        }
    </script>
@endpush
