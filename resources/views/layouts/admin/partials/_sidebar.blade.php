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

                    <!-- SUPER ADMIN -->
                    @role('super_admin')
                        <li class="nk-menu-item {{ activeClass('layanan.index') }}">
                            <a href="{{ route('layanan.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                                <span class="nk-menu-text">Layanan</span>
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
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                                <span class="nk-menu-text">Data Master</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link"><span class="nk-menu-text">Kategori Obat</span></a>
                                </li>
                                <li class="nk-menu-item">
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
                    @endrole
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                            <span class="nk-menu-text">Data Master</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link"><span class="nk-menu-text">Riwayat
                                        Pasien</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Daftar Antrian</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link"><span class="nk-menu-text">User List -
                                        Regular</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-files-fill"></em></span>
                            <span class="nk-menu-text">Error Pages</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/pages/errors/404-classic.html" target="_blank"
                                    class="nk-menu-link"><span class="nk-menu-text">404
                                        Classic</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/errors/504-classic.html" target="_blank"
                                    class="nk-menu-link"><span class="nk-menu-text">504
                                        Classic</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/errors/404-s1.html" target="_blank" class="nk-menu-link"><span
                                        class="nk-menu-text">404
                                        Modern</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/errors/504-s1.html" target="_blank" class="nk-menu-link"><span
                                        class="nk-menu-text">504
                                        Modern</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-files-fill"></em></span>
                            <span class="nk-menu-text">Other Pages</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/_blank.html" class="nk-menu-link"><span class="nk-menu-text">Blank /
                                        Startup</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/faqs.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Faqs / Help</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/terms-policy.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Terms / Policy</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/regular-v1.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Regular Page - v1</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pages/regular-v2.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Regular Page - v2</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Components</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                            <span class="nk-menu-text">Ui Elements</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/elements/alerts.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Alerts</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/accordions.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Accordions</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/avatar.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Avatar</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/badges.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Badges</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/buttons.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Buttons</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/buttons-group.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Button
                                        Group</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/breadcrumb.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Breadcrumb</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/cards.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Cards</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/carousel.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Carousel</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/list-dropdown.html" class="nk-menu-link"><span
                                        class="nk-menu-text">List
                                        Dropdown</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/modals.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Modals</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/pagination.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Pagination</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/popover.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Popovers</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/progress.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Progress</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/spinner.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Spinner</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/tabs.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Tabs</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/toast.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Toasts</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/tooltip.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Tooltip</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/elements/typography.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Typography</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                        class="nk-menu-text">Utilities</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/elements/util-border.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Border</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-colors.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Colors</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-display.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Display</span></a>
                                    </li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-embeded.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Embeded</span></a>
                                    </li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-flex.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Flex</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-text.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Text</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-sizing.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Sizing</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-spacing.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Spacing</span></a>
                                    </li>
                                    <li class="nk-menu-item"><a href="html/components/elements/util-others.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Others</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-dot-box-fill"></em></span>
                            <span class="nk-menu-text">Crafted Icons</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/misc/svg-icons.html" class="nk-menu-link">
                                    <span class="nk-menu-text">SVG Icon - Exclusive</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/misc/nioicon.html" class="nk-menu-link">
                                    <span class="nk-menu-text">Nioicon - HandCrafted</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="html/components/misc/icons.html" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-circled"></em></span>
                            <span class="nk-menu-text">Icon Libraries</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                            <span class="nk-menu-text">Tables</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/tables/table-basic.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Basic
                                        Tables</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/tables/table-special.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Special
                                        Tables</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/tables/table-datatable.html" class="nk-menu-link"><span
                                        class="nk-menu-text">DataTables</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-view-group-fill"></em></span>
                            <span class="nk-menu-text">Forms</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/forms/form-elements.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Form
                                        Elements</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/checkbox-radio.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Checkbox
                                        Radio</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/advanced-controls.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Advanced
                                        Controls</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/input-group.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Input
                                        Group</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/form-upload.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Form
                                        Upload</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/datetime-picker.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Date &amp; Time
                                        Picker</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/number-spinner.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Number
                                        Spinner</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/nouislider.html" class="nk-menu-link"><span
                                        class="nk-menu-text">noUiSlider</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/form-layouts.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Form
                                        Layouts</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/form-validation.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Form
                                        Validation</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/forms/form-wizard.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Wizard
                                        Basic</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">Rich
                                        Editor</span></a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item"><a href="html/components/forms/form-summernote.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Summernote</span></a>
                                    </li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-quill.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Quill</span></a></li>
                                    <li class="nk-menu-item"><a href="html/components/forms/form-tinymce.html"
                                            class="nk-menu-link"><span class="nk-menu-text">Tinymce</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-pie-fill"></em></span>
                            <span class="nk-menu-text">Charts</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/charts/chartjs.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Chart JS</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/charts/knob.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Knob JS</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-puzzle-fill"></em></span>
                            <span class="nk-menu-text">Widgets</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/widgets/cards.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Card Widgets</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/widgets/charts.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Chart Widgets</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/components/widgets/ratings.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Ratings Widgets</span><span
                                        class="nk-menu-badge">New</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-block-over"></em></span>
                            <span class="nk-menu-text">Miscellaneous</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/components/misc/slick-sliders.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Slick
                                        Slider</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/toastr.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Toastr</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/sweet-alert.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Sweet
                                        Alert</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/js-tree.html" class="nk-menu-link"><span
                                        class="nk-menu-text">jsTree</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/dual-listbox.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Dual
                                        Listbox</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/dragula.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Dragula</span><span
                                        class="nk-menu-badge">New</span></a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="html/components/misc/map.html" class="nk-menu-link"><span
                                        class="nk-menu-text">Google Map</span><span
                                        class="nk-menu-badge">New</span></a>
                            </li><!-- .nk-menu-item -->
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="html/email-templates.html" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-tag-alt-fill"></em></span>
                            <span class="nk-menu-text">Email Template</span>
                        </a>
                    </li>
                    <!-- LAB -->

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
                                            class="nk-menu-text">Pemeriksaan Radiologi RS</span></a>
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

                    @role('dokter')
                        <li class="nk-menu-item {{ activeClass('layanan.index') }}">
                            <a href="{{ route('layanan.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                                <span class="nk-menu-text">Layanan</span>
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
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                <span class="nk-menu-text">Products</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="html/product-list.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Product List</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/product-card.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Product Card</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="html/product-details.html" class="nk-menu-link"><span
                                            class="nk-menu-text">Product Details</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endrole

                    <!-- KASIR -->
                    @role('kasir')
                        <li class="nk-menu-item">

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
                    @endrole


                    <!-- APOTEK -->
                    @role('apotek')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                                <span class="nk-menu-text">Data Master</span>
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
                    @endrole
                    @role('apotek')
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
                    @role('lab')
                        <li class="nk-menu-item has-sub">
                            <a class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                <span class="nk-menu-text">Pemeriksaan Lab</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('lab.otc') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab OTC</span></a>
                                    <a href="{{ route('lab.umum') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Pemeriksaan Lab RS</span></a>
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
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
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
                        {{-- <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-folders-fill"></em></span>
                            <span class="nk-menu-text">Managemen User</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('data.user') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Pengguna</span></a>
                            </li>
                        </ul>
                    </li>
                        </ul>
                    </li> --}}
                    @endrole

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
