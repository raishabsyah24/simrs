@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title align-center"></h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-inner">
                            <form action="{{ route('user.update', $user->id) }}" method="post" class="gy-3">
                                @csrf
                                @method('put')
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-name">Nama</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ $user->username }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Role</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="role">
                                                    <option disabled selected>Pilih role user ...</option>
                                                    {{-- @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" class="text-capitalize">
                                                        {{ replaceRole($role->name) }}</option>
                                                    @endforeach --}}
                                                    @foreach ($roles as $role)
                                                        <option
                                                            {{ $user->getRoleNames()[0] == $role->name ? 'selected' : '' }}
                                                            value="{{ $role->name }}" class="text-capitalize">
                                                            {{ replaceRole($role->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Permission</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <ul class="custom-control-group g-3 align-center">
                                                    <li>
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            @foreach ($permissions as $permission)
                                                                
                                                            <input type="checkbox" class="custom-control-input" id="com-email"
                                                            name="permission[]"
                                                            @foreach ($user->getPermissionNames() as $permission_user)
                                                            @if ($permission->name == $permission_user)
                                                                checked
                                                            @endif
                                                        @endforeach
                                                        value="{{ $permission->name }}">
                                                            <label class="custom-control-label" for="com-email">
                                                                {{ replaceRole($permission->name) }}
                                                            </label>
                                                        @endforeach
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary" 
                                            >Tambah</button>
                                            <button type="reset"  title="Kosongkan form" 
                                                    class="btn btn-lg btn-secondary">Reset</button>
                                            <button type="button" class="btn btn-lg btn-warning button-cancel">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- card -->
                </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
@endsection