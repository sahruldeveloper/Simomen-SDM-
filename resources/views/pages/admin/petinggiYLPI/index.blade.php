@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 <div class="content-wrapper ">

 
   <!-- main  -->
    <div class="container my-3">
      <div class="topbar ">
        <!-- <div class="toggle">
             <ion-icon name="menu"></ion-icon>
        </div> -->
        <div class="topbar-title">
             <h5>Data Petinggi YLPI</h5>
             <span>Manage data for growth</span>
        </div>
    
        
       </div>
     
      <div class="row mt-5 mb-3">
        <div class="col-md-5 ">
          <form action="{{ route('petinggiYLPI.index')}}">
            <div class="input-group mb-3">
              <input type="search" class="form-control" name="search" placeholder="Search.." >
              <button class="btn btn-outline-success" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
        </div>

        <div class="col-md-7 text-end">
          <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-petinggi">Tambah data</a>
        </div>
        
       
      </div>
  {{-- !-- MULAI MODAL FORM TAMBAH/EDIT--> --}}
  <div class="modal fade" id="tambah-modal-petinggi" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" name="form-tambah-petinggi" action="{{route('petinggiYLPI.store') }}"  id="form-tambah-petinggi" method="post"  class="form-horizontal" >
                  @csrf

                  <div class="row">
                    <span>Kategori</span>
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input  select" type="radio" value="Pegawai YLPI" name="kategori" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Pegawai YLPI
                        </label>
                      </div>
                     
                    </div>
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="Non Pegawai YLPI" name="kategori" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Non Pegawai YLPI
                        </label>
                      </div>
                    </div>
                  </div>
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control p-2" id="npk_petinggi" name="npk"
                          value="" placeholder="Npk" >
                         
                      <span class="text-danger error-text kode-error" id="npkPetinggiCheck"></span>
                      </div>
                          <span class="text-optional">*Optional</span>
                      </div>
                    
                    </div>

                    <div class="row mb-2">
    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="email" class="form-control" id="email_petinggi" name="email"
                          value="" placeholder="Email" >
    
                        <span class="text-danger error-text kode-error" id="emailPetinggiCheck"></span>
                      </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control p-2" id="nama_petinggi" name="nama"
                          value="" placeholder="Nama">
    
                        <span class="text-danger error-text kode-error" id="namaPetinggiCheck"></span>
                      </div>
                      </div>
                    </div>
                    <div class="row mb-2">
    
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="password" class="form-control" id="password" name="password"
                          value="" placeholder="Password" >
    
                        <span class="text-danger error-text kode-error" id="passwordPetinggiCheck"></span>
                      </div>
                      </div>
                    </div>

                    <div class="row mb-2">
    
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" id="jabatan_struktural" name="jabatan_struktural"
                          value="" placeholder="Jabatan Struktural" >
    
                        <span class="text-danger error-text kode-error" id="jabatan_strukturalPetinggiCheck"></span>
                      </div>
                      </div>
                    </div>

                    <div class="row mb-2">
    
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" id="pendidikan_petinggi" name="pendidikan"
                          value="" placeholder="Pendidikan Terakhir" >
    
                        <span class="text-danger error-text kode-error" id="pendidikanPetinggiCheck"></span>
                      </div>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" id="tmp_lahir_petinggi" name="tmp_lahir"
                          value="" placeholder="Tempat Lahir" >
    
                        <span class="text-danger error-text kode-error" id="tmp_lahirlPetinggiCheck"></span>
                      </div>
                      </div>
                    </div>

                    <div class="row mb-2">
    
                     
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="" class="label-input">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="tgl_lahir_petinggi" name="tgl_lahir"
                          value="" >
                        <span class="text-danger error-text kode-error" id="tgl_lahirPetinggiCheck"></span>
                      </div>
                      </div>

                    
                      <div class="col-sm-4">
                        <label for="" class="label-input">Jenis Kelamin</label>
                        <select class="form-select" id="jenkel_petinggi" name="jenis_kelamin" aria-label="Default select example">
                          <option selected>Jenis Kelamin</option>
                          <option value="pria">Pria</option>
                          <option value="wanita">Wanita</option>
                        
                        </select>
                        <span class="text-danger error-text kode-error" id="jenis_kelaminPetinggiCheck"></span>
                      </div>
                    </div>

                    

                  
                 

                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="foto">Foto</label>
                          <input type="file" class="form-control" id="file_foto_petinggi" name="foto" >
                       
                      </div>
                      </div>
                      <span class="text-danger error-text kode-error" id="fotoPetinggiCheck"></span>
                    </div>

                    <div class="row">
                      <div class="col-sm-offset-2 col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-petinggi"
                            value="create">Simpan Data Petinggi
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


    <div class="table-responsive">
      <table class="table table-borderless table-data align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Pangkat/Golongan</th>
        
            <th>Umur</th>
         
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($petinggi as $data)
           
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img src="{{ asset('storage/assets/foto/' . $data->foto) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle">
                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{$data->npk == null ? '-' : $data->npk }}</p>
                    <p class="text-muted mb-0">{{ $data->nama == '' ? $data->pegawai->nama :  $data->nama }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                  
                    <p class="fw-bold mb-1">{{$data->pegawai == '' ? '-' : $data->pegawai->pangkat->nama_pangkat }}</p>
                    <p class="fw-bold mb-1">{{$data->pegawai == null ? '-' : $data->pegawai->golongan->nama_golongan }}</p>
                   
                  </div>
                </div>
              </td>
              <td>{{ $data->umur }}</td>
              <td>{{ $data->kategori}}</td>
             
           
              </td>
             
              
             
              <td>
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-petinggi"><i class="far fa-edit"></i> Edit</a>
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Hapus" class="edit btn btn-danger btn-sm" " id="deletePetinggiBtn"><i class="far fa-edit"></i> Hapus</a>
             
                <a href="{{ route('petinggiYLPI.show', $data->id) }}" data-toggle="tooltip" data-original-title="Detail" class="detail btn btn-secondary text-white btn-sm detail-post-pegawai"><i class="far fa-edit"></i> Detail</a>
              </td>
            </tr>
          
            @empty
                
            @endforelse
          
         


        
         
        </tbody>
      </table>
      {{ $petinggi->links()}}
    </div>
       
     
     </div>
   
     <!-- content -->
</div>
    <!-- main  -->

    <!-- Modal -->
    <div class="modal fade editPetinggi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Petinggi YLPI</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                   <form    method="post" action="<?= route('update.petinggi.details') ?>"    id="update-petinggi-form">
                      @csrf
                      <div class="form-group">
                        
                       <input type="hidden" class="form-control" name="id">
                      
                   </div>
                      <div class="row mb-2">
                         <div class="col-sm-6">
                           <div class="form-group">
                             <input type="text" class="form-control p-2" id="npk" name="npk"
                             value="" placeholder="Npk" >
                             {{-- <small id="kodeCheck" class="form-text
                           text-muted invalid-feedback">
                            
                         </small> --}}
                         <span class="text-danger error-text kode-error" id="npkPetinggiCheckEdit"></span>
                         </div>
                         </div>
                         <div class="col-sm-6">
                           <div class="form-group">
                             <input type="text" class="form-control p-2" id="nama_petinggi" name="nama"
                             value="" placeholder="Nama" >
       
                           <span class="text-danger error-text kode-error" id="namaPetinggiCheckEdit"></span>
                         </div>
                         </div>
                       </div>
   
                       <div class="row mb-2">
       
                         <div class="col-sm-12">
                           <div class="form-group">
                             <input type="email" class="form-control" id="email" name="email"
                             value="" placeholder="Email" >
       
                           <span class="text-danger error-text kode-error" id="emailPetinggiCheckEdit"></span>
                         </div>
                         </div>
                       </div>

                       <div class="row mb-2">
    
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password"
                            value="" placeholder="Password" readonly>
      
                          <span class="text-danger error-text kode-error" id="passwordPetinggiCheckEdit"></span>
                        </div>
                        </div>
                      </div>
   
                       <div class="row mb-2">
                         <div class="col-sm-12">
                           <div class="form-group">
                             <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                             value="" placeholder="Tempat Lahir" >
       
                           <span class="text-danger error-text kode-error" id="tmp_lahirlPetinggiCheckEdit"></span>
                         </div>
                         </div>
                       </div>

                       <div class="row mb-2">
    
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="pendidikan" class="form-control" id="pendidikan" name="pendidikan"
                            value="" placeholder="Pendidikan Terakhir" >
      
                          <span class="text-danger error-text kode-error" id="pendidikanPetinggiCheckEdit"></span>
                        </div>
                        </div>
                      </div>
   
                       <div class="row mb-2">
       
                        
                         <div class="col-sm-4">
                           <div class="form-group">
                             <label for="" class="label-input">Tanggal Lahir</label>
                             <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                             value="" >
                           <span class="text-danger error-text kode-error" id="tgl_lahirPetinggiCheckEdit"></span>
                         </div>
                         </div>
   
                         
                         <div class="col-sm-4">
                           <label for="" class="label-input">Jenis Kelamin</label>
                           <select class="form-select" id="JenisKelaminPetinggiSelect"  name="jenis_kelamin" aria-label="Default select example">
                             {{-- <option selected>Jenis Kelamin</option>
                             <option value="pria">Pria</option>
                             <option value="wanita">Wanita</option> --}}
                           
                           </select>
                           <span class="text-danger error-text kode-error" id="jenis_kelaminPetinggiCheckEdit"></span>
                         </div>
                       </div>
   
   
                       <div class="row mb-2">
                         <div class="col-sm-6">
                           <div class="form-group">
                             <label for="foto">Foto</label>
                             <input type="file" class="form-control" name="foto">
                          
                         </div>
                         </div>
   
                       </div>
   
                       
                     
                       <div class="form-group">
                           <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                       </div>
                   </form>
                  
    
              </div>
          </div>
      </div>
    </div>

    
   

 @endsection