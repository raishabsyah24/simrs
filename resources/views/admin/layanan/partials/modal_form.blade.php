 <div class="modal fade zoom modal-form modal-form" tabindex="-1">
     <div class="modal-dialog modal-dialog-top modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title"></h5>
                 <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                     <em class="icon ni ni-cross"></em>
                 </a>
             </div>
             <div class="modal-body">
                 <form method="POST">
                     @csrf
                     @method('post')
                     <div class="form-group">
                         <div class="form-control-wrap">
                             <input type="text" placeholder="Nama layanan" autocomplete="off" name="nama"
                                 class="form-control form-control-lg" id="nama">
                         </div>
                     </div>
                     <div class="form-group mt-5">
                         <div class="form-control-wrap">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon1">Rp</span>
                                 </div>
                                 <input type="number" placeholder="Harga layanan" autocomplete="off" name="tarif"
                                     class="form-control form-control-lg">
                             </div>
                         </div>
                     </div>
                     <div class="form-group mt-5">
                         <div class="form-control-wrap">
                             <select class="form-control form-control-lg" name="parent_id"
                                 data-placeholder="Pilih kategori layanan">
                                 <option label="Pilih data" disabled selected value=""></option>
                                 @foreach ($kategori_layanan as $item)
                                     <option value="{{ $item->id }}">{{ $item->nama }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="form-group mt-5">
                         <div class="form-control-wrap">
                             <textarea name="keterangan" class="form-control form-control-lg"
                                 placeholder="Keterangan / Info Lanjutan" autocomplete="off"></textarea>
                         </div>
                     </div>
                     <div class="form-group text-center">
                         <button type="submit" onclick="submitForm(this.form)"
                             class="tombol-simpan btn btn-lg btn-primary">
                             <span class="text-simpan">Simpan</span>
                             <span class="loading-simpan d-none ml-2 spinner-border spinner-border-sm" role="status"
                                 aria-hidden="true"></span>
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
