@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title page-title align-center">Form {{ $title }}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <form action="{{ route('user.update', $user->id) }}" method="post" class="gy-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="site-name">Nama <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input value="{{ $user->name }}" type="text" class="form-control"
                                                        name="name" autocomplete="off" placeholder="Nama">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Username <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input value="{{ $user->username }}" type="text"
                                                        class="form-control" name="username" autocomplete="off"
                                                        placeholder="Username">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input value="{{ $user->email }}" type="text" class="form-control"
                                                        name="email" autocomplete="off" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Role <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <select class="form-select select2" style="position:absolute;"
                                                        name="role">
                                                        <option disabled selected>Pilih role user ...</option>
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
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Permission</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    @foreach ($permissions as $permission)
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="permissions[]" value="{{ $permission->name }}"
                                                                @foreach ($user->getPermissionNames() as $permission_user)
                                                            @if ($permission->name == $permission_user)
                                                                checked
                                                            @endif
                                                    @endforeach
                                                    id="customSwitch{{ $permission->id }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $permission->id }}">{{ replaceRole($permission->name) }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" onclick="submitForm(this.form)"
                                            class="tombol-simpan btn btn-lg btn-primary">
                                            <span class="text-simpan">Simpan</span>
                                            <span class="loading-simpan d-none ml-2 spinner-border spinner-border-sm"
                                                role="status" aria-hidden="true"></span>
                                        </button>
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

@push('js')
    <script>
        // Simpan 
        function submitForm(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(originalForm).find('.form-control').removeClass('select2-hidden-accessible');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);

                    }
                })
                .done(response => {
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alertError();
                })
        }
    </script>
@endpush
