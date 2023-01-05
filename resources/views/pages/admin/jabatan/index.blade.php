@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 <div class="content-wrapper ">
   
 
   <!-- main  -->
    <div class="container my-3">
      <div class="topbar">
        <!-- <div class="toggle">
             <ion-icon name="menu"></ion-icon>
        </div> -->
        <div class="topbar-title">
             <h5>Data Jabatan</h5>
             <span>Manage data for growth</span>
        </div>
        
        
       </div>
       <div class="row mt-5">
        <div class="col-sm-12 justify-content-end">
          <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-jabatan"><i class="far fa-add"></i> Add</a>
        </div>
       </div>
     
      <div class="row mt-3">
        
        <div class="col-md-12 col-12">
        <div class="table-responsive">
          <table class="table  table-data align-middle" id="tabel_jabatan">
            <thead>
              <tr>
              
                {{-- <th>Kode Jabatan</th> --}}
                <th>Jabatan</th>
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
  <div class="modal fade" id="tambah-modal-jabatan" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-jabatan" name="form-tambah-jabatan" class="form-horizontal">
                  @csrf
                    <div class="row">
                        <div class="col-sm-12">

                          <div class="form-group">
                              {{-- <label for="kode_jabatan" class="col-sm-12 control-label">Kode Jabatan</label> --}}
                              <div class="col-sm-12">
                                  <input type="hidden" class="form-control" id="kode_jabatan" name="kode_jabatan"
                                      value="{{$id}}" placeholder="Masukan kode jabatan" required>
                                      {{-- <small id="kodeCheck" class="form-text
                                    text-muted invalid-feedback">
                                     
                                  </small> --}}
                                  <span class="text-danger error-text kode-error" id="kodeJabatanCheck"></span>
                              </div>
                          </div>

                            <div class="form-group mt-3">
                                <label for="nama_jabatan" class="col-sm-12 control-label">Nama Jabatan Fungsional</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                        value="" placeholder="Masukan nama jabatan" required>
                                    {{-- <small id="namaCheck" class="form-text
                                        text-muted invalid-feedback">
                                          
                                      </small> --}}
                                      <span class="text-danger error-text nama-error" id="namaJabatanCheck"></span>
                                </div>
                            </div>

                            {{-- <div class="form-group mt-3">
                              <label for="kode_golongan" class="col-sm-12 control-label">Golongan</label>
                              <div class="col-sm-12">
                               
                                <select class="form-select" name="kode_golongan" id="kode_golongan_select" aria-label="Default select example">
                                  <option value="">Pilih golongan</option>
                                  @foreach ($golongan as $item)
                                      <option value="{{ $item->kode_golongan }}">{{ $item->nama_golongan  }} - {{$item->kategori}}</option>
                                  @endforeach
                                 
                                </select>
                                    <span class="text-danger error-text nama-error" id="namaSelecJabatantCheck"></span>
                              </div>
                          </div> --}}

                          

              
                        </div>

                        <div class="col-sm-offset-2 col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
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
 

 