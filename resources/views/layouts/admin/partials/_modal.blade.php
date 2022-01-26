 <!-- Modal logout -->
 <div class="modal fade modal-logout" tabindex="-1" id="modalTop">
     <div class="modal-dialog modal-dialog-top" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Konfirmasi Logout</h4>
                 <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                     <em class="icon ni ni-cross"></em>
                 </a>
             </div>
             <div class="modal-body">
                 <h6>Apakah anda yakin ingin logout dari sistem?</h6>
             </div>
             <div class="modal-footer">
                 <form action="{{ route('logout') }}" method="post">
                     @csrf
                     <button data-dismiss="modal" class="btn btn-dim btn-danger">Batal</button>
                     <button class="btn btn-success">Ya, Logout</button>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal error -->
 <div class="modal fade modal-error" tabindex="-1" id="modalAlert2">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-body modal-body-lg text-center">
                 <div class="nk-modal">
                     <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                     <h4 class="nk-modal-title">Maaf, Terjadi Kesalahan</h4>
                     <div class="nk-modal-text">
                         <p class="lead"></p>
                     </div>
                     <div class="nk-modal-action mt-5">
                         <a href="#" class="btn btn-lg btn-mw btn-light" data-dismiss="modal">Ok</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
