<div class="nk-tb-list nk-tb-ulist fetch-data">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col">
            <h6>No</h6>
        </div>
        <div class="nk-tb-col">
            <h6>RM Pasien</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Nama Pasien</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Tanggal Lahir</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Poli</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Tenaga Medis</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Kategori</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Status</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Aksi</h6>
        </div>
    </div>
    <!-- end thead -->
    @forelse ($data as $item)
        <div class="nk-tb-item">
            <div class="nk-tb-col nk-tb-col-check">
                {{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}
            </div>
            <div class="nk-tb-col">
                <div class="user-card">
                    <div class="user-info">
                        <span class="tb-lead">{!! $item->no_rekam_medis !!} <span
                                class="dot dot-success d-md-none ml-1"></span></span>
                    </div>
                </div>
            </div>
            <div class="nk-tb-col tb-col-mb">
                <span class="tb-amount">{!! $item->nama_pasien !!}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount">{{ $item->tanggal_lahir }}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount">{{ $item->spesialis }}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount">{{ $item->nama_dokter }}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount">{{ $item->kategori_pasien }}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount badge badge-dim badge-{{ $badge->random() }}" >
                    {{ $item->status_pembayaran ?? '' }}
                </span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li>
                        <div class="drodown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                    class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="{{ route('apotek.proses-pasien', $item->pemeriksaan_id) }}">
                                            <em class="icon ni ni-edit-fill"></em>
                                            <span>Proses</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ route('apotek.pasien-bpjs', $item->pemeriksaan_id) }}">
                                            <em class="icon ni ni-eye"></em>
                                            <span>Detail</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @empty
        <div class="nk-tb-item">
            <div class="nk-tb-col nk-tb-col-check">
            </div>
            <div class="nk-tb-col">
            </div>
            <div class="nk-tb-col tb-col-mb">
            </div>
            <div class="nk-tb-col tb-col-md">
            </div>
            <div class="nk-tb-col tb-col-lg my-5">
                <h4>Data tidak ada</h4>
            </div>
            <div class="nk-tb-col tb-col-lg">
            </div>
            <div class="nk-tb-col tb-col-md">
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
            </div>
        </div>
    @endforelse
    <!-- end tbody -->
</div>


@if($data->count() > 0) 
<div class="card-inner">
    <div class="nk-block-between-md g-3">
        <div class="g">
            {{ $data->links('components.pagination') }}
        </div>
    </div>
</div>
@endif
