<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>apotek</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">
</head>
    <style>
        .medich__contact {
            margin: 0 0 15px 20px;
        }
        
        .admin__note  {
            box-shadow: none!important;
            border: 0!important;
        }

        .description {
            cursor: default;
        }

        .firdaus-brands {
            text-align: center;
            align-items: center;
        }
        .dragula-container > *:not(:last-child) {margin-bottom: 0.75rem;}
    </style>
<body class="bg-grey" onload="printPromot()"> 
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="invoice-brand firdaus-brands">
                        <img src="/backend/images/logo-rs.jpeg">
                    </div>
                    <div class="invoice-contact medich__contact">
                        <div class="invoice-contact-info mt-3">
                            <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em>
                                    <span>House #65, 4328 Marion Street<br>Newbury, VT 05051</span></li>
                                <li><em class="icon ni ni-call-fill fs-14px"></em>
                                    <span>+012 8764 556</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">
                                                <em class="icon ni ni-user-circle"></em>
                                                <span>Personal</span>
                                            </a>
                                        </li>
                                    </ul><!-- .nav-tabs -->
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Informasi Pasien</h5>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nama Pasien</span>
                                                        <span class="profile-ud-value">{{ $query->nama_pasien }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Berat Badan</span>
                                                        <span class="profile-ud-value">Abu Bin Ishtiyak</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal Lahir</span>
                                                        <span class="profile-ud-value">{{ $query->tanggal_lahir }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal </span>
                                                        <span class="profile-ud-value">10 Aug, 1980</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Umur</span>
                                                        <span class="profile-ud-value">{{ usia($query->tanggal_lahir) }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nomor Rekam Medis</span>
                                                        <span class="profile-ud-value">{{ $query->no_rekam_medis }}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-block">
                                            <div class="nk-block-head nk-block-head-line">
                                                <h6 class="title overline-title text-base">Informasi Lainnya</h6>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nama Dokter</span>
                                                        <span class="profile-ud-value">{{ $query->nama_dokter }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tanggal Periksa</span>
                                                        <span class="profile-ud-value">{{ $query->tanggal_pemeriksaan }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tujuan Poli</span>
                                                        <span class="profile-ud-value">{{ $query->spesialis }}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-divider divider md"></div>
                                        < class="nk-block">
                                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                <h5 class="title">Catatan Tambahan</h5>
                                            </div><!-- .nk-block-head -->
                                           
                                                <table class="table table-tranx">
                                                    <thead>
                                                        <tr class="tb-tnx-head">
                                                            <th class="tb-tnx-id"><span class="">#</span></th>
                                                            <th class="tb-tnx-info">
                                                                <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                    <span>Bill For</span>
                                                                </span>
                                                                <span class="tb-tnx-date d-md-inline-block d-none">
                                                                    <span class="d-md-none">Date</span>
                                                                    <span class="d-none d-md-block">
                                                                        <span>Issue Date</span>
                                                                        <span>Due Date</span>
                                                                    </span>
                                                                </span>
                                                            </th>
                                                            <th class="tb-tnx-amount is-alt">
                                                                <span class="tb-tnx-total">Total</span>
                                                                <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                                            </th>
                                                            <th class="tb-tnx-action">
                                                                <span>&nbsp;</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
                                                    </tbody>
                                                </table>
                                            
                                            </div><!-- .bq-note -->
                                        </div><!-- .nk-block -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card-content -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>
</html>