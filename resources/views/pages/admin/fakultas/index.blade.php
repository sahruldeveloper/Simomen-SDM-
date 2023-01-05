@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 <div class="content-wrapper ">
   
 
   <!-- main  -->
    <div class="container">

      <div class="row">
        <div class="topbar ">
          <!-- <div class="toggle">
              <ion-icon name="menu"></ion-icon>
          </div> -->
         
          <div class="topbar-title">
              <h5>Data Fakultas</h5>
              <span>Manage data for growth</span>
          </div>
          <div class="row mt-5">
            <div class="col-sm-12 justify-content-end">
              <a href="javascript:void(0)" class="btn btn-success btn-sm ml-1" id="tombol-tambah-fakultas"><i class="far fa-add"></i> Tambah data</a>
              
            </div>
           </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table  table-data   align-middle" id="tabel_fakultas">
              <thead>
                <tr>
                
                 
                  <th>Nama Fakultas</th>
                  <th>Aksi</th>
                
                </tr>
              </thead>
             
            </table>
          </div>
       
        </div>
      </div>



       
     
     </div>
   
     <!-- content -->
</div>
    <!-- main  -->

  
   
<!-- MULAI MODAL FORM TAMBAH/EDIT-->
  <div class="modal fade" id="tambah-modal-fakultas" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-fakultas" name="form-tambah-fakultas" class="form-horizontal">
                  @csrf
                    <div class="row">
                        <div class="col-sm-12">

                          <div class="form-group">
                              <label for="kode_golongan" class="col-sm-12 control-label">Kode Fakultas</label>
                              <div class="col-sm-12">
                                  <input type="hidden" class="form-control" id="kode_fakultas" name="kode_fakultas"
                                      value="{{$id }}" required>
                                      {{-- <small id="kodeCheck" class="form-text
                                    text-muted invalid-feedback">
                                     
                                  </small> --}}
                                  <span class="text-danger error-text kode-error" id="kodeFakultasCheck"></span>
                              </div>
                          </div>

                            <div class="form-group mt-3">
                                <label for="nama_golongan" class="col-sm-12 control-label">Nama Fakultas</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas"
                                        value="" required>
                                    {{-- <small id="namaCheck" class="form-text
                                        text-muted invalid-feedback">
                                          
                                      </small> --}}
                                      <span class="text-danger error-text nama-error" id="namaFakultasCheck"></span>
                                </div>
                            </div>

              
                        </div>

                        <div class="col-sm-offset-2 col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-fakultas"
                                value="create">Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- AKHIR MODAL -->    


{{-- Modal edit --}}

{{-- End Modal edit --}}


   

 @endsection
 

 