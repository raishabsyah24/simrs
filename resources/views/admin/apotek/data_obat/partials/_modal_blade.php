<div class="modal fade show modal-obat" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block">
                    <div class="card-inner">
                        <form action="#">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Nama Obat</label>
                                        <div class="form-control-wrap">
                                            <select name="" id="" class="form-control"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Jumlah</label>
                                        <div class="form-control-wrap number-spinner-wrap">
                                            <button onclick="minus()" class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                            <input type="number" class="form-control number-spinner" value="0" name="jumlah" id="jumlah" required="">
                                            <button onclick="plus()" class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no-1">Komposisi</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="phone-no-1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="pay-amount-1">Satuan</label>
                                        <select class="form-control" name="" id=""></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Stok</label>
                                        <div class="form-control-wrap number-spinner-wrap">
                                            <button onclick="minus()" class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                            <input type="number" class="form-control number-spinner" value="0" name="" id="" required="">
                                            <button onclick="plus()" class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Min Stok</label>
                                        <div class="form-control-wrap number-spinner-wrap">
                                            <button onclick="minus()" class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                            <input type="number" class="form-control number-spinner" value="0" name="" id="" required="">
                                            <button onclick="plus()" class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Modal Footer Text</span>
            </div>
        </div>
    </div>
</div>