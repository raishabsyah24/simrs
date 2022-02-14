 <!-- Data (table) -->
 <div class="nk-tb-list is-separate mb-3">
     <div class="nk-tb-item nk-tb-head">
         <div class="nk-tb-col"><span class="sub-text">No</span></div>
         <div class="nk-tb-col"><span class="sub-text">No RM</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Nama Pasien</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Kategori Pasien</span></div>
         <div class="nk-tb-col tb-col-md"><span class="sub-text">Total</span></div>
         <div class="nk-tb-col"><span class="sub-text"><em class="icon ni ni-setting-fill"></em></span>
     </div><!-- .nk-tb-item -->
    </div><!-- .nk-tb-item -->
     @forelse ($data as $item)
         <div class="nk-tb-item">
             <div class="nk-tb-col tb-col-md">
                 <span>{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span>{!! $item->no_rekam_medis !!}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span>{!! $item->nama_pasien !!}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span>{!! $item->kategori_pasien !!}</span>
             </div>
             <div class="nk-tb-col tb-col-md">
                 <span>{!! formatAngka($item->grand_total,true) !!}</span>
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
                                        <a href="{{ route('kasir.detail', $item->nama_pasien) }}">
                                            <em class="icon ni ni-location"></em>
                                            <span>Prosess Pembayaran</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><em class="icon ni ni-edit-fill"></em><span>Ubah</span></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="hapusPasien(`{{ route('pendaftaran.destroy', $item->nama_pasien) }}`)"><em
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
