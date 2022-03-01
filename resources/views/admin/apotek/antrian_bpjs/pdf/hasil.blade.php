@extends('layouts.print.master')

@push('css')
    <style>
   @media print {
        body {
            /* width view print */
            width: 20cm;
            height: 29.7cm;
            margin: 10mm 20mm 0 10mm; 
            border:1px solid #000;
            /* change the margins as you want them to be. */
    }
    /* table,th:nth-child(even),td:nth-child(even) {
        background-color: #D6EEEE;
    } */

    .pos_fixed1{
        font-size: 5pt;
    }
    
    .pos_fixed2{
        font-size: 5pt;
    }

    .profile-ud-item, .information__sub {
        margin-left: 1.25mm;
        width: auto;
        min-width: 97.8%;
    }
}
    .card__section {
        padding: 0 1.1rem 1.25rem 1.1rem;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }

    .pos_fixed1 {
        font-size: 10pt;
    }
    .pos_fixed2 {
        font-size: 9pt;
    }

    th:nth-child(even),td:nth-child(even) {
        background-color: #D6EEEE;
    }

    .profile-ud-item, .information__sub {
        width: 30vw;
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
                {{-- begin card section--}}
                <div class="card__section">
                <div class="nk-block">
                    <div class="nk-block-head">
                        <ul class="list-plan">
                            <li>
                                <em class="icon ni ni-map-pin-fill"></em>
                                <span>Komplek Bea Cukai Jalan Siak J5</span>
                                <div class="description" style="margin-left: 23px;">
                                    <p>No.14,RT.10/RW.7, Sukapura, Kec. <br>
                                        Cilincing, Kota Jkt Utara, <br>
                                        Daerah Khusus Ibukota Jakarta 14140
                                    </p>
                                </div>
                                <em class="icon ni ni-call-fill"></em>
                                <span>(021) 4407322</span>
                            </li>
                        </ul>
                    </div><!-- .nk-block-head -->
                </div>
                {{-- end nk-block --}}
                    <div class="row mt-4">
                        {{-- begin col-8 --}}
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="title">Informasi Pasien</h5>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item information__sub">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nama Pasien</span>
                                                <span>:</span>
                                                <span class="profile-ud-value">{!! $query->nama_pasien !!}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item information__sub">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Tanggal Lahir</span>
                                                <span>:</span>
                                                <span class="profile-ud-value">
                                                    {!! tanggalLahirUsia($query->tanggal_lahir) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="title">Informasi Lainnya</h5>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item information__sub">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Nama Dokter</span>
                                                <span>:</span>
                                                <span class="profile-ud-value">{!! $query->nama_dokter !!}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item information__sub">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Tujuan Poli</span>
                                                <span>:</span>
                                                <span class="profile-ud-value">{!! $query->spesialis !!}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item information__sub">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">No. Rekam Medis</span>
                                                <span>:</span>
                                                <span class="profile-ud-value">{!! kodeRekamMedis($query->no_rekam_medis) !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- begin table obat --}}
                            <div class="row" style="margin-top: 1.25rem;">
                                <div class="col-12">
                                    <h5 class="title">Catatan Tambahan</h5>
                                     <table class="table-bordered pos_fixed1" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Signa</th>
                                                <th>Harga Obat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($drug as $item)
                                            <tr>
                                                <td>{!! $loop->iteration !!}</td>
                                                <td>{!! $item->nama_generik !!}</td>
                                                <td>{!! $item->jumlah !!}</td>
                                                <td></td>
                                                <td>Rp. {!! formatAngka($item->harga_obat) !!}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <h3>Belum ada data</h3>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- end table obat --}}
                            <div class="row">
                                <div class="col-12">
                                    <table class="table-bordered" style="width:100%">
                                        <tr>
                                          <th colspan="2">
                                              <h6 class="title text-center" style="margin: 5px 0 5px;">Perubahan Resep</h6>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>
                                            <p class="fs-5">Tertulis</p>
                                          </th>
                                          <th>
                                            <p class="fs-5">Menjadi</p>
                                          </th>
                                          <th>
                                            <p class="fs-5">Petugas Farmasi</p>
                                          </th>
                                          <th>
                                            <p class="fs-5">Disetujui</p>
                                          </th>
                                        </tr>
                                        <tr style="height: 80px;">
                                          <td></td>
                                          <td></td>
                                          <td>
                                              <p class="fs-5 text-center">{!! auth()->user()->name !!}</p>
                                          </td>
                                          <td></td>
                                        </tr>
                                      </table>
                               </div>
                            </div>
                        </div>
                        {{-- end col-8 --}}
                        <div class="col-4">
                            <h5 class="title">Table Kanan</h5>
                             <table class="table-bordered pos_fixed2" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengkajian Resep</th>
                                        <th>Ya</th>
                                        <th>Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tulisan dokter jelas</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Identitas pasien benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Obat,benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Dosis,benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Cara pemberian obat benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Waktu dan frekuensi pemberian obat benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Waktu dan frekuensi pemberian obat benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Poli farmasi, ada</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Duplikasi terapi, ada</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>ESO yang mungkin terjadi, ada</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Interaksi obat, ada</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text">H. (Harga)</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text">T. (Teknik)</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text">K. (Kemas)</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text">P. (Penyerahan)</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <textarea class="form-control"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end card section --}}
            </div>
        </div>
        
@endsection

@push('js')
    <script>
          function printPromot() {
            window.print();
        }
        window.onfocus = function() {
            window.close();
        }
    </script>
@endpush
