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
                    {{-- Dashboard pasien --}}
                    <li class="nk-menu-item {{ activeClass('dashboard.index') }}}">
                        <a href="{{ route('dashboard.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-dashboard-fill"></em>
                            </span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    @role('pendaftaran|super_admin')
                    <li class="nk-menu-item has-sub {{ activeClass('pendaftaran.rawat-jalan.index') }}">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <i class="fas fa-clinic-medical fa-lg"></i>
                            </span>
                            <span class="nk-menu-text">Pendaftaran</span>
                        </a>
                        <ul class="nk-menu-sub  {{ activeClass('pendaftaran.rawat-jalan.index') }}">
                            <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-jalan.index') }}">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Rawat
                                        Jalan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-jalan.index') }}"><a
                                            href="{{ route('pendaftaran.rawat-jalan.index') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">Pasien Hari
                                                Ini</span></a></li>
                                    <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-jalan.create') }}"><a
                                            href="{{ route('pendaftaran.rawat-jalan.create') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">Tambah Pasien</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-inap.index') }}">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Rawat
                                        inap</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-inap.index') }}"><a
                                            href="{{ route('pendaftaran.rawat-inap.index') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">Pasien Hari
                                                Ini</span></a></li>
                                    <li class="nk-menu-item {{ activeClass('pendaftaran.rawat-inap.create') }}"><a
                                            href="{{ route('pendaftaran.rawat-inap.create') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">Tambah Pasien</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item">
                                <a href="https://vclaim.bpjs-kesehatan.go.id/vclaim" target="_blank"
                                    class="nk-menu-link"><span class="nk-menu-text">V Claim</span></a>
                            </li>
                        </ul>
                    </li>
                    @endrole
                    <!-- DOKTER -->
                    @role('dokter')
                    <li
                        class="nk-menu-item {{ activeClass('dokter-spesialis.periksa-pasien') }} {{ activeClass('dokter.daftar-pasien') }}">
                        <a href="{{ route('dokter.daftar-pasien') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-list-index"></em>
                            </span>
                            <span class="nk-menu-text">Pasien Rawat Jalan</span>
                        </a>
                    </li>
                    @endrole
 
                    <!-- Poli Station -->
                    @role('poli_station|super_admin')
                    <li class="nk-menu-item {{ activeClass('poli-station.index') }}">
                        <a href="{{ route('poli-station.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <i class="fas fa-first-aid fa-lg"></i>
                            </span>
                            <span class="nk-menu-text">Poli Station</span>
                        </a>
                    </li>
                    @endrole
 
                    <!-- KASIR -->
                    @role('kasir|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-sign-idr"></em>
                            </span>
                            <span class="nk-menu-text">Kasir</span>
                        </a>
                        <ul class="nk-menu-sub ">
                            <li class="nk-menu-item {{ activeClass('kasir.index') }}">
                                <a href="{{ route('kasir.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Transaksi</span></a>
                            </li>
                            <li class="nk-menu-item {{ activeClass('kasir.laporan') }}">
                                <a href="{{ route('kasir.laporan') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Laporan Transaksi Kasir</span></a>
                            </li>
                        </ul>
                    </li>
                    @endrole
 
                    <!-- APOTEK -->
                    @role('apotek|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                            <span class="nk-menu-text">Apotek</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">List Pasien Apotek</span>
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
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('apotek.laporan') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Laporan Riwayat Obat Pasien</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-share-fill"></em></span>
                            <span class="nk-menu-text">Database</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('data') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Data Obat</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Rich Editor</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="html/components/forms/form-summernote.html" class="nk-menu-link">
                                            <span class="nk-menu-text">Summernote</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/components/forms/form-quill.html" class="nk-menu-link">
                                            <span class="nk-menu-text">Quill</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/components/forms/form-tinymce.html" class="nk-menu-link">
                                            <span class="nk-menu-text">Tinymce</span></a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                            <span class="nk-menu-text">Stok Apotek</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('order.create-obat') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Stok Obat - Default</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
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
                    @role('super_admin|admin')
                    <li
                        class="nk-menu-item has-sub {{ activeClass('dashboard.antrian-poli.jantung') }} {{ activeClass('dashboard.antrian-poli.anak') }}">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-view-list-fill"></em>
                            </span>
                            <span class="nk-menu-text">Antrian Poli</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item {{ activeClass('dashboard.antrian-poli.jantung') }}">
                                <a href="{{ route('dashboard.antrian-poli.jantung') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Antrian Poli Jantung</span>
                                </a>
                            </li>
                            <li class="nk-menu-item {{ activeClass('dashboard.antrian-poli.anak') }}">
                                <a href="{{ route('dashboard.antrian-poli.anak') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Antrian Poli Anak</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item {{ activeClass('layanan.index') }}">
                        <a href="{{ route('layanan.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-users-fill"></em>
                            </span>
                            <span class="nk-menu-text">Layanan</span>
                        </a>
                    </li>
                    <li class="nk-menu-item {{ activeClass('dokter.index') }}">
                        <a href="{{ route('dokter.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <i class="fas fa-user-md fa-lg"></i>
                            </span>
                            <span class="nk-menu-text">Dokter</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('nurse-station.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-cc-secure-fill"></em>
                            </span>
                            <span class="nk-menu-text">Nurse Station</span>
                        </a>
                    </li>
                    <li class="nk-menu-item {{ activeClass('user.index') }}">
                        <a href="{{ route('user.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-users-fill"></em>
                            </span>
                            <span class="nk-menu-text">User</span>
                        </a>
                    </li>
                    <li class="nk-menu-item {{ activeClass('aktifitas-user.index') }}">
                        <a href="{{ route('aktifitas-user.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-history"></em>
                            </span>
                            <span class="nk-menu-text">History User</span>
                        </a>
                    </li>
                    @endrole
 
                    @role('igd|super_admin')
                    <!-- IGD -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">IGD</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Migrasi Data Lama</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    @role('dahlia|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">DAHLIA</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                    <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                    <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok
                                        Penyimpanan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_dahlia')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_obat-dahlia')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_atk-dahlia')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">CSSD</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    <!-- MELATI -->
                    @role('melati|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">MELATI</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                    <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                    <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}"
                                            class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok
                                        Penyimpanan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_melati')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_obat_melati')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="{{route('ns.permintaan_atk_melati')}}"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">CSSD</span></a></li>
 
                                </ul><!-- .nk-menu-sub -->
                            </li>
 
 
 
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
 
                    <!-- KENANGA -->
                    @role('kenanga|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">KENANGA</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 201</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 202</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 203</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok
                                        Penyimpanan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">ATK</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">CSSD</span></a></li>
 
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    <!-- TULIP -->
                    @role('tulip|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">TULIP</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 201</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 202</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 203</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok
                                        Penyimpanan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">ATK</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">CSSD</span></a></li>
 
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
                    <!-- EDELWEIS -->
                    @role('edelewies|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">EDELWEIS</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Pasien</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 201</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 202</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">KAMAR 203</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok
                                        Penyimpanan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">BHP</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">OBAT</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">ATK</span></a></li>
                                    <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">CSSD</span></a></li>
 
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    <!-- OK -->
                    @role('ok|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">OK</span>
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
                    @endrole
 
                    <!-- VK -->
                    @role('vk|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">VK</span>
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
                    @endrole
 
                    <!-- HCU/ICU -->
                    @role('icu|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">HCU/ICU</span>
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
                    @endrole
 
                    <!-- HD -->
                    @role('hd|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">HD</span>
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
                    @endrole
 
                    <!-- DAPUR -->
                    @role('dapur|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">DAPUR</span>
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
                    @endrole
 
                    <!-- LAUNDRY -->
                    @role('laundry|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">LAUNDRY</span>
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
                    @endrole
 
                    <!-- CSSD -->
                    @role('CSSD|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">CSSD</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Daftar Permintaan</span></a>
                                <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Retensi</span></a>
                                <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Migrasi Data Lama</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    <!-- Gudang Farmasi -->
                    @role('gudangfarmasi|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">Gudang Farmasi</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('gudang.po')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">PO</span></a>
                                <a href="{{route('gudang.penyimpanan')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Penyimpanan</span></a>
                                <a href="{{route('gudang.permintaan-farmasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Migrasi</span></a>
                                <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Stock Of Opname (SO)</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
 
                    <!-- Gudang Atk -->
                    @role('gudangatk|super_admin')
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                            <span class="nk-menu-text">Gudang ATK</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('gudang.penyimpanan')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Penyimpanan</span></a>
                                <a href="{{route('gudang.permintaan_atk')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Permintaan</span></a>
                                <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Migrasi</span></a>
                                <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Stock Of Opname (SO)</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endrole
                        
                        @role('igd|super_admin')
                        <!-- IGD -->
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
                                            target="_blank"><span class="nk-menu-text">Register / Signup</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-reset-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Forgot Password</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/pages/auths/auth-success-v2.html" class="nk-menu-link"
                                            target="_blank"><span class="nk-menu-text">Success /
                                                Confirm</span></a>
                                            target="_blank"><span class="nk-menu-text">Success / Confirm</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                    <span class="nk-menu-text">Managemen User</span>
                                </a>
                                <ul class="nk-menu-sub ">
                                    <li class="nk-menu-item">
                                        <a href="#" class="nk-menu-link"><span
                                                class="nk-menu-text">Pengguna</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>                
                    @endrole    

                    @role('rekam_medis')
                        <!-- RADIOLOGI -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">IGD</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pasien</span></a>
                                    <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Permintaan</span></a>
                                    <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi Data Lama</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        @role('dahlia|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">DAHLIA</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                            <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Pasien</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                                <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                                <li class="nk-menu-item"><a href="{{ route('dahlia.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok Penyimpanan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-quill.html" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Permintaan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_dahlia')}}" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_obat-dahlia')}}" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_atk-dahlia')}}" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">CSSD</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>          
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        <!-- MELATI -->
                        @role('melati|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">MELATI</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                            <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Pasien</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                                <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                                <li class="nk-menu-item"><a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok Penyimpanan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-quill.html" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Permintaan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_melati')}}" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_obat_melati')}}" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="{{route('ns.permintaan_atk_melati')}}" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">CSSD</span></a></li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                       
                                       
                                        
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole
                        
                        
                        <!-- KENANGA -->
                        @role('kenanga|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">KENANGA</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                            <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Pasien</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok Penyimpanan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-quill.html" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Permintaan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">CSSD</span></a></li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        <!-- TULIP -->
                        @role('tulip|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">TULIP</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                            <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Pasien</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok Penyimpanan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-quill.html" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Permintaan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">CSSD</span></a></li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole
                        <!-- EDELWEIS -->
                        @role('edelewies|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">EDELWEIS</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                            <a href="{{ route('melati.daftar-pasien') }}" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Pasien</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 201</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 202</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">KAMAR 203</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Stok Penyimpanan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-quill.html" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Permintaan</span></a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">BHP</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">OBAT</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">ATK</span></a></li>
                                                <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">CSSD</span></a></li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        <!-- OK -->
                        @role('ok|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">OK</span>
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
                        @endrole

                        <!-- VK -->
                        @role('vk|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">VK</span>
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
                        @endrole

                        <!-- HCU/ICU -->
                        @role('icu|super_admin')
                    <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">HCU/ICU</span>
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
                        @endrole

                        <!-- HD -->
                        @role('hd|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">HD</span>
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
                        @endrole
                        
                        <!-- DAPUR -->
                        @role('dapur|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">DAPUR</span>
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
                        @endrole

                        <!-- LAUNDRY -->
                        @role('laundry|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">LAUNDRY</span>
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
                        @endrole

                        <!-- CSSD -->
                        @role('CSSD|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">CSSD</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('rm.rekammedis')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Daftar Permintaan</span></a>
                                    <a href="{{route('rm.retensi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Retensi</span></a>
                                    <a href="{{route('rm.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi Data Lama</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        <!-- Gudang Farmasi -->
                        @role('gudangfarmasi|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">Gudang Farmasi</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('gudang.po')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">PO</span></a>
                                    <a href="{{route('gudang.penyimpanan')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Penyimpanan</span></a>
                                    <a href="{{route('gudang.permintaan-farmasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Permintaan</span></a>
                                    <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi</span></a>
                                    <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                                class="nk-menu-text">Stock Of Opname (SO)</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                        @endrole

                        <!-- Gudang Atk -->
                        @role('gudangatk|super_admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-article"></em></em></span>
                                <span class="nk-menu-text">Gudang ATK</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('gudang.penyimpanan')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Penyimpanan</span></a>
                                    <a href="{{route('gudang.permintaan_atk')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Permintaan</span></a>
                                    <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                            class="nk-menu-text">Migrasi</span></a>
                                    <a href="{{route('gudang.migrasi')}}" class="nk-menu-link"><span
                                                class="nk-menu-text">Stock Of Opname (SO)</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item --> 
                            </ul>
                        </li>
                        @endrole
             

                    <!-- APOTEK -->
                    @role('apotek')
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
                                <span class="nk-menu-text">Daftar Antrian</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('data.antrian') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Bpjs</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-regular.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Umum - Regular</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/orders-sales.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Order Asuransi - Sales</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endrole
                

                </ul>
            </div>
        </div>
    </div>
</div>
