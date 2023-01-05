@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 <div class="content-wrapper">
  <div class="container">
   <div class="content-detail-user">
    <div class="row">
      {{-- section profile --}}
      <div class="col-md-4 detail-pegawai">
        <div class="card text-center">
          {{-- content --}}
          <img src="{{ asset('storage/assets/foto/' . $dosenDetails->pegawai->foto) }}" alt="" class="rounded-circle mt-2" >
          <div class="card-body">
            <h5 class="card-title text-center">{{ $dosenDetails->pegawai->nama }}</h5>
            <ul>
               <li>Email <span>:</span> {{ $dosenDetails->pegawai->email }}</li>
               <li>Umur : {{ $dosenDetails->pegawai->umur }}</li>
               <li>Tanggal Lahir : {{ $dosenDetails->pegawai->tgl_lahir }}</li>
               <li>Tempat Lahir : {{ $dosenDetails->pegawai->tmp_lahir }}</li>
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
                      if($dosenDetails->nidn == null){
                         echo "-";
                       }else{
                         echo"  <span class='fw-bold mb-1'>$dosenDetails->nidn</span>";
                       } 
                 @endphp</td>
                  </tr>
                  <tr>
                    <th>NPK</th>
                    <td>:</td>
                    <td>    @php
                      if($dosenDetails->npk == null){
                         echo "-";
                       }else{
                         echo"  <span class='fw-bold mb-1'>$dosenDetails->npk</span>";
                       } 
                      @endphp
                    </td>
                  </tr>
                  <tr>
                    <th>Jabatan</th>
                    <td>:</td>
                    <td> {{ $dosenDetails->pegawai->kode_jabatan == null ? '-' : $dosenDetails->pegawai->jabatan->nama_jabatan }}</td>
                  </tr>
                  <tr>
                    <th>Pangkat</th>
                    <td>:</td>
                    <td>{{  $dosenDetails->pegawai->kode_pangkat == null ? '-' : $dosenDetails->pegawai->pangkat->nama_pangkat    }}</td>
                  </tr>
                  <tr>
                    <th>Golongan</th>
                    <td>:</td>
                    <td>{{$dosenDetails->pegawai->kode_golongan == null ? '-' : $dosenDetails->pegawai->golongan->nama_golongan   }}</td>
                  </tr>
                 
                </table>
              </div>
              <div class="col-md-6">
                <table class="table table-borderless">
                  <tr>
                    <th>status</th>
                    <td>:</td>
                    <td>{{$dosenDetails->pegawai->status }}</td>
                  </tr>
                  <tr>
                    <th>Masa Kerja</th>
                    <td>:</td>
                    <td>{{ $dosenDetails->pegawai->masa_jabatan}}</td>
                  </tr>
                  
                    @php
                    $start = $dosenDetails->pegawai->start_tgl_sk_kontrak;
                    $end = $dosenDetails->pegawai->end_tgl_sk_kontrak;
                    $tanggal_pensiun =$dosenDetails->pegawai->tanggal_pensiun;
                        if($dosenDetails->pegawai->status == "Kontrak")
                        {
                          echo" 
                          <tr>
                          <th>Mulai Surat Kerja</th>
                          <td>:</td>
                          <td>$start</td>
                          </tr>";
                          echo"
                              <tr>  
                              <th>Berakhir Surat Kerja</th> <td>:</td>
                              <td> $end</td>
                              </tr>
                              ";
                        }else {
                              echo" 
                              <tr>
                              <th>SK Universitas</th> <td>:</td> <td> $dosenDetails->tgl_sk_uir </td>
                            </tr>
                            <tr>  
                              <th>Tanggal Pensiun</th> <td>:</td>
                              <td>$tanggal_pensiun</td>
                            </tr>
                            ";
                }
            @endphp
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- section kepegawaisn --}}
    
    </div>

    {{-- unit kerja --}}
    <div class="row mt-4">
      <div class="col-md-6 detail-pegawai">
        <div class="card card-unit-kerja">
          <div class="card-header text-center">Unit Kerja - Universitas Islam Riau</div>
          <div class="card-body">
            <table class="table">
              <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>{{ $dosenDetails->fakultas->nama_fakultas }}</td>
              </tr>
              <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>{{ $dosenDetails->jurusan->nama_jurusan }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">Jenjang Pendidikan</div>
          <div class="card-body">
            <table class="table">
              <tr>
                <td>SD</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->sd }}</td>
              </tr>
              <tr>
                <td>SMP</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->smp }}</td>
              </tr>
              <tr>
                <td>SMA</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->sma }}</td>
              </tr>
              <tr>
                <td>S1</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_strata }}</td>
              </tr>
              <tr>
                <td>S2</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_magister }}</td>
              </tr>
              <tr>
                <td>S3</td>
                <td>:</td>
                <td>{{ $dosenDetails->jenjangPendidikan->pendidikan_doctor }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- unit kerja --}}
   </div>
  </div>
 </div>
 <!-- main  -->
 
 
 @endsection

 