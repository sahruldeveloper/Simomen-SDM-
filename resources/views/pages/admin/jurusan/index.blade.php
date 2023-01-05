@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 <div class="content-wrapper">
   
 
   <!-- main  -->
    <div class="container my-3">
      <div class="topbar ">
        <!-- <div class="toggle">
             <ion-icon name="menu"></ion-icon>
        </div> -->
        <div class="topbar-title">
             <h5>Data Jurusan</h5>
             <span>Manage data for growth</span>
        </div>

        <div class="row">
          <div class="col-6 mt-5">
            <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-jurusan"><i class="far fa-add"></i> Tambah data</a>
            
          </div>
        </div>
       
        
       </div>
     
      <div class="row mt-3">
        
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table  table-data align-middle" id="tabel_jurusan">
              <thead>
                <tr>
                  {{-- <th>Kode Jurusan</th> --}}
                  <th>Nama Jurusan</th>
                  {{-- <th>Kode Fakultas</th> --}}
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
  <div class="modal fade" id="tambah-modal-jurusan" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-jurusan" name="form-tambah-jurusan" class="form-horizontal">
                  @csrf
                    <div class="row">
                        <div class="col-sm-12">

                          <div class="form-group">
                              {{-- <label for="kode_jurusan" class="col-sm-12 control-label">Kode Jurusan</label> --}}
                              <div class="col-sm-12">
                                  <input type="hidden" class="form-control" id="kode_jurusan" name="kode_jurusan"
                                      value="{{$id}}" required>
                                      {{-- <small id="kodeCheck" class="form-text
                                    text-muted invalid-feedback">
                                     
                                  </small> --}}
                                  <span class="text-danger error-text kode-error" id="kodeJurusanCheck"></span>
                              </div>
                          </div>

                            <div class="form-group mt-3">
                                <label for="nama_jurusan" class="col-sm-12 control-label">Nama Jurusan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan"
                                        value="" required>
                                    {{-- <small id="namaCheck" class="form-text
                                        text-muted invalid-feedback">
                                          
                                      </small> --}}
                                      <span class="text-danger error-text nama-error" id="namaJurusanCheck"></span>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                              <label for="kode_fakultas" class="col-sm-12 control-label">Fakultas</label>
                              <div class="col-sm-12">
                               
                                <select class="form-select" name="kode_fakultas" id="kode_fakultas_select" aria-label="Default select example">
                                  <option value="">Pilih Fakultas</option>
                                  @foreach ($fakultas as $item)
                                      <option value="{{ $item->kode_fakultas }}">{{ $item->nama_fakultas }}</option>
                                  @endforeach
                                 
                                </select>
                                    <span class="text-danger error-text nama-error" id="namaSelectFakultasCheck"></span>
                              </div>
                          </div>

              
                        </div>

                        <div class="col-sm-offset-2 col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-jurusan"
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
 

 