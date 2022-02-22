    <div class="nk-tb-list is-separate mb-3">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">No</span></div>
            <div class="nk-tb-col"><span class="sub-text">No RM Pasien</span></div>
            <div class="nk-tb-col"><span class="sub-text">Pasien</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tanggal Lahir</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tujuan Poli</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tenaga Medis</span></div>
            <div class="nk-tb-col"><span class="sub-text">Tanggal Periksa</span></div>
            <div class="nk-tb-col"><span class="sub-text">Status Periksa</span></div>
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
                            </div>
                        </div>
                    </a>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">
                        {!! tanggal($item->tanggal_lahir) !!}
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="text-capitalize tb-lead">{!! $item->nama_poli !!}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-lead text-capitalize">{!! $item->nama_dokter ?? '' !!}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-lead">{!! tanggal($item->tanggal_periksa) !!}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span
                        class="badge badge-dim badge-{{ $item->status_diperiksa == 'sudah diperiksa' ? 'success' : 'danger' }} text-capitalize">
                        {!! $item->status_diperiksa !!}
                    </span>
                </div>
                <div class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1">
                        @if ($item->status_diperiksa == 'belum diperiksa')
                            <li class="nk-tb-action-hidden">
                                <a href="#"
                                    onclick="periksa(`{{ route('poli-station.update', $item->periksa_poli_station_id) }}`, `{{ $item->nama_pasien }}`, `{{ route('poli-station.periksa', $item->pemeriksaan_id) }}`)"
                                    class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top"
                                    title="Periksa {{ $item->nama_pasien }}">
                                    <em class="icon ni ni-arrow-right-fill-c"></em>
                                </a>
                            </li>
                        @else
                            <li class="nk-tb-action-hidden">
                                <a href="#"
                                    onclick="detailPasien(`{{ route('poli-station.detail-pasien', $item->periksa_poli_station_id) }}`)"
                                    class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top"
                                    title="Lihat Detail">
                                    <em class="icon ni ni-eye"></em>
                                </a>
                            </li>
                        @endif
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
