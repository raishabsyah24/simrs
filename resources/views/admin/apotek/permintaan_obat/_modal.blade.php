<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PERMINTAAN OBAT APOTEK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form class="image-upload" method="post" action="{{route('ns.permintaan-input')}}" enctype="multipart/form-data">
                    @csrf

                   <div class="row">
                       <div class="col-md-6 mb-3">
                       <div class="form-group">
                        <label>No Permintaan</label>
                        <input type="text" name="no_permintaan" id="name" class="form-control"/>
                    </div>
                </div>
                       <div class="col-md-6 mb-3">
                       <div class="form-group">
                        <label>Nama Unit</label>
                        <input type="text" name="nama_unit" id="name" class="form-control"/>
                    </div>
                </div>
            </div>
                   
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <div class="form-group">
                        <label  for="default-1-03">Jenis Permintaan</label>
                        <input type="text" class="form-control" id="default-1-03" disabled value="OBAT">
                    </div>

                    
                        </div>
                        <div class="col-md-6 mb-3">
                        <div class="form-group">
                        <label>Item Permintaan</label>
                        <input type="text" name="item_permintaan" id="name" class="form-control"/>
                    </div>  
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                        
                        <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" id="name" class="form-control"/>
                    </div>  

                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label  for="default-1-03">Stok Lama</label>
                        <input type="text" class="form-control" id="default-1-03" disabled value="20">
                    </div>

                </div>
                    </div>
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Masukan nama obat<span
                            class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input
                                onkeyup="searchObat(`{{route('gudang.po-obat')}}`,this)"
                                class="form-control form-control-lg"
                                name="obat" placeholder="Masukan nama obat"
                                autocomplete="off">
                                <div class="dropdown-obat"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th class="text-left">Jumlah</th>
                                <th class="text-center">Harga Obat</th>
                                <th>Subtotal</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="data-obat">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>