<div class="nk-tb-list is-separate mb-3">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><h5>No</h5></div>
        <div class="nk-tb-col"><h5>Nomor Antrian</h5></div>
        <div class="nk-tb-col"><h5>Pasien</h5></div>
        <div class="nk-tb-col"><h5>Dokter</h5></div>
        <div class="nk-tb-col"><h5>Waktu Daftar</h5></div>
    </div>
    @forelse ($data as $item)
        <div class="nk-tb-item">
            <div class="nk-tb-col tb-col-md">
                <h5>{{ $loop->iteration }}</h5>
            </div>
            <div class="nk-tb-col tb-col-md">
                    <h5>
                        {!! $item->no_antrian_periksa !!}
                    </h5>
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
                                <h5 class="tb-lead">{!! $item->nama_pasien !!}
                                    <span class="dot dot-success d-md-none ml-1"></span>
                                </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="nk-tb-col">
                <h5 class="tb-lead text-capitalize">{!! $item->nama_dokter !!}</h5>
            </div>
            <div class="nk-tb-col tb-col-md">
                <h5 class="tb-lead">{!! tanggalJam($item->created_at) !!}</h5>
            </div>
        </div>
    @empty
        <div class="nk-tb-item">
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col">
                <h4 class="text-center">Data tidak ada</h4>
            </div>
            <div class="nk-tb-col"></div>
            <div class="nk-tb-col"></div>
        </div>
    @endforelse
</div>
