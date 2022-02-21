@extends('layouts.print.master', ['title' => $title])

@push('css')
@endpush

@section('print-content')
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('backend/images/logo-rs.jpeg') }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4 class="title">{!! $identitas_pasien->nama_pasien !!}</h4>
                        <table>
                            <tr>
                                <td>Nomor Handphone</td>
                                <td>:</td>
                                <td>{!! $identitas_pasien->no_hp !!}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{!! $identitas_pasien->alamat !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 mt-4">
                        <table>
                            <tr>
                                <td>Nomor Pembayaran</td>
                                <td>:</td>
                                <td>{!! $identitas_pasien->kode !!}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>{!! $identitas_pasien->tanggal_pembayaran ? tanggalJam($identitas_pasien->tanggal_pembayaran) : '' !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="invoice-bills mt-5">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Layanan</th>
                                    <th>Tanggal Layanan</th>
                                    <th>Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanan as $item)
                                    <tr>
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>
                                            {!! $item->jenis_tagihan !!}
                                            @if ($item->jenis_tagihan == 'Obat-obatan')
                                                @foreach ($obat_pasien_rajal as $obat)
                                                    <p>* {{ $obat->nama_generik }}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{!! tanggalJam($item->tanggal_layanan) !!}</td>
                                        <td>{!! formatAngka($item->subtotal, true) !!}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">Subtotal</td>
                                    <td>{!! formatAngka($layanan->sum('subtotal'), true) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">Diskon</td>
                                    <td>{!! $kasir->diskon !!} %</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">Pajak</td>
                                    <td>{!! $kasir->pajak !!} %</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">Grand Total</td>
                                    <td>{!! formatAngka($total, true) !!}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function printPromot() {
            window.print();
        }
        // window.print();
        window.onfocus = function() {
            window.close();
        }
    </script>
@endpush
