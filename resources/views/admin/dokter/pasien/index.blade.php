@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Users Card</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total 95 projects.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary"
                                                        data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Add User</span></a></li>
                                                            <li><a href="#"><span>Add Team</span></a></li>
                                                            <li><a href="#"><span>Import User</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="card">
                                    <div class="card-inner">
                                        <div class="team">
                                            <div class="team-status bg-danger text-white"><em class="icon ni ni-na"></em>
                                            </div>
                                            <div class="team-options">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                        data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick
                                                                        View</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-eye"></em><span>View
                                                                        Details</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-mail"></em><span>Send
                                                                        Email</span></a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><em
                                                                        class="icon ni ni-shield-star"></em><span>Reset
                                                                        Pass</span></a></li>
                                                            <li><a href="#"><em
                                                                        class="icon ni ni-shield-off"></em><span>Reset
                                                                        2FA</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend
                                                                        User</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar md bg-primary">
                                                    <span>AB</span>
                                                    <div class="status dot dot-lg dot-success"></div>
                                                </div>
                                                <div class="user-info">
                                                    <h6>Abu Bin Ishtiyak</h6>
                                                    <span class="sub-text">@ishtiyak</span>
                                                </div>
                                            </div>
                                            <div class="team-details">
                                                <p>I am an UI/UX Designer and Love to be creative.</p>
                                            </div>
                                            <ul class="team-statistics">
                                                <li><span>213</span><span>Projects</span></li>
                                                <li><span>87.5%</span><span>Performed</span></li>
                                                <li><span>587</span><span>Tasks</span></li>
                                            </ul>
                                            <div class="team-view">
                                                <a href="html/user-details-regular.html"
                                                    class="btn btn-round btn-outline-light w-150px"><span>View
                                                        Profile</span></a>
                                            </div>
                                        </div><!-- .team -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
