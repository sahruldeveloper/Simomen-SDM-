<div class="modal fade editJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form action="<?= route('update.jurusan.details') ?>"   method="post" id="update-jurusan-form">
                     @csrf
                     <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="kode_jurusan_id"  >
                        <span class="text-danger error-text jurusan_kode_error" id="jurusan_kode_error"></span>
                    </div>
                     <div class="form-group">
                        {{-- <label for="">Kode Jurusan</label> --}}
                        <input type="hidden" class="form-control" name="kode_jurusan"  placeholder="Enter jurusan kode">
                        <span class="text-danger error-text jurusan_kode_error" id="jurusan_kode_error"></span>
                    </div>
                      <div class="form-group">
                          <label for="">Nama Jurusan</label>
                          <input type="text" class="form-control" name="nama_jurusan"  placeholder="Enter jurusan name">
                          <span class="text-danger error-text jurusan_name_error" id="jurusan_name_error"></span>
                      </div>

                      <div class="form-group">
                        <label for="">Fakultas</label>
                      
                        <select class="form-select" name="kode_fakultas" id="kode_Getfakultas_select" aria-label="Default select example">
                           
                          </select>
                        <span class="text-danger error-text fakultas_name_error" id="fakultas_name_error"></span>
                    </div>
                      
                    
                      <div class="form-group">
                          <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                      </div>
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>