<div class="modal fade modal-periksa zoom">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="form-label">Tinggi Badan (cm)<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="tb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Berat Badan (kg)<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="bb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tekanan Darah <span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="td">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Suhu (derajat)<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="su">
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
