@extends('layouts.petinggi')
 <!-- main  -->
 
 @section('content-petinggi')
 
 <main id="main-content" class="content d-flex flex-column">
    <div>
      <button
        id="sidebarCollapseDefault"
        class="btn border-0 p-0 d-none d-md-block"
        aria-label="hamburger-button"
      >
        <i class="fa-solid fa-bars"></i>
      </button>
      <button
        id="sidebarCollapseMobile"
        data-bs-toggle="offcanvas"
        data-bs-target="#nav-sidebar"
        aria-controls="nav-sidebar"
        aria-label="hamburger-button"
        class="btn border-0 p-0 d-block d-md-none"
      >
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  <h4 class="fw-bold color-primary detail-title">Data Dosen</h4>
 
 
  <div class="content-wrapper">
    
    
     <div class="container">
          
                    {{-- breadcrumb --}}
               {{-- <nav aria-label="breadcrumb" class="nav-breadcrumb mt-3">   
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halaman-dosen-petinggi.index') }}">Data Dosen</a></li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Detail Dosen</li>
                    </ol>
               </nav> --}}
   {{-- breadcrumb --}}
   <div class="content-detail-user">
    <div class="row ">
          
      <div class="col-md-5 offset-4 detail-pegawai">
           <div class="card card-biodata border-light text-center pt-4">
                <img src="{{ asset('storage/assets/foto/' . $dosenDetails->pegawai->foto) }}" class="d-flex align-center" style="height: 70px;width: 60px; display:block; margin-left: auto;margin-right: auto;"  alt="" class="rounded-circle mt-2" >
                <div class="card-body">
                  <h5 class="card-title text-center">{{ $dosenDetails->pegawai->nama }}</h5>
                  <span class="kategori-pegawai">{{ $dosenDetails->pegawai->kategori }}</span>
                  <table class="table table-borderless d-flex justify-content-center   table-biodata b=0">
                    <tr>
                      <td width="20%">Email</td>
                      <td width="2%">:</td>
                      <td>{{ $dosenDetails->pegawai->email }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Umur</td>
                      <td width="2%">:</td>
                      <td >{{ $dosenDetails->pegawai->umur }}</td>
                    </tr>
                    <tr>
                      <td width="15%">TTL</td>
                      <td width="2%">:</td>
                      <td >{{ $dosenDetails->pegawai->tmp_lahir    }},
                        {{Carbon\Carbon::parse($dosenDetails->pegawai->tgl_lahir)->format('d-m-Y')}}
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
                <td>{{ $dosenDetails->pegawai->npk == null ? '-' : $dosenDetails->pegawai->npk }}</td>
                <th width="20%">Jabatan</th>
                <td width="5%">:</td>
                <td>{{ $dosenDetails->pegawai->kode_jabatan == null ? '-' : $dosenDetails->pegawai->jabatan->nama_jabatan }}</td>
               
              </tr>
              <tr>
                <th width="20%">NIDN</th>
                <td width="5%">:</td>
                <td width="">{{ $dosenDetails->nidn == null ? '-' : $dosenDetails->nidn }}</td>
                <th width="20%">Pangkat</th>
                <td width="5%">:</td>
                <td>{{ $dosenDetails->pegawai->kode_pangkat == '' ? '-' : $dosenDetails->pegawai->pangkat->nama_pangkat }}</td>
      
               
              </tr>
              <tr>
                <th width="20%">Status Kepegawaian</td>
                <td width="5%">:</td>
                <td>{{ $dosenDetails->pegawai->status  }}</td>
                <th width="20%">Golongan</th>
                <td width="5%">:</td>
                <td>{{ $dosenDetails->pegawai->kode_golongan == null ? '-' : $dosenDetails->pegawai->golongan->nama_golongan }}</td>
              </tr>
            <tr>
              @php
              $start =  Carbon\Carbon::parse($dosenDetails->pegawai->start_tgl_sk_kontrak)->format('d-m-Y');
              $end = Carbon\Carbon::parse($dosenDetails->pegawai->end_tgl_sk_kontrak)->format('d-m-Y');
              $sk_uir = Carbon\Carbon::parse($dosenDetails->pegawai->tgl_sk_uir)->format('d-m-Y');
                  if($dosenDetails->pegawai->status == "Kontrak")
                  {
                    echo"   
                <th>Surat Kerja</th>
                <td>:</td>
                <td> $start Sampai dengan $end</td>
              
              ";
              }else {
                    echo" <th>Surat Kerja Universitas  </th>
                    <td>:</td>
                    <td>$sk_uir</td>
                    ";
                  }
              @endphp
                 <th width="10%">Masa Kerja</th>
                 <td width="5%">:</td>
                 <td>{{ $dosenDetails->pegawai->masa_jabatan }}</td>
            </tr>
            <tr>
              @php
               $tanggal_pensiun =$dosenDetails->pegawai->tanggal_pensiun;
                  if($dosenDetails->pegawai->status == "Aktif"){
                    echo"<th>Tanggal Pensiun</th>
                          <td>:</td>
                          <td>$tanggal_pensiun</td>";
                  }
              @endphp
            </tr>
            
             
             
            </table>
          
          </div>
         </div>
      </div>
      {{-- informasi kepegawaian --}}
     
  </div>
  <div class="row">
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
                <td> {{ $dosenDetails->fakultas->nama_fakultas }}</td>
              </tr>
              <tr>
                <th>Jurusan/th>
                  <td>:</td>
                  <td> {{ $dosenDetails->jurusan->nama_jurusan }}</td>
              </tr>
            
            </table>
           
           </div>
         </div>
    </div>
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
                <td>{{$dosenDetails->jenjangPendidikan->sd }}</td>
              </tr>
              <tr>
                <th>SMP</th>
                <td>:</td>
                <td>{{$dosenDetails->jenjangPendidikan->smp }}</td>
              </tr>
              <tr>
                <th>SMA</th>
                <td>:</td>
                <td>{{$dosenDetails->jenjangPendidikan->sma }}</td>
              </tr>
              <tr>
                <th>S1</th>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_strata }}</td>
              </tr>
              <tr>
                <th>S2</th>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_magister }}</td>
              </tr>
              <tr>
                <th>S3</th>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_doctor }}</td>
              </tr>

            </table>
            
           </div>
         </div>
 </div>
 
  </div>
  
</main>
 @endsection