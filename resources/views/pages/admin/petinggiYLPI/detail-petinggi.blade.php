@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 
 
<div class="content-wrapper">
     <div class="container">
      {{-- breadcrumb --}}
      <nav aria-label="breadcrumb" class="nav-breadcrumb mt-3">   
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('petinggiYLPI.index') }}">Data Petinggi YLPI</a></li>
          <li class="breadcrumb-item" aria-current="page">Detail Petinggi YLPI</li>
          </ol>
     </nav>
      {{-- breadcrumb --}}
      <div class="content-detail-user">
       <div class="row">
         {{-- section profile --}}
         <div class="col-md-4 detail-pegawai">
           <div class="card text-center">
             {{-- content --}}
             <img src="{{ asset('storage/assets/foto/' . $petinggiDetails->foto) }}" alt="" class="rounded-circle mt-2" >
             <div class="card-body">
               <h5 class="card-title text-center">{{ $petinggiDetails->nama }}</h5>
               <ul>
                  <li>Email <span>:</span> {{ $petinggiDetails->email }}</li>
                  {{-- <li>Umur : {{ $petinggiDetails->pegawai->umur }}</li> --}}
                  <li>Tanggal Lahir : {{ $petinggiDetails->tgl_lahir }}</li>
                  <li>Tempat Lahir : {{ $petinggiDetails->tmp_lahir }}</li>
               </ul>
             </div>
             {{-- content --}}
           </div>
         </div>
         {{-- section profile --}}
   
         {{-- section kepegawaisn --}}
         <div class="col-md-8">
           <div class="card">
             <div class="card-header text-center">Kepegawaian</div>
             <div class="card-body">
               <div class="row">
                 <div class="col-md-6">
                   <table class="table table-borderless">
                     <tr>
                       <th>NIDN</th>
                       <td>:</td>
                       <td>  @php
                         if($petinggiDetails->pegawai->nidn == null){
                            echo "-";
                          }else{
                            echo"  <span class='fw-bold mb-1'>$petinggiDetails->nidn</span>";
                          } 
                    @endphp</td>
                     </tr>
                     <tr>
                       <th>NPK</th>
                       <td>:</td>
                       <td>    @php
                         if($petinggiDetails->npk == null){
                            echo "-";
                          }else{
                            echo"  <span class='fw-bold mb-1'>$petinggiDetails->npk</span>";
                          } 
                         @endphp
                       </td>
                     </tr>
                     {{-- <tr>
                       <th>Jabatan Fungsional</th>
                       <td>:</td>
                       <td> {{ $petinggiDetails->pegawai->kode_jabatan == null ? '-' : $petinggiDetails->pegawai->jabatan->nama_jabatan }}</td>
                     </tr> --}}
                     {{-- <tr>
                       <th>Pangkat</th>
                       <td>:</td>
                       <td>{{  $petinggiDetails->pegawai->kode_pangkat == null ? '-' : $petinggiDetails->pegawai->pangkat->nama_pangkat    }}</td>
                     </tr> --}}
                     {{-- <tr>
                       <th>Golongan</th>
                       <td>:</td>
                       <td>{{$petinggiDetails->pegawai->kode_golongan == null ? '-' : $petinggiDetails->pegawai->golongan->nama_golongan   }}</td>
                     </tr> --}}
                    
                   </table>
                 </div>
                 <div class="col-md-6">
                   <table class="table table-borderless">
                     <tr>
                       <th>Kategori</th>
                       <td>:</td>
                       <td>{{$petinggiDetails->kategori }}</td>
                     </tr>
                     <tr>
                       <th>Jabatan Struktural</th>
                       <td>:</td>
                       <td>{{ $petinggiDetails->jabatan_struktural}}</td>
                     </tr>
                     
                    
                     
                   </table>
                 </div>
               </div>
             </div>
           </div>
         </div>
         {{-- section kepegawaisn --}}
       
       </div>
   
       {{-- unit kerja --}}
    
       {{-- unit kerja --}}
      </div>
     </div>
    </div>   
  
 
   
 
  

    
 @endsection

 