@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <div class="content-wrapper">
  
   <!-- main  -->
    <div class="container">

      <div class="topbar  ">
   
        <div class="topbar-title">
             <h5>Data Dosen</h5>
             <span>Manage data for growth</span>
        </div>
       
        
       </div>

      <div class="row mt-4 mb-3">
        <div class="col-md-5">
          <form action="{{ route('dosen.index')}}">
            <div class="input-group mb-3">
              <input type="search" class="form-control" id="search_dosen" name="search" placeholder="Search.." >
              <button class="btn btn-outline-success" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
        </div>
        <div class="col-md-7 text-end">
         
          <a href="javascript:void(0)" class="btn btn-success btn-sm" id="tombol-tambah-dosen">Tambah Data Dosen</a>
          <a href="{{ route('report.dosen') }}" class="btn btn-info btn-sm" id="tombol-tambah-pegawai"><i class="bi bi-printer"></i> Cetak Data Dosen</a>
       </div>
       
      </div>

      {{-- <div class="row mt-2">
        <div class="col-md-5">
          <form action="{{ route('read.dosen') }}" method="get">
            <div class="input-group mb-3 col-md-4 float-right">
                <input type="text" id="page_admin_date_dosen" name="date" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                </div>
             
            </div>
        </form>
        </div>
      </div> --}}

      {{-- !-- MULAI MODAL FORM TAMBAH/EDIT--> --}}
  <div class="modal fade" id="tambah-modal-dosen" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" name="form-tambah-dosen"  action="{{ route('dosen.store') }}"  id="form-tambah-dosen" method="post"  class="form-horizontal" >
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
                                    <input type="hidden" class="form-control" id="id_dosen" name="id"
                                        value="{{ $id }}" placeholder="kode dosen" readonly>
                                
                                 
                                </div>
                              </div>
                           
                                <div class="form-group">
                                  <input type="text" class="form-control p-2" id="nama" name="nama"
                                  value="" placeholder="Nama" >
                                  <span class="text-danger error-text kode-error" id="namaDosenCheckAdd"></span>
                                </div>
                                <div class="form-group mt-2">
                                  <input type="email" class="form-control" id="email" name="email"
                                  value="" placeholder="Email" >
            
                                <span class="text-danger error-text kode-error" id="emailDosenCheckAdd"></span>
                                </div>
                                <div class="form-group mt-2">
                                  <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                  value="" placeholder="Tampat Lahir" >
                                  <span class="text-danger error-text kode-error" id="tmp_lahirlDosenCheckAdd"></span>
                                </div>
                                <div class="form-group">
                                  <label for="" class="label-input">Tanggal Lahir</label>
                                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                  value="" >
                                  <span class="text-danger error-text kode-error" id="tgl_lahirDosenCheckAdd"></span>
                                </div>
                                <label for="" class="label-input">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                  <option value="">Jenis Kelamin</option>
                                  <option value="pria">Pria</option>
                                  <option value="wanita">Wanita</option>
                                
                                </select>
                                <span class="text-danger error-text kode-error" id="jenis_kelaminDosenCheckAdd"></span>
                                   {{-- foto --}}
                              <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" id="file_foto_dosen" name="foto" >
                                <span class="text-danger error-text kode-error" id="fotoDosenCheckAdd"></span>
                              </div>
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
                                <input type="text" class="form-control p-2" name="sd"
                                value="" placeholder="Pendidikan Sekolah Dasar" >
                                <span class="text-danger error-text kode-error" id="pendidikanSDDosenCheckAdd"></span>
                            </div>
                            <div class="form-group mt-2">
                              <input type="text" class="form-control p-2" name="smp"
                              value="" placeholder="Pendidikan SMP" >
                              <span class="text-danger error-text kode-error" id="pendidikanSMPDosenCheckAdd"></span>
                            </div>
                            <div class="form-group mt-2">
                              <input type="text" class="form-control p-2" name="sma"
                              value="" placeholder="Pendidikan SMA/SMK" >
                              <span class="text-danger error-text kode-error" id="pendidikanSMADosenCheckAdd"></span>
                            </div>
                              <div class="form-group mt-2">
                                  <input type="text" class="form-control p-2" id="pendidikan" name="pendidikan_strata"
                                  value="" placeholder="Pendidikan Strata" >
                                  <span class="text-danger error-text kode-error" id="pendidikanStrataDosenCheckAdd"></span>
                              </div>
                              <div class="form-group mt-2">
                                <input type="text" class="form-control p-2" id="pendidikan" name="pendidikan_magister"
                                value="" placeholder="Pendidikan Magister" >
                                <span class="text-danger error-text kode-error" id="pendidikanMagisterDosenCheckAdd"></span>
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
                                 <label for="Status Dosen"> Pilih Status Kepegawaian (Dosen)</label>
                                 <select class="form-select mb-2" name="status" id="status_dosen_add" onchange="proses_input_kategori_dosen()" id="select-verif-data-pangkat" aria-label="Default select example">
                                                      
                                  <option value="Aktif" selected>Aktif / Tetap </option>                            
                                  <option value="Kontrak">Kontrak</option>
                                </select>
                                <span class="text-danger error-text kode-error" id="statusDosenCheckAdd"></span>
                                {{-- kategori --}}
                              {{-- nidn --}}
                              <div class="form-group mt-2">
                                <input type="text" class="form-control p-2 mb-2" id="nidn_dosen" name="nidn"
                                value="" placeholder="NIDN" required>
                                <span class="text-danger error-text kode-error" id="nidnDosenCheckAdd"></span>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control p-2 mb-2" id="npk_dosen" name="npk"
                                value="" placeholder="NPK/NIP" required>
                                <span class="text-danger error-text kode-error mb-2" id="npkDosenCheckAdd"></span>
                              </div>
      
                              <label for="">Jabatan Fungsional</label>
                              <select id="select-jabatan" name="kode_jabatan" onchange="updateSubKategoriJabatan()" class="form-select" aria-label="Default select example">
                               <option></option>
                              @foreach ($jabatan as $item)
                            
                                  <option value="{{ $item->kode_jabatan }}">{{ $item->nama_jabatan }}</option>
                              @endforeach
                              
                              </select>
      
                              <span class="text-danger error-text kode-error mb-2" id="add_kode_jabatanDosenCheckAdd"></span>
                              
                              <div class="form-group">
                                <span for="" class="mt-2">Pangkat</span>
                                <select id="SubKategoriPangkat" name="kode_pangkat" onchange="GetGolonganFromPangkatDosen()" class="form-select mt-2 mb-2" aria-label="Default select example">
                                 
                                </select>
                                     <span class="text-danger error-text kode-error mb-2" id="add_kode_pangkatDosenCheckAdd"></span>
                              </div>
                             
                              <div class="form-group">
                                <label for="">Golongan</label>
                                <select id="add-select-golongan-dosen" name="kode_golongan" class="form-select" aria-label="Default select example">
                          
                                    </select>
            
                                    <span class="text-danger error-text kode-error" id="kode_golonganDosenCheckAdd"></span>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card ">
                            <div class="card-header">
                              Unit Kerja
                            </div>
                            <div class="card-body">
                              {{-- fakultas --}}
                              <select id="select-fakultas" name="kode_fakultas" onchange="SubKategoriJurusan()" class="form-select" aria-label="Default select example">
                                <option value="">Pilih Fakultas</option>
                                @foreach ($fakultas as $item)
                                    <option value="{{ $item->kode_fakultas }}">{{ $item->nama_fakultas }}</option>
                                @endforeach
        
                              </select>
                              <span class="text-danger error-text kode-error" id="kode_fakultasDosenCheckAdd"></span>
                              {{-- fakultasjenis
    
                              {{-- jurusan --}}
                              <select id="select-jurusan" name="kode_jurusan" class="form-select mt-2" aria-label="Default select example">
                                <option>Pilih Jurusan</option>
        
                              </select>
                            
                              <span class="text-danger error-text kode-error" id="kode_jurusabDosenCheckAdd"></span>
                              {{-- jurusan --}}
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                  <label for="" class="label-input ">Tanggal SK Universitas Islam Riau</label>
                                  <input type="date" class="form-control mb-2" id="tgl_sk_add" name="tgl_sk_uir"
                                  value="" required>
                                <span class="text-danger error-text kode-error" id="tgl_sk_uirDosenCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir --}}
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                    <label for="" class="label-input ">Tanggal SK Yayasan</label>
                                    <input type="date" class="form-control mb-2" id="tgl_sk_yayasan" name="tgl_sk_yayasan"
                                    value="" required>
                                  <span class="text-danger error-text kode-error" id="tgl_sk_yayasanDosenCheckAdd"></span>
                                </div>
                                  {{-- tgl_sk uir --}}
      
                                <span class="text-danger fs-10 mt-3">Ditujukan untuk dosen dengan status dosen kontrak</span>
                                 {{-- tgl_sk uir kontrak --}}
                                 <div class="form-group">
                                  <label for="" class="label-input ">Mulai Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="start_tgl_sk_kontrak" name="start_tgl_sk_kontrak"
                                  value="" disabled>
                                <span class="text-danger error-text kode-error" id="start_tgl_sk_kontrakDosenCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
                                {{-- tgl_sk uir kontrak --}}
                                <div class="form-group">
                                  <label for="" class="label-input ">Berakhir Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="end_tgl_sk_kontrak" name="end_tgl_sk_kontrak"
                                  value="" disabled>
                                <span class="text-danger error-text kode-error" id="end_tgl_sk_kontrakDosenCheckAdd"></span>
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
                               <select class="form-select" name="verif_data_pangkat" id="select-verif-data-pangkat-input" aria-label="Default select example">
                                <option >Verif Dokumen Pangkat</option>
                                <option value="Sudah">Sudah</option>                            
                                <option value="Belum">Belum</option>
                                
                              </select>
                              <span class="text-danger error-text kode-error" id="verif_data_dokumenDosenCheckAdd"></span>
                              {{-- verif pangkat --}}
                            </div>
                          </div>  
                        </div>                    
                      </div>
                      <div class="row">
                        <div class="col-sm-offset-2 col-md-12 mt-3">
                          <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan-dosen"
                              value="create">Simpan Data Dosen
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
<div class="read_data_dosen" id="page_admin_read_data_dosen"></div>
 @endsection