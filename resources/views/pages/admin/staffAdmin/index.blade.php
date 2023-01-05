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
             <h5>Data Staff Administrator</h5>
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
          <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-staff"><i class="bi bi-person-plus"></i> Tambah data staff</a>
        </div>
        
       
      </div>
  {{-- !-- MULAI MODAL FORM TAMBAH/EDIT--> --}}
 
<!-- AKHIR MODAL -->   


    <div class="table-responsive">
      <table class="table table-borderless table-data align-middle">
        <thead>
          <tr >
            <th>Nama</th>
          
            <th>role</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($staff as $data)
           
            <tr>
              <td>
                <div class="d-flex align-items-center">
                 
                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{$data->nama }}</p>
                    <p class="text-muted mb-0">{{ $data->email }}</p>
                  </div>
                </div>
              </td>
       
              <td>
                <p class="fw-bold mb-1">{{ $data->role }}</p>
                {{-- <p class="text-muted fs-6 mb-0">{{ $data->kode_golongan->nama_golongan }}</p> --}}
            
              
             
              <td class="text-center">
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-staff"><i class="far fa-edit"></i> Edit</a>
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Hapus" class="edit btn btn-danger btn-sm" " id="deleteStaffBtn"><i class="bi bi-trash3"></i> Hapus</a>
          
              </td>
            </tr>
          
            @empty
                
            @endforelse
          
         


        
         
        </tbody>
      </table>
      {{-- {{ $petinggi->links()}} --}}
    </div>
       
     
     </div>
   
     <!-- content -->
</div>
    <!-- main  -->

  {{-- modal --}}
  <div class="modal fade" id="tambah-modal-staff" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" name="form-tambah-staff" action="{{route('staff-admin.store') }}" id="form-tambah-staff" method="post"  class="form-horizontal" >
                  @csrf
                     {{-- Form tambah data --}}
                     <div class="form-group">
                      <input type="text" class="form-control p-2" id="nama" name="nama"
                      value="" placeholder="Nama" >
                      <span class="text-danger error-text kode-error" id="namaStaffCheckAdd"></span>
                    </div>
                    <div class="form-group mt-2">
                      <input type="email" class="form-control" id="email" name="email"
                      value="" placeholder="Email" >

                    <span class="text-danger error-text kode-error" id="emailStaffCheckAdd"></span>
                    </div>
                    <div class="form-group mt-2">
                      <input type="password" class="form-control" id="password" name="password"
                      value="" placeholder="Password" >
                      <span class="text-danger error-text kode-error" id="passwordStaffCheckAdd"></span>
                    </div>
                 
                 
                  
                  <br>
                  <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-staff"
                  value="create">Simpan Data Staff Admin

                  {{-- Form tambah data --}}
                   
                  
                  
              </div>
                       
                                           
                    

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
  {{-- modal --}}
   

 @endsection