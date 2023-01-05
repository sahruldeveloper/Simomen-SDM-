@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <div class="content-wrapper">
  
 
   <!-- main  -->
    <div class="container" id="tag_pegawai_petinggi">

      <div class="topbar  ">
   
        <div class="topbar-title">
             <h5>Data Pegawai</h5>
             <span>Manage data for growth</span>
        </div>
      
       
        
       </div>

      <div class="row mt-4 mb-3">
        <div class="col-md-5">
          <form action="{{ route('pegawai.index')}}">
            <div class="input-group mb-3">
              <input type="search" class="form-control" id="search_data_pegawai" name="search" placeholder="Search.." >
              <button class="btn btn-outline-success" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
        </div>
        <div class="col-md-7 text-end">
         
          <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-pegawai"><i class="bi bi-person-plus"></i> Tambah Pegawai</a>
          <a href="{{ route('report.pegawai') }}" class="btn btn-info btn-sm" id="tombol-tambah-pegawai"><i class="bi bi-printer"></i> Cetak Data Pegawai</a>
       </div>
       
      </div>

      {{-- !-- MULAI MODAL FORM TAMBAH/EDIT--> --}}
  <div class="modal fade" id="tambah-modal-pegawai" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
              <div class="">
                <h5 class="modal-title" id="modal-judul"></h5>
                <span class="text-optional">Form ini digunakan untuk menambahkan data Pegawai Non Akademik</span>
              </div>
          
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" name="form-tambah-pegawai" action="{{route('pegawai.store') }}" id="form-tambah-pegawai" method="post"  class="form-horizontal" >
                  @csrf
                     {{-- Form tambah data --}}
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Umum</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Kepegawaian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Verifikasi Dokumen</button>
                    </li>
                  
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                      <div class="row mt-2">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-header">Umum</div>
                           <div class="card-body">
                            <div class="form-group">
                              {{-- <label for="kode_dosen" class="col-sm-12 control-label">Kode Dosen</label> --}}
                              <div class="col-sm-12">
                                  <input type="hidden" class="form-control" id="id" name="id"
                                      value="{{ $id }}" placeholder="kode pegawai" readonly>
                              
                      
                              </div>
                            </div>
                         
                              <div class="form-group">
                                <input type="text" class="form-control p-2" id="nama" name="nama"
                                value="" placeholder="Nama" >
                                <span class="text-danger error-text kode-error" id="namaPegawaiCheckAdd"></span>
                              </div>
                              <div class="form-group mt-2">
                                <input type="email" class="form-control" id="email" name="email"
                                value="" placeholder="Email" >
          
                              <span class="text-danger error-text kode-error" id="emailPegawaiCheckAdd"></span>
                              </div>
                              <div class="form-group mt-2">
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                value="" placeholder="Tampat Lahir" >
                                <span class="text-danger error-text kode-error" id="tmp_lahirlPegawaiCheckAdd"></span>
                              </div>
                              <div class="form-group">
                                <label for="" class="label-input">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                value="" >
                                <span class="text-danger error-text kode-error" id="tgl_lahirPegawaiCheckAdd"></span>
                              </div>
                              <label for="" class="label-input">Jenis Kelamin</label>
                              <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                <option value="">Jenis Kelamin</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                              
                              </select>
                              <span class="text-danger error-text kode-error" id="jenis_kelaminPegawaiCheckAdd"></span>
                                 {{-- foto --}}
                                 <div class="form-group">
                                  <label for="foto">Foto</label>
                                  <input type="file" class="form-control" id="file_foto_pegawai" name="foto" >
                               
                              </div>
                          
                              <span class="text-danger error-text kode-error" id="fotoPegawaiCheckAdd"></span>
                            {{-- foto --}}
                           </div>
                          </div>
  
                         
                        
                        </div>
  
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-header">
                              Jenjang Pendidikan
                            </div>
                            <div class="card-body">
                              <div class="form-group">
                                <input type="text" class="form-control p-2"  name="sd"
                                value="" placeholder="Pendidikan SD" >
                                <span class="text-danger error-text kode-error" id="pendidikanSDPegawaiCheckAdd"></span>
                            </div>
                           
                              <div class="form-group mt-2">
                                <input type="text" class="form-control p-2"  name="smp"
                                value="" placeholder="Pendidikan SMP" >
                                <span class="text-danger error-text kode-error" id="pendidikanSMPPegawaiCheckAdd"></span>
                            </div>
                          
                              <div class="form-group mt-2">
                                <input type="text" class="form-control p-2"  name="sma"
                                value="" placeholder="Pendidikan SMA" >
                                <span class="text-danger error-text kode-error" id="pendidikanSMAPegawaiCheckAdd"></span>
                            </div>
                              <div class="form-group mt-2">
                                  <input type="text" class="form-control p-2" id="pendidikan" name="pendidikan_strata"
                                  value="" placeholder="Pendidikan Strata" >
                                  <span class="text-danger error-text kode-error" id="pendidikanStrataPegawaiCheckAdd"></span>
                              </div>
                              <div class="form-group mt-2">
                                <input type="text" class="form-control p-2" id="pendidikan" name="pendidikan_magister"
                                value="" placeholder="Pendidikan Magister" >
                                <span class="text-danger error-text kode-error" id="pendidikanMagisterPegawaiCheckAdd"></span>
                              </div>
                              <div class="form-group  mt-2">
                                <input type="text" class="form-control p-2" id="pendidikan" name="pendidikan_doctor"
                                value="" placeholder="Pendidikan Doctor" >
                        
                              </div>
                            </div>
                          </div>
  
                         
                        </div>   
                      </div>
                    </div>

                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">
                              Kepegawaian
                            </div>
                            <div class="card-body">
                                 {{-- kategori --}}
                                 <label for="Status Dosen"> Pilih Status Kepegawaian</label>
                                 <select class="form-select mb-2" name="status" id="status_pegawai_add" onchange="proses_input_kategori_pegawai()" aria-label="Default select example">
                                                      
                                  <option value="Aktif" selected>Aktif / Tetap </option>                            
                                  <option value="Kontrak">Kontrak</option>
                                </select>
                                <span class="text-danger error-text kode-error" id="statusPegawaiCheckAdd"></span>
                                {{-- kategori --}}
                              {{-- nidn --}}
                              {{-- <div class="form-group mt-2">
                                <input type="text" class="form-control p-2 mb-2" id="nidn_dosen" name="nidn"
                                value="" placeholder="NIDN" required>
                                <span class="text-danger error-text kode-error" id="nidnDosenCheckAdd"></span>
                              </div> --}}
                              <div class="form-group">
                                <input type="text" class="form-control p-2 mb" id="npk_pegawai" name="npk"
                                value="" placeholder="NPK/NIP" required>
                                <span class="text-danger error-text kode-error" id="npkPegawaiCheckAdd"></span>
                              </div>
      
      
                           
                             {{-- pangkat --}}
                             <select id="select-pangkat" name="kode_pangkat" onchange="GetGolonganFromPangkat()" class="form-select mt-2" aria-label="Default select example">
                              <option value="">Pilih Pangkat</option>
                            @foreach ($pangkat as $item)
                                <option value="{{ $item->kode_pangkat }}">{{ $item->nama_pangkat }}</option>
                            @endforeach
                            
                            </select>
    
                            <span class="text-danger error-text kode-error" id="kode_pangkatPegawaiCheckAdd"></span>
                             {{-- pangkat --}}
                              
                            {{-- golongan --}}
                            <select id="get-select-golongan" name="kode_golongan" class="form-select mt-2" aria-label="Default select example">
                        
                            </select>
    
                            <span class="text-danger error-text kode-error" id="kode_golonganPegawaiCheckAdd"></span>
                            {{-- golongan --}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card ">
                            <div class="card-header">
                              Unit Kerja
                            </div>
                            <div class="card-body">
                             
                              {{-- jurusan --}}
                            
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                    <label for="" class="label-input ">Tanggal SK Yayasan</label>
                                    <input type="date" class="form-control mb-2" id="tgl_sk_yayasan_pegawai" name="tgl_sk_yayasan"
                                    value="" required>
                                  <span class="text-danger error-text kode-error" id="tgl_sk_yayasanPegawaiCheckAdd"></span>
                                </div>
                                  {{-- tgl_sk uir --}}
      
                                <span class="text-warning fs-10 mt-3">Ditujukan untuk dosen dengan status pegawai kontrak</span>
                                 {{-- tgl_sk uir kontrak --}}
                                 <div class="form-group">
                                  <label for="" class="label-input ">Mulai Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="start_tgl_sk_kontrak_pegawai" name="start_tgl_sk_kontrak"
                                  value="" disabled>
                                <span class="text-danger error-text kode-error" id="start_tgl_sk_kontrakPegawaiCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
                                {{-- tgl_sk uir kontrak --}}
                                <div class="form-group">
                                  <label for="" class="label-input ">Berakhir Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="end_tgl_sk_kontrak_pegawai" name="end_tgl_sk_kontrak"
                                  value="" disabled>
                                <span class="text-danger error-text kode-error" id="end_tgl_sk_kontrakPegawaiCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
      
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    
                     
                    </div>

                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">Verifikasi Dokumen</div>  
                            <div class="card-body">
                               {{-- verif pangkat --}}
                               <select class="form-select" name="verif_data_pangkat" id="select-verif-data-pangkat" aria-label="Default select example">
                                <option value="">Verif Dokumen Pangkat</option>
                                <option value="Sudah">Sudah</option>                            
                                <option value="Belum">Belum</option>
                                
                              </select>
                              <span class="text-danger error-text kode-error" id="verif_data_pangkatPegawaiCheckAdd"></span>
                              {{-- verif pangkat --}}
                            </div>
                          </div>  
                        </div>                    
                      </div>
                      <div class="row">
                        <div class="col-sm-offset-2 col-md-12 mt-3">
                          <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-pegawai"
                          value="create">Simpan Data Pegawai
                      </button>
                      </div>
                    </div>
                    
                  </div>
                  {{-- Form tambah data --}}
                   
                  
                  
              </div>
                       
                                           
                    

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- AKHIR MODAL -->   
<div class="read_data_pegawai" id="read_data_pegawai">
 
</div>
     
     
     </div>
 
</div>
 @endsection

