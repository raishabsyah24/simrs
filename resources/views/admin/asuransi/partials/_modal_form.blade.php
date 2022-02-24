<div class="modal fade modal-asuransi zoom">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Perusahaan Asuransi</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="form-label">Nama Asuransi / Perusahaan Asuransi<span
                                class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="nama_asuransi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Telpon<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="no_telpon_asuransi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Handphone</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="no_hp_asuransi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control" name="email_asuransi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <textarea name="alamat_asuransi" class="form-control" cols="10" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" onclick="submitAsuransi(this.form)"
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
