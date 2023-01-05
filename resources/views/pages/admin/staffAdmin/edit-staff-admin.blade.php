<div class="modal fade editStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Staff Admin</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form   action="<?= route('update.staff') ?>"  method="post"     id="update-staff-form">
                     @csrf
                     <div class="form-group">
                       
                      <input type="hidden" class="form-control" name="id">
                     
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control p-2" id="nama" name="nama"
                      value="" placeholder="Nama" >
                      <span class="text-danger error-text kode-error" id="namaStaffCheckEdit"></span>
                    </div>
                    <div class="form-group mt-2">
                      <input type="email" class="form-control" id="email" name="email"
                      value="" placeholder="Email" >

                    <span class="text-danger error-text kode-error" id="emailStaffCheckEdit"></span>
                    </div>
                    <div class="form-group mt-2">
                      <input type="password" class="form-control"  name="password"
                       >
                      <span class="text-danger error-text kode-error" id="passwordStaffCheckEdit"></span>
                    </div>
                 
                 
                  
                  <br>
                  <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-staff"
                  value="create">Simpan Data Staff Admin
                
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>