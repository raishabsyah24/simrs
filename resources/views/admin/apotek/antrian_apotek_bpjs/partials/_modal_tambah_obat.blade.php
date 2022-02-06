<div class="modal fade show modalTambahObat">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Obat</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.antrian') }}" method="post" 
                            class="form-validate is-alter" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="periksa_dokter_id" value="{{ $pasien->periksa_dokter_id }}">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="">Nama Obat</label>
                                <div class="form-control-wrap">
                                    <select class="select2obat form-control" name="obat_apotek_id">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="">Jumlah</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="jumlat" name="jumlah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 offset-lg-5 mt-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Developed By IT Developer PT PMU.</span>
            </div>
        </div>
    </div>
</div>