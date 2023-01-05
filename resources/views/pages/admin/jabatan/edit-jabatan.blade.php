<div class="modal fade editJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form action="<?= route('update.jabatan.details') ?>"  method="post"   id="update-jabatan-form">
                     @csrf
                     <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="kode_jabatan_id"  placeholder="Enter jabatan kode">
                        <span class="text-danger error-text jabatan_kode_error" id="jabatan_kode_error"></span>
                    </div>
                     <div class="form-group">
                        {{-- <label for="">Kode Jabatan</label> --}}
                        <input type="hidden" class="form-control" name="kode_jabatan"  placeholder="Enter jabatan kode">
                        <span class="text-danger error-text jabatan_kode_error" id="jabatan_kode_error"></span>
                    </div>
                      <div class="form-group">
                          <label for="">Nama Jabatan</label>
                          <input type="text" class="form-control" name="nama_jabatan"  placeholder="Enter jabatan name">
                          <span class="text-danger error-text jabatan_name_error" id="jabatan_name_error"></span>
                      </div>
                     
                    
                      <div class="form-group">
                          <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                      </div>
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>