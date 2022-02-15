function searchData(url, attr) {
    $('.card-pasien').addClass('d-none');
    let data = $(attr).val();
    $.get(url, {
        data: data
    })
        .done(output => {
            if (output != '') {
                $('.dropdown-pasien').removeClass('d-none');
                $('.dropdown-pasien').fadeIn();
                $('.dropdown-pasien').html(output);
            }
            if (data == '') {
                $('.dropdown-pasien').addClass('d-none');
            }
        })
        .fail((error) => {
            alertError();
        });
}

function pilihData(id, url) {
    $('.dropdown-pasien').addClass('d-none');
    $.get(url, {
        id: id
    })
        .done(response => {
            let pasien = response.data;
            $('.card-pasien').removeClass('d-none');
            $('[name=pasien]').val(pasien.id);
            if (pasien.jenis_kelamin == 'laki-laki') {
                $('.nama-pasien').text('Tn. ' + pasien.nama);
            } else {
                $('.nama-pasien').text('Ny. ' + pasien.nama);
            }
            $('.nik-pasien').text(pasien.nik);
            $('.tanggal-lahir-pasien').text(response.usia);
            $('.jenis-kelamin-pasien').text(pasien.jenis_kelamin);
            $('.no-hp-pasien').text(pasien.no_hp);
            $('.alamat-pasien').text(pasien.alamat);
            $('.tanggal-periksa-pasien').text(response.tanggal_periksa);
            $('.poli-pasien').text(pasien.tujuan);
            $('.dokter-pasien').text(pasien.dokter);
        })
        .fail(error => {
            alertError();
        });
}

function showModalPasien() {
    $('.modal-detail-pasien').modal('show');
}

function pilihPoli(url, attr) {
    let poli = parseInt($(attr).val());
    $("[name=dokter_id] .dokter-id").remove();
    $.get(url, {
        poli_id: poli,
    })
        .done((response) => {
            let data = response.data;
            data.forEach(function(item) {
                $("[name=dokter_id]").append(
                    `<option class="dokter-id" value="${item.id}">${item.nama_dokter} (${item.jam_mulai} - ${item.jam_selesai})</option>`
                );
            });
        })
        .fail((error) => {
            alertError();
        });
}

function kategoriPasienDaftar(attr) {
    let bpjs = parseInt($(attr).val());
    if (bpjs === 1) {
        $(".bpjs").removeClass("d-none");
    } else {
        $(".bpjs").addClass("d-none");
    }
}

function submitForm(originalForm) {
    event.preventDefault();
    $(originalForm).find(".form-control").removeClass("error");
    $(originalForm)
        .find(".form-control")
        .removeClass("select2-hidden-accessible");
    $(".invalid").remove();
    $.post({
        url: $(originalForm).attr("action"),
        data: new FormData(originalForm),
        beforeSend: function() {
            $(originalForm).find(".tombol-simpan").attr("disabled", true);
            $(originalForm).find(".text-simpan").text("Menyimpan . . .");
            $(originalForm).find(".loading-simpan").removeClass("d-none");
        },
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        complete: function() {
            $(originalForm).find(".loading-simpan").addClass("d-none");
            $(originalForm).find(".text-simpan").text("Simpan");
            $(originalForm).find(".tombol-simpan").attr("disabled", false);
        },
    })
        .done((response) => {
            $(originalForm).find(".tombol-simpan").attr("disabled", true);
            alertSuccess(response.message);
            pindahHalaman(response.url, 1500);
        })
        .fail((errors) => {
            if (errors.status === 422) {
                loopErrors(errors.responseJSON.errors);

                return;
            }
            alertError();
        });
}
