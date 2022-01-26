$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function alertError(
    title = "Maaf, terjadi kesalahan",
    message = "Harap hubungi tim developer"
) {
    event.preventDefault();
    Swal.fire(title, message, "error");
}

function showModalLogout() {
    event.preventDefault();
    $(".modal-logout").modal("show");
}

// Loop errors
function loopErrors(errors) {
    $(".invali").remove();
    if (errors == undefined) {
        return;
    }
    for (error in errors) {
        $(`[name=${error}]`).addClass("is-invalid");
        if ($(`[name=${error}]`).attr("type") == "radio") {
            $(`<div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass("select2")) {
            $(`<div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).attr("type") == "checkbox") {
            $(`<div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next().next());
        } else {
            $(`<div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`));
        }
    }
}

// Confirm delete alert
function confirm_delete(url, table = "", reload = false) {
    Swal.fire({
        title: "Apakah anda yakin menghapus data ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _method: "DELETE",
                },
            })
                .done((response) => {
                    alert_success(response.message);
                    $(table).DataTable().ajax.reload();
                    if (reload === true) {
                        window.location.reload();
                    }
                })
                .fail((errors) => {
                    alert_error(errors.responseJSON.message);
                    return;
                });
        }
    });
}

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

// Reset form
function resetForm(selector) {
    $(selector)[0].reset();
    $(".choices").trigger("change");
    $(".form-control, .choiches").removeClass("is-invalid");
    $(".select2").trigger("change");
    $(".invalid-feedback").remove();
}

// Loop form
function loopForm(originalForm) {
    for (field in originalForm) {
        if ($(`[name=${field}]`).attr("type") != "file") {
            if ($(`[name=${field}]`).hasClass("summernote")) {
                $(`[name=${field}]`).summernote("code", originalForm[field]);
            }

            $(`[name=${field}]`).val(originalForm[field]);
            $(`select`).trigger("change");
        } else {
            $(`.preview-${field}`).attr("src", originalForm[field]).show();
        }
    }
}

function pindahHalaman(url, detik = 3000) {
    setTimeout(function () {
        window.location.href = url;
    }, detik);
}
