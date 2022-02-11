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
                                <h3 class="nk-block-title page-title">
                                    DASHBOARD ANTRIAN
                                </h3>
                            </div>
                        {{-- Head --}}
                        <div class="nk-block-between mt-4">
                            <div class="nk-block-head-content"></div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                   
                                </div>
                            </div>
                            <!-- .nk-block-head-content -->
                        </div>
                    </div>
                    <div>
                    
                    <div class="card">
                        <div class="card-inner">
                         <div class="team">
            
                            <div class="user-card user-card-s2">
                                <div class="user-info">
                                     <h1>LOKET 1</h>
                                <a href="{{route('antrian.umum')}}"> </h2>
                            </div>
                        </div>
            
                        </div><!-- .team -->
                      </div><!-- .card-inner -->
                    </div><!-- .card -->


                    </div>
                    <div class="loader card-inner p-0">
                        <div class="d-flex justify-content-center my-5">
                            <div class="spinner-grow text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/pages/pendaftaran.js') }}"></script>
@endpush

