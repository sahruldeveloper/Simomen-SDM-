<div class="modal fade editDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Dosen</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form action="<?= route('update.dosen.details') ?>" method="post" id="update-dosen-form">
                     @csrf
                     <div class="form-group">
                       
                      <input type="hidden" class="form-control" name="id">
                     
                  </div>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="dosen-umum-tab" data-bs-toggle="tab" data-bs-target="#dosen-umum-tab-panel" type="button" role="tab" aria-controls="dosen-umum-tab-pane" aria-selected="true">Umum</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="dosen-tab" onchange="proses_edit_kategori_dosen()" data-bs-toggle="tab" data-bs-target="#dosen-tab-panel" type="button" role="tab" aria-controls="dosen-tab-panel" aria-selected="false">Kepegawaian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="dokumen-tab" data-bs-toggle="tab" data-bs-target="#dokumen-tab-pane" type="button" role="tab" aria-controls="dokumen-tab-pane" aria-selected="false">Verif Dokumen</button>
                    </li>
                   
                  
                  </ul>

                 {{-- content --}}
                 <div class="tab-content" id="myTabEditContent">
                  <div class="tab-pane fade show active" id="dosen-umum-tab-panel" role="tabpanel" aria-labelledby="umum-tab" tabindex="0">
                    <div class="row mt-2">
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header">Umum</div>
                          <div class="card-body">
                            <label for="" class="label-input">Nama</label>
                            <div class="form-group">
                              <input type="text" class="form-control p-2" id="nama_dosen" name="nama"
                              value="" placeholder="Nama" >
                              <span class="text-danger error-text kode-error" class="namaDosenCheck"></span>
                            </div>
                            <label for="" class="label-input">Email</label>
                              <div class="form-group mt-2">
                                <input type="email" class="form-control" id="email" name="email"
                                value="" placeholder="Email" >
          
                              <span class="text-danger error-text kode-error" id="emailDosenCheck"></span>
                              </div>
                              <label for="" class="label-input">Tempat Lahir</label>
                              <div class="form-group mt-2">
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                value="" placeholder="Tampat Lahir" >
                                <span class="text-danger error-text kode-error" id="tmp_lahirlDosenCheck"></span>
                              </div>
                              <label for="" class="label-input">Tanggal Lahir</label>
                              <div class="form-group">
                                <label for="" class="label-input">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                value="" >
                                <span class="text-danger error-text kode-error" id="tgl_lahirDosenCheck"></span>
                              </div>
                              <label for="" class="label-input">Jenis Kelamin</label>
                              <select class="form-select" id="JenisKelaminDosenSelect"  name="jenis_kelamin" aria-label="Default select example">
                           
                              </select>
                            <span class="text-danger error-text kode-error" id="jenis_kelaminDosenCheck"></span>
                                 {{-- foto --}}
                            <div class="form-group">
                              <label for="foto">Foto</label>
                              <input type="file" class="form-control" id="file_foto_dosen" name="foto" >
                          
                              <span class="text-danger error-text kode-error" id="fotoDosenCheck"></span>
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
                            <label for="" class="label-input">SD</label>
                            <div class="form-group">
                              <input type="text" class="form-control p-2"  name="sd"
                              value="" placeholder="SD" >
                              <span class="text-danger error-text kode-error" id="pendidikanSDDosenCheckEdit"></span>
                          </div>
                          <label for="" class="label-input">SMP</label>
                          <div class="form-group mt-2">
                            <input type="text" class="form-control p-2"  name="smp"
                            value="" placeholder="SMP" >
                            <span class="text-danger error-text kode-error" id="pendidikanSMPDosenCheckEdit"></span>
                        </div>
                        <label for="" class="label-input">SMA</label>
                        <div class="form-group mt-2">
                          <input type="text" class="form-control p-2"  name="sma"
                          value="" placeholder="SMA/SMK" >
                          <span class="text-danger error-text kode-error" id="pendidikanSMADosenCheckEdit"></span>
                      </div>
                      <label for="" class="label-input">S1</label>
                            <div class="form-group">
                                <input type="text" class="form-control p-2" id="pendidikan_strata_edit" name="pendidikan_strata"
                                value="" placeholder="Pendidikan Strata" >
                                <span class="text-danger error-text kode-error" id="pendidikanStrataDosenCheck"></span>
                            </div>
                            <label for="" class="label-input">S2</label>
                            <div class="form-group mt-2">
                              <input type="text" class="form-control p-2" id="pendidikan_magister_edit" name="pendidikan_magister"
                              value="" placeholder="Pendidikan Magister" >
                              <span class="text-danger error-text kode-error" id="pendidikanMagisterDosenCheck"></span>
                            </div>
                            <label for="" class="label-input">S3</label>
                            <div class="form-group  mt-2">
                              <input type="text" class="form-control p-2" id="pendidikan_doctor_edit" name="pendidikan_doctor"
                              value="" placeholder="Pendidikan Doctor" >
                      
                            </div>
                          </div>
                        </div>

                       
                      </div>   
                    </div>
                  </div>

                  <div class="tab-pane fade" id="dosen-tab-panel" role="tabpanel" aria-labelledby="dosen-tab" tabindex="0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-header">
                            Kepegawaian
                          </div>
                          <div class="card-body">
                               {{-- kategori --}}
                               <select class="form-select mb-2" name="status"  id="KategoriDosenSelect" onchange="proses_edit_kategori_dosen()" id="select-verif-data-pangkat" aria-label="Default select example">
                            
                              </select>
                              <span class="text-danger error-text kode-error" id="KategoriDosenCheck"></span>
                              {{-- kategori --}}
                            {{-- nidn --}}
                            <label for="" class="label-input">NIDN</label>
                            <div class="form-group">
                              <input type="text" class="form-control p-2 mb-2" id="nidn_dosen_edit" name="nidn"
                              value="" placeholder="NIDN">
                              <span class="text-danger error-text kode-error" id="nidnDosenCheckEdit"></span>
                            </div>
                            <label for="" class="label-input">NPK</label>
                            <div class="form-group">
                              <input type="text" class="form-control p-2 mb-2" id="npk_dosen_edit" name="npk"
                              value="" placeholder="NPK/NIP">
                              <span class="text-danger error-text kode-error" id="npkDosenCheckEdit"></span>
                            </div>
    
                            {{--edit jabatan  --}}
                            <label for="" class="label-input">Jabatan</label>
                            <select id="get-select-jabatan-dosen" name="kode_jabatan"  onchange="EditSubKategoriPangkatDosen()"  class="form-select" aria-label="Default select example">
                            </select>
                            <span class="text-danger error-text kode-error" id="kode_jabatanDosenCheck"></span>
                            {{--edit jabatan  --}}
  
                          {{-- edit pangkat --}}
                          <label for="" class="label-input">Pangkat</label>
                          <select id="get-select-pangkat-dosen-edit" name="kode_pangkat" onchange="GetGolonganFromPangkatToEditDosen()" class="form-select" aria-label="Default select example">
                          </select>
                          <span class="text-danger error-text kode-error" id="kode_pangkatDosenCheck"></span>
                           {{-- edit golongan --}}
                           <label for="" class="label-input">Golongan</label>
                           <select id="get-select-golongan-dosen-edit" name="kode_golongan" class="form-select" aria-label="Default select example">
                           </select>
           
                         <span class="text-danger error-text kode-error" id="kode_golonganDosenCheck"></span>
                           {{-- edit pangkat --}}
                        </div>
                       
                          {{-- edit pangkat --}}
                           
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card ">
                            <div class="card-header">
                              Unit Kerja
                            </div>
                            <div class="card-body">
                              {{-- fakultas --}}
                              <label for="" class="label-input">Fakultas</label>
                              <select id="get-select-fakultas-dosen" name="kode_fakultas"  onchange="updateSubKategoriJurusan()" class="form-select" aria-label="Default select example">
                              
                              </select>
                              {{-- fakultas
    
                              {{-- jurusan --}}
                              <label for="" class="label-input">Jurusan</label>
                              <select id="get-select-jurusan-dosen" name="kode_jurusan" class="form-select" aria-label="Default select example">
                              
                              </select>
                            
                              <span class="text-danger error-text kode-error" id="kode_jurusabDosenCheck"></span>
                              {{-- jurusan --}}
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                  <label for="" class="label-input ">Tanggal SK Universitas Islam Riau</label>
                                  <input type="date" class="form-control mb-2" id="tgl_sk_uir_edit" name="tgl_sk_uir"
                                  value="" >
                                <span class="text-danger error-text kode-error" id="tgl_sk_uirDosenCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir --}}
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                  <label for="" class="label-input ">Tanggal SK Yayasan</label>
                                  <input type="date" class="form-control mb-2" id="tgl_sk_yayasan_edit" name="tgl_sk_yayasan"
                                  value="" >
                                <span class="text-danger error-text kode-error" id="tgl_skDosenCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir --}}

                                <span class="text-danger fs-10 mt-3">Ditujukan untuk dosen dengan status dosen kontrak</span>
                                 {{-- tgl_sk uir kontrak --}}
                                 <div class="form-group">
                                  <label for="" class="label-input ">Mulai Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="start_tgl_sk_kontrak_edit" name="start_tgl_sk_kontrak"
                                  value="" >
                                <span class="text-danger error-text kode-error" id="start_tgl_sk_kontrakDosenCheck"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
                                {{-- tgl_sk uir kontrak --}}
                                <div class="form-group">
                                  <label for="" class="label-input ">Berakhir Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="end_tgl_sk_kontrak_edit" name="end_tgl_sk_kontrak"
                                  value="">
                                <span class="text-danger error-text kode-error" id="end_tgl_sk_kontrakDosenCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
      
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    
                  
                  </div>

                  <div class="tab-pane fade" id="dokumen-tab-pane" role="tabpanel" aria-labelledby="dokumen-tab" tabindex="0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-header">Verifikasi Dokumen</div>  
                          <div class="card-body">
                             {{-- verif pangkat --}}
                             <select class="form-select" name="verif_data_pangkat" id="verif-data-pangkat-edit-dosen" aria-label="Default select example">
                              <option selected>Verif Dokumen Pangkat</option>
                              <option value="Sudah">Sudah</option>                            
                              <option value="Belum">Belum</option>
                              
                            </select>
                            <span class="text-danger error-text kode-error" id="verif_data_pangkatDosenCheckAdd"></span>
                            {{-- verif pangkat --}}
                          </div>
                        </div>  
                      </div>                    
                    </div>
                    <div class="row">
                      <div class="col-sm-offset-2 col-md-12 mt-3">
                        <div class="form-group">
                          <button type="submit" class="btn btn-block btn-success">Simpan Perubahan</button>
                      </div>
                    </div>
                  </div>
                  
                </div>
                 {{-- content --}}

                 
                    
                  </form>
                 
   
             </div>
         </div>
     </div>
   </div>