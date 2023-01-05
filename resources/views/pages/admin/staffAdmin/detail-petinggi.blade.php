@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 
 <div class="content-wrapper ">

     <div class="container">
          <div class="topbar d-flex justify-content-between ">
               <div class="topbar-title">
                    <h5>Detail Data Petinggi</h5>
                    <span>Manage data for growth</span>
               </div>
          </div>

              {{-- breadcrumb --}}
     <nav aria-label="breadcrumb" class="nav-breadcrumb mt-3">   
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('petinggiYLPI.index') }}">Data Petinggi YLPI</a></li>
          <li class="breadcrumb-item" aria-current="page">Detail Petinggi YLPI</li>
          </ol>
     </nav>
   {{-- breadcrumb --}}
   <div class="content-detail-user">
     <div class="row ">
          <div class="col-md-4">
            <div class="user-pegawai p-4">
                 <img src="{{ asset('storage/assets/foto/' . $petinggiDetails->foto) }}" alt="" class="rounded-circle">
            </div>
          </div>
          <div class="col-md-6">
               <div class="nama-pegawai">
                    <h2>{{ $petinggiDetails->nama_petinggi }}</h2>
               </div>
             <div class=" row detail-pegawai">
               <div class="col-md-6">
                  <ul>
                       <li>
                         <span>NPK</span> <span>:</span>
                         <span> {{ $petinggiDetails->npk }}</span>
                      </li>
                      <li>
                         <span>Email</span> 
                         <span>:</span>
                         <span>{{ $petinggiDetails->email }}</span>
                      </li>
                     
                       <li><span>Tanggal Lahir</span> 
                         <span>:</span>
                         <span>{{ $petinggiDetails->tgl_lahir }}</span>
                    </li>
                       <li>
                            <span>Tempat Lahir</span> 
                            <span>:</span>
                            <span>{{ $petinggiDetails->tmp_lahir }}</span>
                         </li>
                     
                      
                  </ul>
               </div>
               <div class="col-md-6">
                 <ul>
                      <li>
                           <span>Golongan</span> 
                           <span>:</span>
                           <span>{{ $petinggiDetails->golongan->nama_golongan }}</span>
                         </li>
                     
                         <li>
                              <span>Pangkat</span> 
                              <span>:</span>
                              <span>{{ $petinggiDetails->pangkat->nama_pangkat }}</span>
                            </li>
                      <li>
                           <span>Tanggal SK</span> <span>:</span>
                           <span>{{ $petinggiDetails->tgl_sk }}</span>
                    </li>

                    
                   
                     
                 </ul>
               </div>
             </div>
              
          </div>
     </div>
     <div class="row mt-5">
          <div class="col-md-4"></div>
          <div class="col deskripsi-content">
               <h4>Deskripsi</h4>
               <p>{{ $petinggiDetails->deskripsi }}</p>
          </div>
          
        {{-- END content --}}
      </div>
   </div>



   
     </div>

   

   

   {{-- content --}}
   
   
  
 
   
 
  

    
 @endsection

 