<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('backend/images/logo.png') }}"
                    srcset="{{ asset('backend/images/logo2x.png 2x') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('backend/images/logo-dark.png') }}"
                    srcset="{{ asset('backend/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('backend/images/logo-small.png') }}"
                    srcset="{{ asset('backend/images/logo-small2x.png 2x') }}" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em
                    class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item {{ activeClass('dashboard.index') }}">
                        <a href="{{ route('dashboard.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>

                    @role('super_admin')
                    <!-- SUPER ADMIN -->
                    <!-- PENDAFTARAN -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-view-list-fill"></em>
                            </span>
                            <span class="nk-menu-text">Pendaftaran</span>
                        </a>
                        <ul class="nk-menu-sub ">
                            <li class="nk-menu-item {{ activeClass('pendaftaran.index') }}">
                                <a href="{{ route('pendaftaran.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Pasien Hari Ini</span></a>
                            </li>
                            <li class="nk-menu-item {{ activeClass('pendaftaran.create') }}">
                                <a href="{{ route('pendaftaran.create') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Tambah Pasien</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="https://vclaim.bpjs-kesehatan.go.id/vclaim" target="_blank"
                                    class="nk-menu-link"><span class="nk-menu-text">V Claim</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('pendaftaran.messanger')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Messages</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('pendaftaran.messanger')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Antrian</span></a>
                            </li>

                        </ul>
                    </li>
                    <!-- REKAM MEDIS -->
                    <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">Rekam Medis</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Rekam Medis</span></a>
                                    <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Retensi</span></a>
                                    <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi Data Lama</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                    <!-- DOKTER -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <i class="fas fa-user-md fa-lg"></i>
                            </span>
                            <span class="nk-menu-text">Dokter</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('dokter.daftar-pasien') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Daftar Pasien</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/auths/auth-success.html" class="nk-menu-link"
                                    target="_blank"><span class="nk-menu-text">Success /
                                        Confirm</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Classic
                                        Version - v2</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-login-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Login / Signin</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-register-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Register / Signup</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-reset-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Forgot Password</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-success-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Success / Confirm</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>                
                        <!-- RADIOLOGI -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan Radiologi</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('order.radiologi-otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Radiologi OTC</span></a>
                                    <a href="{{ route('order.radiologi-umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Radiologi Umum</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->  
                        <!-- LAB -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan LAB</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('lab.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab OTC</span></a>
                                    <a href="{{ route('lab.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab Umum</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->    
                    <!-- APOTEK -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                            <span class="nk-menu-text">Apotek</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/project-card.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Kategori Obat</span></a>
                                <a href="{{ route('data') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Data Obat</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Orders</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('order.create-obat') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Obat - Default</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-regular.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Order List - Regular</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-sales.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Order List - Sales</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-filter-alt"></em></span>
                                <span class="nk-menu-text">Apotek</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.antrian.bpjs') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Bpjs</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <!-- KASIR -->
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
                                <span class="nk-menu-text">KASIR</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.bpjs') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran BPJS</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran Umum/Asuransi</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran OTC</span></a>
                                </li>
                            </ul>
                        </li>
                        </li>

                        <li class="nk-menu-item {{ activeClass('aktifitas-user.index') }}">
                            <a href="{{ route('aktifitas-user.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-history"></em>
                                </span>
                                <span class="nk-menu-text">History User</span>
                            </a>
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text">Managemen User</span>
                            </a>
                            <ul class="nk-menu-sub ">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.user') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pengguna</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.medis') }}" class="nk-menu-link"><span class="nk-menu-text">Daftar Tenaga Medis</span></a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                    <!-- BATAS SUPER ADMIN -->

                    <!-- DOKTER -->
                    @role('dokter')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <i class="fas fa-user-md fa-lg"></i>
                            </span>
                            <span class="nk-menu-text">Dokter</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('dokter.daftar-pasien') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Daftar Pasien</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/auths/auth-success.html" class="nk-menu-link"
                                    target="_blank"><span class="nk-menu-text">Success /
                                        Confirm</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Classic
                                        Version - v2</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-login-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Login / Signin</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-register-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Register /
                                                Signup</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-reset-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Forgot Password</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-success-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Success /
                                                Confirm</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>                
                    @endrole

                    @role('rekam_medis')
                        <li class="nk-menu-item has-sub">
                            <a class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Rekam Medis</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Rekam Medis</span></a>
                                    <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Retensi</span></a>
                                            <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi Data Lama</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item {{ activeClass('aktifitas-user.index') }}">
                            <a href="{{ route('aktifitas-user.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-history"></em>
                                </span>
                                <span class="nk-menu-text">History User</span>
                            </a>
                        </li>
                    @endrole             
                    
                    @role('radiologi')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan Radiologi</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('order.radiologi-otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Radiologi OTC</span></a>
                                    <a href="{{ route('order.radiologi-umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Radiologi Umum</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->  
                        <!-- LAB -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan LAB</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('lab.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab OTC</span></a>
                                    <a href="{{ route('lab.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab Umum</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->   
                        @endrole

                     <!-- APOTEK -->
                        @role('apotek')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-share-fill"></em></span>
                                <span class="nk-menu-text">Master</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Data Obat</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                <span class="nk-menu-text">Orders</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('order.create-obat') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Stok Obat - Default</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                <span class="nk-menu-text">Apotek</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.antrian.bpjs') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Bpjs</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Umum</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-sales.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Asuransi</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                         @endrole
                    
                    @role('lab')
                    <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan LAB</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('lab.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab OTC</span></a>
                                    <a href="{{ route('lab.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab Umum</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-menu-item">
                            <!-- KASIR -->
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
                                <span class="nk-menu-text">KASIR</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.bpjs') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran BPJS</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran Umum/Asuransi</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('kasir.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pembayaran OTC</span></a>
                                </li>
                            </ul>
                        </li>
                        </li>

                     </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->    
                        <li class="nk-menu-item {{ activeClass('aktifitas-user.index') }}">
                            <a href="{{ route('aktifitas-user.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-history"></em>
                                </span>
                                <span class="nk-menu-text">History User</span>
                            </a>
                        </li>
                    @endrole
                    
                    @role('pendaftaran')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-view-list-fill"></em>
                                </span>
                                <span class="nk-menu-text">Pendaftaran</span>
                            </a>
                            <ul class="nk-menu-sub ">
                                <li class="nk-menu-item {{ activeClass('pendaftaran.index') }}">
                                    <a href="{{ route('pendaftaran.index') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pasien Hari Ini</span></a>
                                </li>
                                <li class="nk-menu-item {{ activeClass('pendaftaran.create') }}">
                                    <a href="{{ route('pendaftaran.create') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Tambah Pasien</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="https://vclaim.bpjs-kesehatan.go.id/vclaim" target="_blank"
                                        class="nk-menu-link"><span class="nk-menu-text">V Claim</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#" target="_blank" class="nk-menu-link"><span
                                            class="nk-menu-text">Antrian</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('pendaftaran.messanger') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Messages</span></a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                </ul>
            </div>
        </div>
    </div>
</div>