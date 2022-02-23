@extends('layouts.print.master')

@push('css')
    <style>
   @media print {
        body {
            /* width view print */
            width: 30cm;
            height: 29.7cm;
            margin: 10mm 20mm; 
            /* change the margins as you want them to be. */
    }
        table.pos_fixed1 {
            width: 100mm;
            float: left;
            top: 30px;
            /* margin-left: 120px; */
        } 
        table.pos_fixed2 {
            width: 100mm;
            float: right;
            margin-top: -5rem;
        }
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
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <h5 class="title">Personal Information</h5>
                            <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                        </div><!-- .nk-block-head -->
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Title</span>
                                    <span class="profile-ud-value">Mr.</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Full Name</span>
                                    <span class="profile-ud-value">Abu Bin Ishtiyak</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date of Birth</span>
                                    <span class="profile-ud-value">10 Aug, 1980</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Surname</span>
                                    <span class="profile-ud-value">IO</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Mobile Number</span>
                                    <span class="profile-ud-value">01713040400</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Email Address</span>
                                    <span class="profile-ud-value">info@softnio.com</span>
                                </div>
                            </div>
                        </div><!-- .profile-ud-list -->
                    </div><!-- .nk-block -->  
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <table class="table table-striped pos_fixed1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Harga Obat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lorem, ipsum.</td>
                                        <td>Lorem, ipsum.</td>
                                        <td>Lorem, ipsum.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6">
                            <table class="table table-secondary pos_fixed2">
                                <thead>
                                    <tr class="table-light">
                                        <th>No</th>
                                        <th>Pengkajian Resep</th>
                                        <th>Ya</th>
                                        <th>Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>Tulisan dokter jelas</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class="table-light">
                                        <td>2</td>
                                        <td>Identitas Pasien Benar</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
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
          function printPromot() {
            window.print();
        }
        window.onfocus = function() {
            window.close();
        }
    </script>
@endpush
