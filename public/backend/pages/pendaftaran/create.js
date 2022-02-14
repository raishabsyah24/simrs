
function pilihPoli(url, attr) {
    let poli = parseInt($(attr).val());
    $('[name=dokter_id] .dokter-id').remove();
    $.get(url, {
        poli_id: poli
    })
        .done(response => {
            let data = response.data;
            data.forEach(function(item) {
                $('[name=dokter_id]').append(
                    `<option class="dokter-id" value="${item.id}">${item.nama_dokter}</option>`
                )
            })
        })
        .fail(error => {
            alertError()
        })
}

function kategoriPasienDaftar(attr) {
    let bpjs = parseInt($(attr).val());
    if (bpjs === 1) {
        $('.bpjs').removeClass('d-none')
    } else {
        $('.bpjs').addClass('d-none')
    }
}

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
