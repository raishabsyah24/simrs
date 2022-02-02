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
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    @role('pendaftaran|super_admin')
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
                            </ul>
                        </li>
                    @endrole

                    <!-- DOKTER -->
                    @role('dokter|super_admin')
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
                            </ul>
                        </li>
                    @endrole

                    @role('radiologi|super_admin')
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
                                            class="nk-menu-text">Pemeriksaan Radiologi RS</span></a>
                                </li>
                            </ul>
                        </li>
                    @endrole

                    <!-- KASIR -->
                    @role('kasir|super_admin')
                        <li class="nk-menu-item">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-sign-mxn"></em></span>
                                <span class="nk-menu-text">Kasir</span>
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
                    @endrole

                    <!-- APOTEK -->
                    @role('apotek|super_admin')
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
                        </li>
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
                            </ul><!-- .nk-menu-sub -->
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-filter-alt"></em></span>
                                <span class="nk-menu-text">Daftar Antrian</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.antrian') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pasien Bpjs</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-regular.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Pasien Umum</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-sales.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Pasien Asuransi</span></a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                    @role('lab|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-view-list-fill"></em>
                                </span>
                                <span class="nk-menu-text">Pemeriksaan Lab</span>
                            </a>
                            <ul class="nk-menu-sub ">
                                <li class="nk-menu-item {{ activeClass('lab.otc') }}">
                                    <a href="{{ route('lab.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab OTC</span></a>
                                </li>
                                <li class="nk-menu-item {{ activeClass('lab.umum') }}">
                                    <a href="{{ route('lab.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab RS</span></a>
                                </li>
                            </ul>
                        </li>

                    @endrole

                    @role('super_admin')
                        <li class="nk-menu-item {{ activeClass('aktifitas-user.index') }}">
                            <a href="{{ route('aktifitas-user.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-history"></em>
                                </span>
                                <span class="nk-menu-text">History User</span>
                            </a>
                        </li>
                    @endrole
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Managemen User</span>
                        </a>
                        <ul class="nk-menu-sub ">
                            <li class="nk-menu-item">
                                <a href="{{ route('user.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Semua User</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('data.medis') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Daftar Tenaga Medis</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
