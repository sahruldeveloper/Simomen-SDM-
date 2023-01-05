@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 
 <div class="content-wrapper">
    
    
  <div class="container">
       
                 {{-- breadcrumb --}}
            <nav aria-label="breadcrumb" class="nav-breadcrumb mt-3">   
                 <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('halaman-pegawai-petinggi.index') }}">Data Pegawai</a></li>
                 <li class="breadcrumb-item" aria-current="page">Detail Dosen</li>
                 </ol>
            </nav>
{{-- breadcrumb --}}
<div class="content-detail-user">
 <div class="row ">
       
   <div class="col-md-5 offset-4 detail-pegawai">
        <div class="card card-biodata border-light text-center pt-4">
             <img src="{{ asset('storage/assets/foto/' . $pegawaiDetails->foto) }}" class="d-flex align-center" style="height: 70px;width: 60px; display:block; margin-left: auto;margin-right: auto;"  alt="" class="rounded-circle mt-2" >
             <div class="card-body">
               <h5 class="card-title text-center">{{ $pegawaiDetails->nama }}</h5>
               <span class="kategori-pegawai">{{ $pegawaiDetails->kategori }}</span>
               <table class="table table-borderless d-flex justify-content-center   table-biodata b=0">
                 <tr>
                   <td width="20%">Email</td>
                   <td width="2%">:</td>
                   <td>{{ $pegawaiDetails->email }}</td>
                 </tr>
                 <tr>
                   <td width="15%">Umur</td>
                   <td width="2%">:</td>
                   <td >{{ $pegawaiDetails->umur }}</td>
                 </tr>
                 <tr>
                   <td width="15%">TTL</td>
                   <td width="2%">:</td>
                   <td >{{ $pegawaiDetails->tmp_lahir    }},
                     {{$pegawaiDetails->tgl_lahir}}
                   </td>
                 </tr>
                
               </table>
              
             </div>
           </div>
   </div>
   {{-- informasi kepegawaian --}}
   <div class="row mt-4">
     <div class="col-md-12">
       <div class="card card-information card-left bg-light border-light">
         <h5 class="text-center fw-bold">Kepegawaian</h5>
         <hr class="mb-2">
         <div class="col-md-6"></div>
         <div class="col-md-6"></div>
         <table class="table table-borderless mb-2 table-kepegawaian " class="">
           <tr >
             <th width="15%">NPK</th>
             <td width="5%">:</td>
             <td>{{ $pegawaiDetails->npk == null ? '-' : $pegawaiDetails->npk }}</td>
             <th width="20%">Pangkat</th>
             <td width="5%">:</td>
             <td>{{ $pegawaiDetails->kode_pangkat == '' ? '-' : $pegawaiDetails->pangkat->nama_pangkat }}</td>
          
           </tr>
           <tr>
             @php
             // dd($pegawaiDetails->dosen->nidn);
                 if($pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)'){
                   $nidn = $pegawaiDetails->dosen->nidn == null ? '-' : $pegawaiDetails->dosen->nidn;
             $jabatan = $pegawaiDetails->kode_jabatan == null ? '-' : $pegawaiDetails->jabatan->nama_jabatan;
                   echo" <th>NIDN</th><td>:</td><td>$nidn</td><th>Jabatan</th><td>:</td><td>$jabatan</td>";
                 }
             @endphp
           
           
           
       
           </tr>
           <tr>
             <th width="20%">Status Kepegawaian</td>
             <td width="5%">:</td>
             <td>{{ $pegawaiDetails->status  }}</td>
             <th width="20%">Golongan</th>
             <td width="5%">:</td>
             <td>{{ $pegawaiDetails->kode_golongan == null ? '-' : $pegawaiDetails->golongan->nama_golongan }}</td>
           </tr>
         <tr>
           @php
           $start = Carbon\Carbon::parse($pegawaiDetails->start_tgl_sk_kontrak)->format('d-m-Y');
           $end = Carbon\Carbon::parse($pegawaiDetails->end_tgl_sk_kontrak)->format('d-m-Y');
      
           $sk_uir = $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' ? $pegawaiDetails->dosen->tgl_sk_uir : '-';
          
               if($pegawaiDetails->status == "Kontrak")
               {
                 echo"   
                   <th>Surat Kerja</th>
                   <td>:</td>
                   <td> $start</td>
           
                 ";
           }else if($pegawaiDetails->kategori =='Pegawai Akademik(Dosen)') {
                 echo" <th>Surat Kerja Uir  </th>
                 <td>:</td>
                 <td>$sk_uir</td>
                <th>Surat Kerja Yayasan  </th>
                 <td>:</td>
                 <td>$pegawaiDetails->tgl_sk_yayasan</td>
                 ";
               }
           else {
                 echo" <th>Surat Kerja Yayasan  </th>
                 <td>:</td>
                 <td>$pegawaiDetails->tgl_sk_yayasan</td>
                 ";
               }
           @endphp
             
         </tr>
         <tr>
           
           <th width="10%">Masa Kerja</th>
           <td width="5%">:</td>
           <td>
            {{$pegawaiDetails->masa_jabatan}}
           </td>
         </tr>
         <tr>
          @php
            $start = Carbon\Carbon::parse($pegawaiDetails->start_tgl_sk_kontrak)->format('d-m-Y');
              $end = Carbon\Carbon::parse($pegawaiDetails->end_tgl_sk_kontrak)->format('d-m-Y');
              if($pegawaiDetails->status == "Kontrak") {
                echo" <td>Tanggal Habis Kontrak</td>
          <td>:</td>
          <td>$end</td>";
              }
          @endphp
          <td>Tanggal Pensiun</td>
          <td>:</td>
          <td>{{ $pegawaiDetails->status == "Kontrak" ? '-' : $pegawaiDetails->tanggal_pensiun }}</td>
         </tr>
        
         
          
          
         </table>
       
       </div>
      </div>
   </div>
   {{-- informasi kepegawaian --}}
  
</div>
<div class="row">
@php
   if($pegawaiDetails->kategori == "Pegawai Akademik(Dosen)") {

  
@endphp
<div class="col-md-6 detail-pegawai mt-4">
   <div class="card" style="height: 287px" >
        <div class="card-header text-center bg-success text-white">
             Unit Kerja
           </div>
        <div class="card-body">
         <table class="table">
           <tr>
             <th>Fakultas</th>
             <td>:</td>
             <td>{{ $pegawaiDetails->dosen->fakultas->nama_fakultas }}</td>
           </tr>
           <tr>
             <th>Jurusan
               <td>:</td>
               <td>{{ $pegawaiDetails->dosen->jurusan->nama_jurusan }}</td>
           
           </tr>
         
         </table>
        
        </div>
      </div>
 </div>
@php
}
@endphp


 <div class="col-md-6 detail-pegawai mt-4">
   <div class="card" >
        <div class="card-header text-white bg-warning text-center">
             Jenjang Pendidikan
           </div>
        <div class="card-body">
         <table class="table">
           <tr>
             <th>SD</th>
             <td>:</td>
             <td>{{$pegawaiDetails->jenjangPendidikanPegawai->sd }}</td>
           </tr>
           <tr>
             <th>SMP</th>
             <td>:</td>
             <td>{{$pegawaiDetails->jenjangPendidikanPegawai->smp }}</td>
           </tr>
           <tr>
             <th>SMA</th>
             <td>:</td>
             <td>{{$pegawaiDetails->jenjangPendidikanPegawai->sma }}</td>
           </tr>
           <tr>
             <th>S1</th>
             <td>:</td>
             <td>{{ $pegawaiDetails->jenjangPendidikanPegawai->pendidikan_strata }}</td>
           </tr>
           <tr>
             <th>S2</th>
             <td>:</td>
             <td>{{ $pegawaiDetails->jenjangPendidikanPegawai->pendidikan_magister }}</td>
           </tr>
           <tr>
             <th>S3</th>
             <td>:</td>
             <td>{{ $pegawaiDetails->jenjangPendidikanPegawai->pendidikan_doctor }}</td>
           </tr>

         </table>
         
        </div>
      </div>
</div>

  </div>
      
</div>
   

   
   
  
 
   
 
  

    
 @endsection

 