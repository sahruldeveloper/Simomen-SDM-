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
  <h4 class="fw-bold color-primary">Data Pegawai</h4>
 
 
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
                        {{Carbon\Carbon::parse($pegawaiDetails->tgl_lahir)->format('d-m-Y')}}
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
              $sk_yayasan = Carbon\Carbon::parse($pegawaiDetails->tgl_sk_yayasan)->format('d-m-Y');
         
              $sk_uir = $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' ? Carbon\Carbon::parse($pegawaiDetails->tgl_sk_uir)->format('d-m-Y') : '-';
             
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
                    <td>$sk_yayasan</td>
                    ";
                  }
              else {
                    echo" <th>Surat Kerja Yayasan  </th>
                    <td>:</td>
                    <td>$sk_yayasan</td>
                    ";
                  }
              @endphp
                
            </tr>
            <tr>
              
              <th width="10%">Masa Kerja</th>
              <td width="5%">:</td>
              <td>
                @php
                                $now = \Carbon\Carbon::now(); // Tanggal sekarang
                                $b_day = \Carbon\Carbon::parse($pegawaiDetails->tgl_lahir); // Tanggal Lahir
                                $sk = \Carbon\Carbon::parse($pegawaiDetails->tgl_sk_yayasan); // Tanggal Lahir
                                $age = $b_day->diffInYears($now);  // Men   ghitung umur
                             
                                $diff  = date_diff($now, $b_day);
                  
                          // untuk pegawai kontrak
                          $start_kontrak = \Carbon\Carbon::parse($pegawaiDetails->start_tgl_sk_kontrak); // Tanggal Lahir
                          $end_kontrak = \Carbon\Carbon::parse($pegawaiDetails->end_tgl_sk_kontrak); // Tanggal Lahir
                          $interval = $start_kontrak->diffInYears($end_kontrak);  // Menghitung umur
                          $hasil  = date_diff($start_kontrak, $end_kontrak);
                          if ($pegawaiDetails->status == "Kontrak") {
                              // return $sisa_tahun_kontrak . ' tahun, ' . $sisa_bulan_kontrak . ' bulan,' . $sisa_hari_kontrak . ' hari';
                              echo"$hasil->y  tahun, $hasil->m bulan, $hasil->d hari" ;
                          } else {
 // dosen
 $batas_pensiun_dosen = 65;
                          $batas_pensiun_guru_besar = 70;
                          $hari_masa_kerja  = date_diff($now, $sk)->format("%a");
                          $batas_pensiun = 50;
                     
                  
                          // Menghtung Tanggal Pensiun
                  
                          $joining_date = $pegawaiDetails->tgl_lahir;
                          $timeToAdd = "+ 50 years";
                          $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
                          $objDateTime->modify($timeToAdd);
                  
                          // dosen
                          $joining_date_dosen = $pegawaiDetails->tgl_lahir;
                          $timeToAdd_dosen = "+ 65 years";
                          $timeToAdd_guru_besar = "+ 70 years";
                          $objDateTime_guru_besar = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
                          $objDateTime_guru_besar->modify($timeToAdd_guru_besar);
                          $objDateTime_dosen = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
                          $objDateTime_dosen->modify($timeToAdd_dosen);
                  
                  
                          // dosen
                        
                          // $retire_date = date('d-m-Y', strtotime($joining_date));
                          $sekarang = date('Y');
                          $bulan = date('m');
                          $hari = date('d');
                  
                          // dosen
                          $sisa_tahun_dosen = $objDateTime_dosen->format('Y') - $sekarang;
                          $sisa_bulan_dosen = $objDateTime_dosen->format('m') - $bulan;
                          $sisa_hari_dosen = $objDateTime_dosen->format('d') - $hari;
                          $sisa_tahun_guru_besar = $objDateTime_guru_besar->format('Y') - $sekarang;
                          $sisa_bulan_guru_besar = $objDateTime_guru_besar->format('m') - $bulan;
                          $sisa_hari_guru_besar = $objDateTime_guru_besar->format('d') - $hari;
                          // dosen
                  
                          $sisa_tahun = $objDateTime->format('Y') - $sekarang;
                          $sisa_bulan = $objDateTime->format('m') - $bulan;
                          $sisa_hari = $objDateTime->format('d') - $hari;
                  
                          $status = $pegawaiDetails->status;
                          // dd($pegawaiDetails->dosen->kode_jabatan);
                          // kondisi untuk dosen
                          if( $age >= $batas_pensiun_dosen && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' && $pegawaiDetails->kode_jabatan == 'JBT001'){
                            echo"Pensiun";
                          } 
                          else if( $age >= $batas_pensiun_dosen && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' && $pegawaiDetails->kode_jabatan == 'JBT002'){
                            echo"Pensiun";
                          } 
                          else if( $age >= $batas_pensiun_dosen && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' && $pegawaiDetails->kode_jabatan == 'JBT003'){
                            echo"Pensiun";
                          } 
                          else if( $age >= $batas_pensiun_guru_besar && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' && $pegawaiDetails->kode_jabatan == 'JBT004'){
                            echo"Pensiun";
                          } 
                          else if($age < $batas_pensiun_guru_besar && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)' && $pegawaiDetails->kode_jabatan == "JBT004"){
                            if ($sisa_bulan_guru_besar < 1) {
                                  echo" $sisa_tahun_guru_besar tahun, 0 bulan, $sisa_hari_guru_besar hari";
                              } else {
                                echo" $sisa_tahun_guru_besar tahun, $sisa_bulan_guru_besar bulan, $sisa_hari_guru_besar hari";
                              }
                          }else if($age < $batas_pensiun_dosen && $pegawaiDetails->kategori == 'Pegawai Akademik(Dosen)'){
                            if ($sisa_bulan_dosen < 0) {
                                  echo" $sisa_tahun_dosen tahun, 0 bulan, $sisa_hari_dosen hari";
                              } else {
                                echo" $sisa_tahun_dosen tahun, $sisa_bulan_dosen bulan, $sisa_hari_dosen hari";
                              }
                          }
                          // kondisi untuk dosen
                  
                          if ($age >= $batas_pensiun && $pegawaiDetails->kategori == 'Pegawai Non Akademik') {
                           
                              echo"Pensiun";
                          } else if($age < $batas_pensiun && $pegawaiDetails->kategori == 'Pegawai Non Akademik') {
                              if ($sisa_bulan < 0) {
                                  echo" $sisa_tahun tahun, 0 bulan, $sisa_hari hari";
                              } else {
                                echo" $sisa_tahun tahun, $sisa_bulan bulan, $sisa_hari hari";
                              }
                              // return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
                          }
                          }
                          // untuk pegawai kontrak
                  
                         
                            @endphp
              </td>
            </tr>
            <tr>
              @php
                $now = \Carbon\Carbon::now(); // Tanggal sekarang
                                $b_day = \Carbon\Carbon::parse($pegawaiDetails->tgl_lahir); // Tanggal Lahir
                                $sk = \Carbon\Carbon::parse($pegawaiDetails->tgl_sk_yayasan); // Tanggal Lahir
                                $age = $b_day->diffInYears($now);  // Men   ghitung umur
                             
                                $diff  = date_diff($now, $b_day);
                $batas_pensiun = 50;
                $batas_pensiun_dosen = 65;
                $batas_pensiun_guru_besar = 70;
                $joining_date = $pegawaiDetails->tgl_lahir;
                          $timeToAdd = "+ 50 years";
                          $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
                          $objDateTime->modify($timeToAdd);
                  
                          // dosen
                          $joining_date_dosen = $pegawaiDetails->tgl_lahir;
                          $timeToAdd_dosen = "+ 65 years";
                          $timeToAdd_guru_besar = "+ 70 years";
                          $objDateTime_guru_besar = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
                          $objDateTime_guru_besar->modify($timeToAdd_guru_besar);
                          $objDateTime_dosen = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
                          $objDateTime_dosen->modify($timeToAdd_dosen);
                          $tanggal_pensiun_pegawai =  $objDateTime->format('d-m-Y');
                          $tanggal_pensiun_dosen =  $objDateTime_dosen->format('d-m-Y');
                          $tanggal_pensiun_guru_besar =  $objDateTime_guru_besar->format('d-m-Y');
                  if($pegawaiDetails->kategori == "Pegawai Non Akademik") {
                    echo"<th>Tanggal Pensiun</th>
                          <td>:</td>
                          <td>$tanggal_pensiun_pegawai</td>";
                  }
                  else if($pegawaiDetails->status == "Aktif" && $pegawaiDetails->dosen->kode_jabatan =='JBT004' ){
                    echo"<th>Tanggal Pensiun</th>
                          <td>:</td>
                          <td>$tanggal_pensiun_guru_besar</td>";
                        
                  }else if($pegawaiDetails->kategori == "Pegawai Akademik(Dosen)") {
                    echo"<th>Tanggal Pensiun</th>
                          <td>:</td>
                          <td>$tanggal_pensiun_dosen";
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
</main>
 @endsection