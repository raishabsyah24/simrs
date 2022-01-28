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
                </ul>
            </div>
        </div>
    </div>
</div>
