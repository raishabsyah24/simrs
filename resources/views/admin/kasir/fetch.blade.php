<div class="nk-tb-list is-separate mb-3">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span class="sub-text">No</span></div>
        <div class="nk-tb-col"><span class="sub-text">Nama</span></div>
        <div class="nk-tb-col"><span class="sub-text">No. HP</span></div>
        <div class="nk-tb-col"><span class="sub-text">Tanggal Lahir</span></div>
        <div class="nk-tb-col"><span class="sub-text">Kategori Pasien</span></div>
        <div class="nk-tb-col"><span class="sub-text">Total Tagihan</span></div>
        <div class="nk-tb-col"><span class="sub-text">Status Pembayaran</span></div>
        <div class="nk-tb-col"><span class="sub-text">Status Dilayani</span></div>
        <div class="nk-tb-col"><span class="sub-text text-center"><em class="icon ni ni-setting-fill"></em></span>
        </div>

    </div>
    @forelse ($data as $item)
        <div class="nk-tb-item">
            <div class="nk-tb-col tb-col-md">
                <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
            </div>
            <div class="nk-tb-col">
                <a href="">
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                                <span class="text-uppercase">
                                    {{ $item->jenis_kelamin == 'laki-laki' ? 'Tn' : 'Ny' }}
                                </span>
                        </div>
                        <div class="user-info">
                                <span class="tb-lead">{!! $item->nama_pasien !!}
                                    <span class="dot dot-success d-md-none ml-1"></span>
                                </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">
                        {!! $item->no_hp !!}
                    </span>
            </div>
            <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">
                        {!! tanggal($item->tanggal_lahir) !!}
                    </span>
            </div>
            <div class="nk-tb-col">
                <span class="text-uppercase tb-lead text-capitalize">{!! $item->kategori_pasien !!}
                    <span class="dot dot-success d-md-none ml-1"></span>
                </span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-capitalize tb-lead">{{ formatAngka(totalTagihan($item->kasir_id), true) }}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-uppercase badge badge-dim @if($item->status_pembayaran == 'lunas') badge-success @elseif($item->status_pembayaran == 'piutang') badge-warning @else badge-danger @endif">
                        {!! $item->status_pembayaran !!}
                </span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-uppercase badge badge-dim @if($item->status == 'sudah dilayani') badge-success @else badge-danger @endif">
                        {!! $item->status !!}
                </span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li class="nk-tb-action-hidden">
                        <a href="#" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top"
                           title="Print">
                            <em class="icon ni ni-printer-fill"></em>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                    class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="{{ route('kasir.proses', $item->kasir_id) }}">
                                            <em class="icon ni ni-piority-fill"></em>
                                            <span>Proses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kasir.show', $item->kasir_id) }}">
                                            <em class="icon ni ni-eye"></em>
                                            <span>Lihat Detail</span>
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
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col">
                <h4 class="text-center">Data tidak ada</h4>
            </div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
        </div>
    @endforelse
</div>

@if ($data->count() > $data->perPage())
    <div class="card">
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $data->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endif
