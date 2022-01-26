$(document).ready(function () {
    $(".fetch-data").removeClass("d-none");
    $(".loader").addClass("d-none");
});

async function fetchData(page = "", query = "", sortBy = "desc") {
    await $.get(
        `/layanan/fetch-data?page=${page}&query=${query}&sortBy=${sortBy}`
    ).done((data) => {
        $(".loader").addClass("d-none");
        $(".fetch-data").removeClass("d-none");
        $(".fetch-data").html(data);
    });
}

function search(el) {
    let query = $(el).val(),
        page = $("input[name=page]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query);
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
        query = $("input[name=query]").val();
    $(".loader").removeClass("d-none");
    $(".fetch-data").addClass("d-none");
    fetchData(page, query);
});

function addForm(url) {
    $(".modal-form").modal("show");
    $(".modal-title").text("Form Tambah Layanan");
}
