@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">
                                    {!! $title !!}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="loader card-inner p-0">
                        <div class="d-flex justify-content-center my-5">
                            <div class="spinner-grow text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block fetch-data d-none">
                        <div class="nk-tb-list is-separate mb-3">
                            <table class="table-tranx d-none">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col tb-col-md"><h5>No</h5></th>
                                        <th class="nk-tb-col tb-col-md"><h5>Nomor Antrian</h5></th>
                                        <th class="nk-tb-col tb-col-md"><h5>Pasien</h5></th>
                                        <th class="nk-tb-col tb-col-md"><h5>Dokter</h5></th>
                                        <th class="nk-tb-col tb-col-md"><h5>Waktu Daftar</h5></th>
                                    </tr>
                                </thead>
                                <tbody id="table-antrian"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const url = `{{ route('dashboard.antrian-poli.jantung.data') }}`;

        $(document).ready(function () {
            $(".fetch-data").removeClass("d-none");
            $(".loader").addClass("d-none");
        });

        reloadTable();

        function reloadTable() {
            setTimeout(() => {
                $.get(url)
                    .done(response => {
                        let output = response.output;
                        $('.table-tranx').removeClass('d-none')
                        $('#table-antrian').html(output)
                    })
                    .fail(error => {
                        alertError();
                    })
            }, 1000);
            setInterval(() => {
                $.get(url)
                    .done(response => {
                        let output = response.output;
                        $('#table-antrian').html(output)
                    })
                    .fail(error => {
                        alertError();
                    })
            }, 30000);
        }
    </script>
@endpush
