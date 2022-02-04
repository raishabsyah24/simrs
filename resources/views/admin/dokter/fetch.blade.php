<div class="nk-tb-list is-separate mb-3">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span class="sub-text">No</span></div>
        <div class="nk-tb-col"><span class="sub-text">Nama</span></div>
        <div class="nk-tb-col"><span class="sub-text">Spesialis</span></div>
        <div class="nk-tb-col"><span class="sub-text">No. HP</span></div>
        <div class="nk-tb-col"><span class="sub-text">Tanggal Bergabung</span></div>
        <div class="nk-tb-col"><span class="sub-text">Hari Praktek</span></div>
        <div class="nk-tb-col"><span class="sub-text">Jam Praktek</span></div>
        <div class="nk-tb-col"><span class="sub-text">Status</span></div>
        <div class="nk-tb-col"><span class="sub-text text-center"><em class="icon ni ni-setting-fill"></em></span>
        </div>

    </div>
    @forelse ($data as $item)
        <div class="nk-tb-item">
            <div class="nk-tb-col tb-col-md">
                <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
            </div>
            <div class="nk-tb-col">
                <a href="html/ecommerce/customer-details.html">
                    <div class="user-card">
                        <div class="user-avatar">
                            <img src="{{ asset('backend/images/avatar/a-sm.jpg') }}" alt="">
                        </div>
                        <div class="user-info">
                            <span class="tb-lead">{!! $item->nama !!} <span
                                    class="dot dot-warning d-md-none ml-1"></span></span>
                            <span>{!! $item->email !!}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-lead">
                    {!! $item->spesialis !!}
                </span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-lead">
                    {!! $item->no_hp !!}
                </span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-capitalize tb-lead">{!! tanggalDate($item->tanggal_bergabung) !!}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-capitalize tb-lead">{!! $item->hari_praktek !!}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="text-capitalize tb-lead">{!! jam($item->jam_mulai) !!} - {!! jam($item->jam_selesai) !!}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="badge badge-dot badge-{{ $item->status == 'aktif' ? 'success' : 'danger' }}">
                    {!! $item->status !!}
                </span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                    class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="{{ route('user.edit', $item->id) }}"><em
                                                class="icon ni ni-edit-fill"></em><span>Ubah</span></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="updateStatus(`{{ route('user.update-status', $item->id) }}`)">
                                            @if ($item->status == 'aktif')
                                                <em class="icon ni ni-lock-alt-fill"></em>
                                                <span>Blokir</span>
                                            @else
                                                <em class="icon ni ni-unlock-fill"></em>
                                                <span>Aktifkan</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="resetPassword(`{{ route('user.reset-password', $item->id) }}`)"><em
                                                class="icon ni ni-power"></em><span>Reset Password</span></a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="hapusUser(`{{ route('user.delete', $item->id) }}`)"><em
                                                class="icon ni ni-trash"></em><span>Hapus</span></a>
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
            <div class="nk-tb-col">
                <h4 class="text-center">Data tidak ada</h4>
            </div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
        </div>
    @endforelse
</div>


@if ($data->count() > 0)
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
