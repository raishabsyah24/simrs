 <div class="nk-block">
     <div class="row g-gs">
         @forelse ($data as $item)
             <div class="col-sm-6 col-lg-4 col-xxl-3">
                 <div class="card">
                     <div class="card-inner">
                         <div class="team">
                             @if ($item->status_diperiksa == 'sudah diperiksa')
                                 <div class="team-status bg-success text-white">
                                     <em class="icon ni ni-check-thick"></em>
                                 </div>
                             @else
                                 <div class="team-status bg-light text-black">
                                     <em class="icon ni ni-check-thick"></em>
                                 </div>
                             @endif
                             <div class="user-card user-card-s2">
                                 <div class="user-avatar md bg-primary">
                                     <span class="text-uppercase">{{ getInitialUser($item->nama_pasien) }}</span>
                                 </div>
                                 <div class="user-info">
                                     <h6>{{ $item->jenis_kelamin == 'laki-laki' ? 'Tn' : 'Ny' }}.
                                         {{ $item->nama_pasien }}
                                     </h6>
                                 </div>
                             </div>
                             <div class="team-details">
                                 <p>{{ usia($item->tanggal_lahir) }}</p>
                             </div>
                             <ul class="team-statistics">
                                 <li><span>No
                                         Antrian</span><span>{{ substr($item->no_antrian_periksa, -4) }}</span>
                                 </li>
                                 <li><span>Status</span><span>{{ $item->status_diperiksa }}</span>
                                 </li>
                             </ul>
                             <div class="team-view">
                                 <p class="text-center">Pasien Dokter :<br>
                                     {{ $item->nama_dokter }}</p>
                             </div>
                             @if ($item->status_diperiksa == 'belum diperiksa')
                                 <div class="team-view">
                                     <a href="{{ route('dokter-spesialis.periksa-pasien', $item->periksa_dokter_id) }}"
                                         class="btn btn-round btn-outline-light w-150px"><span>Periksa
                                             Pasien </span><em class="icon ni ni-arrow-right-round-fill"></em></a>
                                 </div>
                             @else
                                 <div class="team-view">
                                     <a href="{{ route('dokter-spesialis.periksa-pasien', $item->periksa_dokter_id) }}"
                                         class="btn btn-round btn-outline-light w-150px"><span
                                             class="ml-4 ">Lihat </span><em
                                             class="icon ni ni-arrow-right-round-fill"></em></a>
                                 </div>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
         @empty
             <div class="col-sm-6 col-lg-4 col-xxl-3 offset-lg-4">
                 <h4>Belum ada pasien</h4>
             </div>
         @endforelse
     </div>
 </div>

 @if ($data->count() > 0)
     <div class="nk-block-between-md mt-5 justify-content-center d-flex">
         <div class="g">
             {{ $data->links('components.pagination') }}
         </div>
     </div>
 @endif
