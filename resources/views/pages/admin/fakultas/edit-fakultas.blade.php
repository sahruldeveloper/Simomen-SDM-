<div class="modal fade editFakultas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Fakultas</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form action="<?= route('update.fakultas.details') ?>"    method="post" id="update-fakultas-form">
                     @csrf
                     <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="kode_fakultas_id"  >
                        <span class="text-danger error-text fakultas_kode_error" id="fakultas_kode_error"></span>
                    </div>
                     <div class="form-group">
                        {{-- <label for="">Kode Fakultas</label> --}}
                        <input type="hidden" class="form-control" name="kode_fakultas"  placeholder="Enter fakultas kode">
                        <span class="text-danger error-text fakultas_kode_error" id="fakultas_kode_error"></span>
                    </div>
                      <div class="form-group">
                          <label for="">Nama Fakultas</label>
                          <input type="text" class="form-control" name="nama_fakultas"  placeholder="Enter fakultas name">
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