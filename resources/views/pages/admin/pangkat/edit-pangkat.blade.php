<div class="modal fade editPangkat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form action="<?= route('update.pangkat.details') ?>"    method="post"   id="update-pangkat-form">
                     @csrf
                     <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="kode_pangkat_id"  placeholder="Enter pangkat kode">
                        <span class="text-danger error-text pangkat_kode_error" id="pangkat_kode_error"></span>
                    </div>
                     <div class="form-group">
                        {{-- <label for="">Kode Pangkat</label> --}}
                        <input type="hidden" class="form-control" name="kode_pangkat"  placeholder="Enter pangkat kode" readonly>
                        <span class="text-danger error-text pangkat_kode_error" id="pangkat_kode_error"></span>
                    </div>
                      <div class="form-group">
                          <label for="">Nama Pangkat</label>
                          <input type="text" class="form-control" name="nama_pangkat"  placeholder="Enter pangkat name">
                          <span class="text-danger error-text pangkat_name_error" id="pangkat_name_error"></span>
                      </div>
                    
                      <div class="form-group mt-2">
                        <label for="">Jabatan</label>
                      
                        <select class="form-select" name="kode_jabatan" id="kode_Getjabatan_select" aria-label="Default select example">
                           
                          </select>
                        <span class="text-danger error-text jabatan_name_error" id="jabatan_name_error"></span>
                    </div>

                    {{-- <div class="form-group mt-2">
                        <label for="">Golongan</label>
                      
                        <select class="form-select" name="kode_golongan" id="kode_Getgolongan_select" aria-label="Default select example">
                           
                          </select>
                        <span class="text-danger error-text golongan_name_error" id="golongan_name_error"></span>
                    </div> --}}

                   

                
                   
                     
                    
                      <div class="form-group mt-2">
                          <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                      </div>
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>