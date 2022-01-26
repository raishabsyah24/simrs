@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Profil Saya</h4>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Nama</span>
                                                    <span class="data-value">{!! $user->name !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Username</span>
                                                    <span class="data-value">{!! $user->username !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value">{!! $user->email !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more disable"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Nomor Handphone</span>
                                                    <span class="data-value text-soft">{!! $user->profile->no_hp ?? '' !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Tanggal Lahir</span>
                                                    <span class="data-value">{!! $user->profile->tanggal_lahir ? tanggal($user->profile->tanggal_lahir) : '' !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit"
                                                data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">Alamat</span>
                                                    <span class="data-value">{!! $user->profile->alamat ?? '' !!}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Preferences</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Language</span>
                                                    <span class="data-value">English (United State)</span>
                                                </div>
                                                <div class="data-col data-col-end"><a href="#" data-toggle="modal"
                                                        data-target="#profile-language" class="link link-primary">Change
                                                        Language</a></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Date Format</span>
                                                    <span class="data-value">M d, YYYY</span>
                                                </div>
                                                <div class="data-col data-col-end"><a href="#" data-toggle="modal"
                                                        data-target="#profile-language" class="link link-primary">Change</a>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Timezone</span>
                                                    <span class="data-value">Jakarta (GMT +7)</span>
                                                </div>
                                                <div class="data-col data-col-end"><a href="#" data-toggle="modal"
                                                        data-target="#profile-language" class="link link-primary">Change</a>
                                                </div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->
                                    </div><!-- .nk-block -->
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{!! $user->name !!}</span>
                                                    <span class="sub-text">{!! $user->email !!}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                            href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-camera-fill"></em><span>Change
                                                                            Photo</span></a></li>
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-edit-fill"></em><span>Update
                                                                            Profile</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">Account Balance</h6>
                                                <div class="user-balance">12.395769 <small
                                                        class="currency currency-btc">USD</small></div>
                                                <div class="user-balance-sub">Pending <span>0.344939 <span
                                                            class="currency currency-btc">USD</span></span></div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a class="active" href="html/user-profile-regular.html"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Infomation</span></a></li>
                                                <li><a href="html/user-profile-notification.html"><em
                                                            class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                                </li>
                                                <li><a href="html/user-profile-activity.html"><em
                                                            class="icon ni ni-activity-round-fill"></em><span>Account
                                                            Activity</span></a></li>
                                                <li><a href="html/user-profile-setting.html"><em
                                                            class="icon ni ni-lock-alt-fill"></em><span>Security
                                                            Settings</span></a></li>
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection

@push('js')

@endpush
