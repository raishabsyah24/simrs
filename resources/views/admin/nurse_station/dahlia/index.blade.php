@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
 <div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">t</h4>
                                                <p></p>
                                            </div>
                                        </div>
</div>
<div class="card card-preview">
<div class="card-inner">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-inner">
                            <div class="team">
                                <div class="team-status bg-danger text-white"><em class="icon ni ni-na"></em></div>
                                <div class="team-options">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-card user-card-s2">
                                    <div class="user-avatar md bg-primary">
                                        <span>AB</span>
                                        <div class="status dot dot-lg dot-success"></div>
                                    </div>
                                    <div class="user-info">
                                        <h6>Abu Bin Ishtiyak</h6>
                                        <span class="sub-text">@ishtiyak</span>
                                    </div>
                                </div>
                                <div class="team-details">
                                    <p>I am an UI/UX Designer and Love to be creative.</p>
                                </div>
                                <ul class="team-statistics">
                                    <li><span>213</span><span>Projects</span></li>
                                    <li><span>87.5%</span><span>Performed</span></li>
                                    <li><span>587</span><span>Tasks</span></li>
                                </ul>
                                <div class="team-view">
                                    <a href="#" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
                                </div>
                            </div><!-- .team -->
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
            </div>
        </div>
    </div><!-- .card-preview -->
@endsection

@push('js')
<script>
$(document).ready(function() {
$(".fetch-data").removeClass("d-none");
$(".loader").addClass("d-none");
});

async function fetchData(
page = "",
query = "",
status = "",
) {
await $.get(
`/dokter/daftar-pasien/fetch?page=${page}&query=${query}&status=${status}`
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
// status = $("input[name=status]").val(),
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

$(document).on("click", ".pagination a", function(e) {
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
</script>
@endpush
