<div class="nk-tb-list nk-tb-ulist fetch-data">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col">
            <h6>No</h6>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <h6>Kode Layanan</h6>
        </div>
        <div class="nk-tb-col tb-col-mb">
            <h6>Layanan</h6>
        </div>
        <div class="nk-tb-col tb-col-md">
            <h6>Tarif</h6>
        </div>
        <div class="nk-tb-col">
            <h6>Keterangan</h6>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <h6>Aksi</h6>
        </div>
    </div>
    <!-- end thead -->
    @forelse ($data as $item)
        <div class="nk-tb-item">
            <div class="nk-tb-col nk-tb-col-check">
                {{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="badge badge-dim badge-{{ $badge->random() }}">
                    {!! $item->kode !!}
                </span>
            </div>
            <div class="nk-tb-col tb-col-mb">
                <span class="tb-amount text-capitalize">{!! $item->nama !!}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span class="tb-amount">{!! formatAngka($item->tarif, true) !!}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-amount">{!! $item->keterangan !!}</span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li class="nk-tb-action-hidden">
                        <a onclick="editForm(`{{ route('layanan.update', $item->id) }}`)"
                            class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Ubah">
                            <em class="icon ni ni-edit-fill"></em>
                        </a>
                    </li>
                    <li class="nk-tb-action-hidden">
                        <a onclick="editForm(`{{ route('layanan.delete', $item->id) }}`)"
                            class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Hapus">
                            <em class="icon ni ni-trash"></em>
                        </a>
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
<div class="card-inner">
    <div class="nk-block-between-md g-3">
        <div class="g">
            {{ $data->links('components.pagination') }}
        </div>
    </div>
</div>
