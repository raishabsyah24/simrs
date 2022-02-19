$(document).ready(function() {
    $('.fetch-data').removeClass('d-none');
    $('.loader').addClass('d-none');
})

async function fetchData(page = '', query = '', sortBy = 'desc', dari = "",
sampai = "") {
    await $.get(`/apotek/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}&dari=${dari}&sampai=${sampai}`)
        .done(data => {
            $('.loader').addClass('d-none');
            $('.fetch-data').removeClass('d-none');
            $('.fetch-data').html(data)
        })
}

function search(el) {
    let query = $(el).val(),
        page = $("input[name=page]").val(),
        dari = $("input[name=dari]").val(),
        sampai = $("input[name=sampai]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query, "desc", dari, sampai);
}

function sortBy(sortBy) {
    let page = $("input[name=page]").val(),
        query = $("input[name=query]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query, sortBy);
}

$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1],
        dari = $("input[name=dari]").val(),
        sampai = $("input[name=sampai]").val(),
        query = $("input[name=query]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query, "desc", dari, sampai);
});

function filterDate(originalForm) {
    event.preventDefault();
    let dari = $(originalForm).find("[name=dari]").val(),
        sampai = $(originalForm).find("[name=sampai]").val(),
        page = $("input[name=page]").val(),
        query = $("input[name=query]").val();

    if (dari != "" && sampai != "") {
        if (dari > sampai) {
            alertError(
                "Tanggal awal tidak boleh lebih besar dari tanggal sampai"
            );
        }

        $(".loader").removeClass("d-none");
        $(".fetch-data").addClass("d-none");
        fetchData(page, query, "asc", dari, sampai);
    }
}