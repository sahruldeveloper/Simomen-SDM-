<div class="modal fade editGolongan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Golongan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form  action="<?= route('update.golongan.details') ?>"  method="post"   id="update-golongan-form">
                     @csrf
                     <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="kode_golongan_id"  placeholder="Enter golongan kode">
                        <span class="text-danger error-text golongan_kode_error" id="golongan_kode_error"></span>
                    </div>
                     <div class="form-group">
                        {{-- <label for="">Kode Golongan</label> --}}
                        <input type="hidden" class="form-control" name="kode_golongan"  placeholder="Enter golongan kode">
                        <span class="text-danger error-text golongan_kode_error" id="golongan_kode_error"></span>
                    </div>
                      <div class="form-group">
                          <label for="">Nama Golongan</label>
                          <input type="text" class="form-control" name="nama_golongan"  placeholder="Enter golongan name">
                          <span class="text-danger error-text golongan_name_error" id="golongan_name_error"></span>
                      </div>
                      <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan"  placeholder="Enter keterangan golongan">
                        <span class="text-danger error-text golongan_name_error" id="golongan_keterangan_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Pangkat</label>
                        <select class="form-select" name="kode_pangkat" id="Getpangkat_select" aria-label="Default select example">
                           
                          </select>
                        <span class="text-danger error-text pangkat_name_error" id="pangkat_name_error"></span>
                    </div>
                   
                      
                    
                      <div class="form-group mt-2">
                          <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                      </div>
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>