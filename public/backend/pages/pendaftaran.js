$(document).ready(function () {
    $(".fetch-data").removeClass("d-none");
    $(".loader").addClass("d-none");
});

async function fetchData(
    page = "",
    query = "",
    sortBy = "desc",
    kategori = "",
    poli = ""
) {
    await $.get(
        `/pendaftaran/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}&kategori=${kategori}&poli=${poli}`
    )
        .done((data) => {
            $(".loader").addClass("d-none");
            $(".fetch-data").removeClass("d-none");
            $(".fetch-data").html(data);
        })
        .fail((error) => {
            $(".loader").addClass("d-none");
            modalError();
        });
}

function search(el) {
    let query = $(el).val(),
        page = $("input[name=page]").val(),
        kategori = $("input[name=kategori]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query, "desc");
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
        kategori = $("input[name=kategori]").val(),
        query = $("input[name=query]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query, "desc", kategori);
});

function filterKategori(kategori) {
    event.preventDefault();
    let page = $("input[name=page]").val(),
        query = $("input[name=query]").val(),
        poli = $("input[name=poli]").val();
    fetchData(page, query, "desc", kategori, poli);
}

function filterPoli(poli) {
    event.preventDefault();
    let page = $("input[name=page]").val(),
        query = $("input[name=query]").val(),
        kategori = $("input[name=kategori]").val();
    fetchData(page, query, "desc", kategori, poli);
}
