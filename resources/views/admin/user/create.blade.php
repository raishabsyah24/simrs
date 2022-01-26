@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title align-center">Form Tambah User</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-inner">
                            <form action="{{ route('user.store') }}" method="post" class="gy-3">
                                @csrf
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-name">Nama</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama">
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
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
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
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
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
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" class="text-capitalize">
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
                                                <ul class="custom-control-group g-3 align-center">
                                                    <li>
                                                        @foreach ($permissions as $permission)
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" 
                                                            id="pay-card-1" 
                                                            name="permissions[]" value="{{ $permission->name }}">
                                                            <label class="custom-control-label" for="pay-card-1">
                                                                {{ replaceRole($permission->name) }}
                                                            </label>
                                                        </div>
                                                        @endforeach
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

{{-- @push('js')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
    });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        // alert success
        function alert_success(message) {
            Toast.fire({
                icon: "success",
                title: message,
            });
        }

        // alert error
        function alert_error(
            message = "Terjadi kesalahan, silahkan hubungi developer"
        ) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,
            });
        }
        // Simpan 
        function submitForm(originalForm) {
            $(originalForm).find('.form-control').removeClass('is-invalid');
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(response => {
                    alert_success(response.message);
                    setInterval(() => {
                        window.location.reload();
                    }, 3000);

                    $('[name=nama]').val('');
                    $('[name=username]').val('');
                    $('[name=email]').val('');
                    $('[name=role]').val('');
                    $('[name=permission]').val('');
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alert_error();
                })
        }
    </script>
@endpush --}}