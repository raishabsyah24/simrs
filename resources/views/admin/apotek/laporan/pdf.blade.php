@extends('layouts.print.master')
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
                <div class="invoice-head">
                    <div class="invoice-contact">
                        {{-- <span class="overline-title">Invoice To</span> --}}
                        <div class="invoice-contact-info">
                            {{-- <h4 class="title">Gregory Anderson</h4> --}}
                            <ul class="list-plain">
                                <li><em class="icon ni ni-user-check"></em>
                                    <span>Dibuat</span>
                                    <span style="padding:0 0 0 60px;">:</span>
                                    <span> {!! auth()->user()->name !!} </span>
                                </li>
                                <li><em class="icon ni ni-calendar-fill"></em>
                                    <span>Tanggal</span>
                                    <span style="padding: 0 0 0 55px;">:</span>
                                    <span>{!! tanggalJam(now()) !!}</span>
                                </li>
                                <li><em class="icon ni ni-calendar-fill"></em>
                                    <span>Laporan Tanggal</span>
                                    <span>:</span>
                                    <span>{!! tanggal($res['dari']) !!} - {!! tanggal($res['sampai']) !!}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="invoice-bills">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>RM Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Kategori</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($data['data'] as $item)
                          <tr>
                            <td>{!! $loop->iteration !!}</td>
                            <td>{!! $item->no_rekam_medis !!}</td>
                            <td>{!! $item->nama_pasien !!}</td>
                            <td>{!! $item->kategori_pasien !!}</td>
                          </tr>
                          @empty
                          <tr>
                              <td></td>
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
                        </tbody>
                      </table>
                </div>
        
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-ulogs">
                           <thead class="thead-light">
                               <tr>
                                   <th>No</th>
                                   <th>Nama Obat</th>
                                   <th>Jumlah</th>
                                   <th>Harga</th>
                                   <th>Subtotal</th>
                               </tr>
                           </thead>
                           <tfoot>
                               <tr>
                                   <td colspan="3"></td>
                                   <td><h5>Total</h5></td>
                                   <td colspan="2">Lorem ipsum dolor sit.</td>
                               </tr>
                           </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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