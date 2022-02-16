 <!-- Data (table) -->
 <div class="nk-tb-list is-separate mb-3">
     <div class="nk-tb-item nk-tb-head">
         <div class="nk-tb-col"><span class="sub-text">No</span></div>
         <div class="nk-tb-col"><span class="sub-text">User</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Aktifitas</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Waktu</span></div>
     </div><!-- .nk-tb-item -->
     @forelse ($data as $item)
         <div class="nk-tb-item">
             <div class="nk-tb-col tb-col-md">
                 <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
             </div>
             <div class="nk-tb-col">
                 <div class="user-card">
                     <div class="user-avatar bg-primary">
                         <span class="text-uppercase">{!! getInitialUser($item->nama) !!}</span>
                     </div>
                     <div class="user-info">
                         <span class="tb-lead">{!! $item->nama !!}<span
                                 class="dot dot-success d-md-none ml-1"></span></span>
                         <span>{!! $item->email !!}</span>
                     </div>
                 </div>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span class="badge badge-dot badge-{{ $badge->random() }}">
                     {!! $item->aktifitas !!}
                 </span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span>{!! tanggalJam($item->created_at) !!}</span>
             </div>
         </div>
     @empty
         <div class="nk-tb-item">
             <div class="nk-tb-col nk-tb-col-check">
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
             <div class="nk-tb-col tb-col-lg">
                 <h4 class="text-center">Data tidak ada</h4>
             </div>
             <div class="nk-tb-col nk-tb-col-tools">
             </div>
         </div>
     @endforelse
 </div>


 <!-- .pagination -->
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
