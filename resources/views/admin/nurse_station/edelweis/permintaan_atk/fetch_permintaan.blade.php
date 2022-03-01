<div class="nk-tb-list is-separate mb-3">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">No</span></div>
            <div class="nk-tb-col"><span class="sub-text">No Permintaan</span></div>
            <div class="nk-tb-col"><span class="sub-text">Nama Unit</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tanggal Permintaan</span></div>
            <div class="nk-tb-col"><span class="sub-text">Jenis Permintaan</span></div>
            <div class="nk-tb-col"><span class="sub-text">Item Permintaan</span></div>
            <div class="nk-tb-col"><span class="sub-text">Jumlah</span></div>
            <div class="nk-tb-col"><span class="sub-text">Stok Lama</span></div>
        
            <div class="nk-tb-col"><span class="sub-text"><em class="icon ni ni-setting-fill"></em></span>
            </div>

        </div>
        @forelse ($data ?? '' as $item)
            <div class="nk-tb-item">
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $loop->iteration }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->no_permintaan }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->nama_unit }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->tanggal_permintaan }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->jenis_permintaan }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->item_permintaan }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->jumlah }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $item->stok_lama }}</span>
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
                                            <a href="#"><em class="icon ni ni-edit-fill"></em><span>Ubah</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><em class="icon ni ni-trash"></em><span>Hapus</span></a>
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
                <div class="nk-tb-col"></div>
            </div>

        @endforelse
    </div>


    @if ($data ?? ''->count() > 0)
        <div class="card">
            <div class="card-inner">
                <div class="nk-block-between-md g-3">
                    <div class="g">
                        {{ $data ?? ''->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
