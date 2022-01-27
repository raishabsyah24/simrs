@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub">
                                <p>List Tenaga Medis </p>
                            </div>
                            <h3 class="nk-block-title fw-normal">Data Tenaga Medis</h3>
                            <p class="nk-block-tools text-soft">Total Data {{ formatAngka($total) }}</p>
                            <ul class="nk-block-tools g-3 justify-content-end">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                    <a href="{{ route('data.create-medis') }}" class="btn btn-primary d-none d-md-inline-flex">
                                        <em class="icon ni ni-plus"></em>
                                        <span>Tambah Medis</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No Str</th>
                                            <th>Nama</th>
                                            <th>Spesialis</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_str }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->spesialis }}</td>
                                            <td>
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                                    class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li>
                                                                        <a href="#"><em class="icon ni ni-edit-fill">
                                                                            </em><span>Ubah</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><em class="icon ni ni-eye"></em>
                                                                            <span>Detail</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><em class="icon ni ni-trash">
                                                                            </em><span>Hapus</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
@endsection