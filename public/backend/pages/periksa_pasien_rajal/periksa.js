const id = $('#periksa-dokter-id').data('id');

function reloadTableObat() {
    setTimeout(() => {
        $.get(`/dokter/obat-pasien/${id}`)
            .done(response => {
                let limit = response.limit;
                if (limit == 'limit') {
                    $('input[name=obat]').prop('disabled', true);
                    alertError('Limit bos');
                }
                $('table .data-obat').html(response.output);
            })
            .fail(error => {
                alertError();
            })
    }, 600);
}

function reloadTableDiagnosa() {
    setTimeout(() => {
        $.get(`/dokter/diagnosa-pasien/${id}`)
            .done(response => {
                $('.dropdown-diagnosa').addClass('d-none');
                $('.table-diagnosa').removeClass('d-none');
                $('table .data-diagnosa').html(response.output);
            })
            .fail(error => {
                alertError();
            })
    }, 600);
}

function reloadTableTindakan() {
    setTimeout(() => {
        $.get(`/dokter/tindakan-pasien/${id}`)
            .done(response => {
                $('.dropdown-tindakan').addClass('d-none');
                $('.table-tindakan').removeClass('d-none');
                $('table .data-tindakan').html(response.output);
            })
            .fail(error => {
                alertError();
            })
    }, 600);
}

// Obat
reloadTableObat();

async function searchObat(id, url, attr) {
    if ($('.dropdown-obat').hasClass('d-none')) {
        $('.dropdown-obat').removeClass('d-none');
    }

    let obat = $(attr).val();

    await $.get(url, {
        obat: obat,
        periksa_dokter_id: id
    })
        .done(output => {
            if (output != '') {
                $('.dropdown-obat').html(output);
            }
        })
}

function pilihObat(obat_apotek_id, periksa_dokter_id, url) {
    event.preventDefault();
    $('.dropdown-obat').addClass('d-none');
    $.post({
        url: url,
        type: 'post',
        data: {
            obat_apotek_id: obat_apotek_id,
            periksa_dokter_id: periksa_dokter_id
        }
    })
        .done(response => {
            let status = response.status;
            $('[name=obat]').val('')
            if (status == false) {
                $('input[name=obat]').prop('disabled', true);
                alertError('Pasien bpjs sudah mencapai limit obat',
                    'Silahkan kurangi jumlah obat atau kurangi obat pasien');
            } else {
                alertSuccess(response.message);
                let url = response.url;
                $.get(url)
                    .done(output => {
                        $('table .data-obat').html(output);
                        reloadTableObat();
                    })
            }
        })
}

function updateQuantity(url, attr, obat_pasien_periksa_rajal_id) {
    let qty = $(attr).val();
    $('input[name=obat]').prop('disabled', false);

    $.post({
        url: url,
        data: {
            _method: "PUT",
            jumlah: qty,
            obat_pasien_periksa_rajal_id: obat_pasien_periksa_rajal_id,
        },
    })
        .done(response => {
            let limit = response.limit;
            if (limit == 'limit') {
                $(attr).val(1);
                $('input[name=obat]').prop('disabled', true);
                alertError('Pasien bpjs sudah mencapai limit obat',
                    'Silahkan kurangi jumlah obat atau kurangi obat pasien');
            }
            reloadTableObat();
        })
}

function hapusObat(url, id, periksa_dokter_id) {
    event.preventDefault();
    $.post({
        url: url,
        data: {
            _method: "DELETE",
            id: id,
            periksa_dokter_id: periksa_dokter_id
        },
    })
        .done(response => {
            let input = response.input;
            if (input == true) {
                $('[name=obat]').prop('disabled', false)
            }
            alertSuccess('Hapus obat berhasil')
            reloadTableObat();
        })
}

function submitForm(originalForm) {
    event.preventDefault();
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
            modalTerimakasih(response.message);
            pindahHalaman(response.url, 3000);
        })
        .fail(errors => {
            if (errors.status === 422) {
                loopErrors(errors.responseJSON.errors);
                return;
            }
            alertError();
        })
}

function signaSatu(url, attr, obat_pasien_periksa_rajal_id) {
    let signa1 = $(attr).val();
    $('input[name=obat]').prop('disabled', false);

    $.post({
        url: url,
        data: {
            _method: "PUT",
            signa1: signa1,
            obat_pasien_periksa_rajal_id: obat_pasien_periksa_rajal_id,
        },
    })
        .done(response => {
            reloadTableObat();
        })
}

function signaDua(url, attr, obat_pasien_periksa_rajal_id) {
    let signa2 = $(attr).val();
    $('input[name=obat]').prop('disabled', false);

    $.post({
        url: url,
        data: {
            _method: "PUT",
            signa2: signa2,
            obat_pasien_periksa_rajal_id: obat_pasien_periksa_rajal_id,
        },
    })
        .done(response => {
            reloadTableObat();
        })
}

// Diagnosa
reloadTableDiagnosa();

function searchDiagnosa(id, url, attr) {
    let diagnosa = $(attr).val();
    if ($('.dropdown-diagnosa').hasClass('d-none')) {
        $('.dropdown-diagnosa').removeClass('d-none');
    }
    $.get(url, {
        diagnosa: diagnosa,
        periksa_dokter_id: id
    })
        .done(output => {
            if (output != '') {
                $('.dropdown-diagnosa').html(output);
            }
        })
}

function pilihDiagnosa(diagnosa_id, periksa_dokter_id, url) {
    event.preventDefault();
    $.post({
        url: url,
        type: 'post',
        data: {
            diagnosa_id: diagnosa_id,
            periksa_dokter_id: periksa_dokter_id
        }
    })
        .done(response => {
            let status = response.status;
            $('[name=diagnosa]').val('')
            alertSuccess(response.message);
            let url = response.url;
            $.get(url)
                .done(output => {
                    $('.dropdown-diagnosa').addClass('d-none');
                    $('.table-diagnosa').removeClass('d-none');
                    $('table .data-diagnosa').html(output);
                    reloadTableDiagnosa();
                })
        })
}

function hapusDiagnosa(url, id, periksa_dokter_id) {
    event.preventDefault();
    $.post({
        url: url,
        data: {
            _method: "DELETE"
        },
    })
        .done(response => {
            alertSuccess('Hapus diagnosa pasien berhasil')
            reloadTableDiagnosa();
        })
}

function diagnosaBagian(url, attr) {
    let bagian = $(attr).val();
    $.post({
        url: url,
        data: {
            _method: "PUT",
            bagian: bagian
        },
    })
        .done(response => {
            console.log(response);
        })
}

// Tindakan
reloadTableTindakan();

function searchTindakan(id, url, attr) {
    let tindakan = $(attr).val();
    if ($('.dropdown-tindakan').hasClass('d-none')) {
        $('.dropdown-tindakan').removeClass('d-none');
    }
    $.get(url, {
        tindakan: tindakan,
        periksa_dokter_id: id
    })
        .done(output => {
            if (output != '') {
                $('.dropdown-tindakan').html(output);
            }
        })
}

function pilihTindakan(tindakan_id, periksa_dokter_id, url) {
    event.preventDefault();
    $.post({
        url: url,
        type: 'post',
        data: {
            tindakan_id: tindakan_id,
            periksa_dokter_id: periksa_dokter_id
        }
    })
        .done(response => {
            let status = response.status;
            $('[name=tindakan]').val('')
            alertSuccess(response.message);
            let url = response.url;
            $.get(url)
                .done(output => {
                    $('.dropdown-tindakan').addClass('d-none');
                    $('.table-tindakan').removeClass('d-none');
                    $('table .data-tindakan').html(output);
                    reloadTableTindakan();
                })
        })
}

function hapusTindakan(url, id, periksa_dokter_id) {
    event.preventDefault();
    $.post({
        url: url,
        data: {
            _method: "DELETE"
        },
    })
        .done(response => {
            alertSuccess('Hapus tindakan pasien berhasil')
            reloadTableTindakan();
        })
}

function tindakanBagian(url, attr) {
    let bagian = $(attr).val();
    $.post({
        url: url,
        data: {
            _method: "PUT",
            bagian: bagian
        },
    })
        .done(response => {
            console.log(response);
        })
}
