 <!-- Data (table) -->
 <div class="nk-tb-list is-separate mb-3">
     <div class="nk-tb-item nk-tb-head">
         <div class="nk-tb-col"><span class="sub-text">No</span></div>
         <div class="nk-tb-col"><span class="sub-text">ID Pasien</span></div>
         <div class="nk-tb-col"><span class="sub-text">NO RM Pasien</span></div>
         <div class="nk-tb-col"><span class="sub-text">Pasien</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Kategori</span></div>
         <div class="nk-tb-col"><span class="sub-text">Tanggal Lahir</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Tujuan Poli</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Tenaga Medis</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Waktu Daftar</span></div>
     </div><!-- .nk-tb-item -->
     @forelse ($data as $item)
         <div class="nk-tb-item">
             <div class="nk-tb-col tb-col-md">
                 <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span class="badge badge-dim badge-{{ $badge->random() }}">
                     {!! $item->kode_pasien !!}
                 </span>
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
                                 {{ $item->jenis_kelamin == 'laki-laki' ? 'Tn.' : 'Ny.' }}
                             </span>
                         </div>
                         <div class="user-info">
                             <span class="tb-lead">{!! $item->nama_pasien !!}<span
                                     class="dot dot-success d-md-none ml-1"></span></span>
                             <span>{!! $item->nik ?? '' !!}</span>
                         </div>
                     </div>
                 </a>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <div class="user-info">
                     <span class="tb-lead text-uppercase">{!! $item->kategori_pasien !!}<span
                             class="dot dot-success d-md-none ml-1"></span></span>
                     <span>{!! $item->kategori_pasien == 'bpjs' ? $item->no_sep : '' !!}</span>
                 </div>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <div class="user-info">
                     <span class="tb-lead text-uppercase">{!! tanggal($item->tanggal_lahir) !!}<span
                             class="dot dot-success d-md-none ml-1"></span></span>
                     <span>{!! usia($item->tanggal_lahir) !!}</span>
                 </div>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span class="text-capitalize tb-lead">{!! $item->tujuan !!}</span>
             </div>
             <div class="nk-tb-col">
                 <span class="tb-lead">{!! $item->nama_dokter !!}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span class="text-capitalize">{!! tanggalJam($item->created_at) !!}</span>
             </div>
         </div>
     @empty
         <div class="nk-tb-item">
             <div class="nk-tb-col nk-tb-col-check">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col tb-col-lg">
                 <h4 class="text-center">Data tidak ada</h4>
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
         </div>
     @endforelse
 </div>


 <!-- .pagination -->
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
