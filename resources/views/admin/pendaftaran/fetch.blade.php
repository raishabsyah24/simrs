    <div class="nk-tb-list is-separate mb-3">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">No</span></div>
            <div class="nk-tb-col"><span class="sub-text">No RM Pasien</span></div>
            <div class="nk-tb-col"><span class="sub-text">Pasien</span></div>
            <div class="nk-tb-col"><span class="sub-text">Kategori</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tanggal Lahir</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tujuan Poli</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tenaga Medis</span></div>
            <div class="nk-tb-col"><span class="sub-text">Waktu Daftar</span></div>
            <div class="nk-tb-col"><span class="sub-text">Rencana Periksa</span></div>
            <div class="nk-tb-col"><span class="sub-text"><em class="icon ni ni-setting-fill"></em></span>
            </div>

        </div>
        @forelse ($data as $item)
            <div class="nk-tb-item">
                <div class="nk-tb-col tb-col-md">
                    <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="badge badge-dim badge-{{ $badge->random() }}">
                        {!! $item->no_rekam_medis !!}
                    </span>
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
                                <span>{!! $item->nik ?? '' !!}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="nk-tb-col">
                    <div class="user-card">
                        <div class="user-info">
                            <span class="tb-lead text-capitalize">{!! $item->kategori_pasien !!}
                                <span class="dot dot-success d-md-none ml-1"></span>
                            </span>
                            <span>{!! $item->nik ?? '' !!}</span>
                        </div>
                    </div>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">
                        {!! tanggal($item->tanggal_lahir) !!}
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="text-capitalize tb-lead">{!! $item->tujuan !!}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-lead text-capitalize">{!! $item->nama_dokter !!}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">{!! tanggalJam($item->created_at) !!}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">{!! tanggal($item->tanggal) !!}</span>
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
                                            <a href="#"
                                                onclick="hapusPasien(`{{ route('pendaftaran.destroy', $item->pemeriksaan_id) }}`)"><em
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
