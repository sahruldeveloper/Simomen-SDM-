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
             <h5>Data Golongan</h5>
             <span>Manage data for growth</span>
        </div>
        
        <div class="row text-end mt-3">
          <div class="col-12 ">
            <a href="javascript:void(0)" class="btn btn-success btn-sm-3 btn-md-4" id="tombol-tambah-golongan"><i class="far fa-add"></i> Tambah data</a>
          </div>
       
        </div>
       </div>
     
     <div class=" mt-3">  
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table  table-data align-middle" id="tabel_golongan">
              <thead>
                <tr>
                
                  <th>Nama Golongan</th>
                  <th>Keterangan</th>
                  {{-- <th>Pangkat</th> --}}
                
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
  <div class="modal fade" id="tambah-modal-golongan" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-golongan" name="form-tambah-golongan" class="form-horizontal">
                  @csrf
                    <div class="row">
                        <div class="col-sm-12">

                          <div class="form-group">
                              {{-- <label for="kode_golongan" class="col-sm-12 control-label">Kode Golongan</label> --}}
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="kode_golongan" name="kode_golongan"
                                      value="{{$id}}" required>
                                      {{-- <small id="kodeCheck" class="form-text
                                    text-muted invalid-feedback">
                                     
                                  </small> --}}
                                  <span class="text-danger error-text kode-error" id="kodeGolonganCheck"></span>
                              </div>
                          </div>

                            <div class="form-group mt-3">
                                <label for="nama_golongan" class="col-sm-12 control-label">Nama Golongan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_golongan" name="nama_golongan"
                                        value="" required>
                                    {{-- <small id="namaCheck" class="form-text
                                        text-muted invalid-feedback">
                                          
                                      </small> --}}
                                      <span class="text-danger error-text nama-error" id="namaGolonganCheck"></span>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                              <label for="keterangan" class="col-sm-12 control-label">Keterangan</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="keterangan" name="keterangan"
                                      value="" required>
                                  {{-- <small id="namaCheck" class="form-text
                                      text-muted invalid-feedback">
                                        
                                    </small> --}}
                                    <span class="text-danger error-text nama-error" id="keteranganCheck"></span>
                              </div>
                          </div>
                          <div class="form-group mt-3">
                            <label for="nama_pangkat" class="control-label">Pangkat</label>
                            <div class="col-sm-6">
                           <select name="kode_pangkat" id="" class="form-select" aria-label="Default select example">
                                <option selected>Pilih Pangkat</option>
                                @foreach ($pangkat as $item)
                                    <option value="{{ $item->kode_pangkat }}">{{ $item->nama_pangkat }}</option>
                                @endforeach
        
                              </select>
                              <span class="text-danger error-text kode-error" id="kode_fakultasDosenCheckAdd"></span>
                            </div>
                          </div>
                         


              
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
 

 