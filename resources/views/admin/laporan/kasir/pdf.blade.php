@extends('layouts.print.master', ['title' => $title])
@push('css')
    <style>
        @page {
            size: 25cm 35.7cm;
            margin: 5mm 5mm 5mm 5mm;
            /* change the margins as you want them to be. */
        }

    </style>
@endpush
@section('print-content')
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('backend/images/logo-rs.jpeg') }}">
                </div>
                <h3 class="title">LAPORAN KASIR</h3>
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td>Dibuat</td>
                                <td>:</td>
                                <td>{!! auth()->user()->name !!}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{!! tanggalJam(now()) !!}</td>
                            </tr>
                            <tr>
                                <td>Laporan Tanggal</td>
                                <td>:</td>
                                <td>{!! tanggal($attr['dari']) !!} - {!! tanggal($attr['sampai']) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="invoice-bills mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pasien</th>
                                    <th>Kategori</th>
                                    <th>Kasir</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Tagihan</th>
                                    <th>Diskon %</th>
                                    <th>Pajak %</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['data'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{!! $item->nama_pasien !!}</td>
                                        <td>{!! $item->kategori_pasien !!}</td>
                                        <td>{!! $item->admin !!}</td>
                                        <td>{!! $item->metode_pembayaran !!}</td>
                                        <td>{!! tanggalJam($item->tanggal_pembayaran) !!}</td>
                                        <td>{!! formatAngka($item->total_tagihan, true) !!} %</td>
                                        <td>{!! $item->diskon !!} %</td>
                                        <td>{!! $item->pajak !!} %</td>
                                        <td>{!! formatAngka(totalTagihan($item->kasir_id), true) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h3>Belum Ada Data</h3>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="8" class="text-right">
                                        <h5>Grand Total</h5>
                                    </td>
                                    <td colspan="2">
                                        <h5>{!! formatAngka($data['grand_total'], true) !!}</h5>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="10" class="text-right text-capitalize">
                                        <h5>{!! terbilangRupiah($data['grand_total']) !!}</h5>
                                    </td>
                                </tr>
                            </tbody>
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
            var css = '@page { size: landscape; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet) {
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);

            window.print();
        }
        // window.onfocus=function(){ window.close();}
    </script>
@endpush
