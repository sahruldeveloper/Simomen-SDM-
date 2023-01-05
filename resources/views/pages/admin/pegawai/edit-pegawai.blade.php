<div class="modal fade editPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                  <form   action="<?= route('update.pegawai.details') ?>"  method="post"     id="update-pegawai-form">
                     @csrf
                     <div class="form-group">
                       
                      <input type="hidden" class="form-control" name="id">
                     
                  </div>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum-tab-pane" type="button" role="tab" aria-controls="umum-tab-pane" aria-selected="true">Umum</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="kepegawaian-tab"  data-bs-toggle="tab" data-bs-target="#kepegawaian-tab-pane" type="button" role="tab" aria-controls="kepegawaian-tab-pane" aria-selected="false">Kepegawaian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="verif-tab" data-bs-toggle="tab" data-bs-target="#verif-tab-pane" type="button" role="tab" aria-controls="verifdokumen-tab-pane" aria-selected="false">Verifikasi Dokumen</button>
                    </li>
                  
                  </ul>

                 {{-- content --}}
                 <div class="tab-content" id="myTabEditContent">
                  <div class="tab-pane fade show active" id="umum-tab-pane" role="tabpanel" aria-labelledby="umum-tab" tabindex="0">
                    <div class="row mt-2">
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header">Umum</div>
                          <div class="card-body">
                          
                            <div class="form-group">
                              <input type="text" class="form-control p-2" id="nama" name="nama"
                              value="" placeholder="Nama" >
                              <span class="text-danger error-text kode-error" class="namaPegawaiCheckEdit"></span>
                            </div>
                              <div class="form-group mt-2">
                                <input type="email" class="form-control" id="email" name="email"
                                value="" placeholder="Email" >
          
                              <span class="text-danger error-text kode-error" id="emailPegawaiCheckEdit"></span>
                              </div>
                              <div class="form-group mt-2">
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                value="" placeholder="Tampat Lahir" >
                                <span class="text-danger error-text kode-error" id="tmp_lahirlPegawaiCheckEdit"></span>
                              </div>
                              <div class="form-group">
                                <label for="" class="label-input">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                value="" >
                                <span class="text-danger error-text kode-error" id="tgl_lahirPegawaiCheckEdit"></span>
                              </div>
                              <label for="" class="label-input">Jenis Kelamin</label>
                              <select class="form-select" id="JenisKelaminPegawaiSelect"  name="jenis_kelamin" aria-label="Default select example">
                           
                              </select>
                            <span class="text-danger error-text kode-error" id="jenis_kelaminPegawainCheckEdit"></span>
                                 {{-- foto --}}
                            <div class="form-group">
                              <label for="foto">Foto</label>
                              <input type="file" class="form-control" id="file_foto_dosen" name="foto" >
                          
                              <span class="text-danger error-text kode-error" id="fotoPegawaiCheckEdit"></span>
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
                              <input type="text" class="form-control p-2" id="pendidikan_sd_edit" name="pendidikan_sd"
                              value="" placeholder="SD" >
                              <span class="text-danger error-text kode-error" id="pendidikanSDPegawaiCheck"></span>
                          </div>
                          <div class="form-group mt-2">
                            <input type="text" class="form-control p-2" id="pendidikan_smp_edit" name="pendidikan_smp"
                            value="" placeholder="SMP" >
                            <span class="text-danger error-text kode-error" id="pendidikanSMPPegawaiCheck"></span>
                          </div>
                          <div class="form-group mt-2">
                            <input type="text" class="form-control p-2" id="pendidikan_sma_edit" name="pendidikan_sma"
                            value="" placeholder="SMP" >
                            <span class="text-danger error-text kode-error" id="pendidikanSMAPegawaiCheck"></span>
                          </div>
                            <div class="form-group mt-2">
                                <input type="text" class="form-control p-2" id="pendidikan_strata_edit" name="pendidikan_strata_pegawai"
                                value="" placeholder="Pendidikan Strata" >
                                <span class="text-danger error-text kode-error" id="pendidikanStrataDosenCheck"></span>
                            </div>
                            <div class="form-group mt-2">
                              <input type="text" class="form-control p-2" id="pendidikan_magister_edit" name="pendidikan_magister_pegawai"
                              value="" placeholder="Pendidikan Magister" >
                              <span class="text-danger error-text kode-error" id="pendidikanMagisterDosenCheck"></span>
                            </div>
                            <div class="form-group  mt-2">
                              <input type="text" class="form-control p-2" id="pendidikan_doctor_edit" name="pendidikan_doctor_pegawai"
                              value="" placeholder="Pendidikan Doctor" >
                      
                            </div>
                          </div>
                        </div>

                       
                      </div>   
                    </div>
                  </div>

                  <div class="tab-pane fade" id="kepegawaian-tab-pane" role="tabpanel" aria-labelledby="kepegawaian-tab" tabindex="0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-header">
                            Kepegawaian
                          </div>
                          <div class="card-body">
                               {{-- kategori --}}
                               <select class="form-select mb-2" name="status"  id="get-select-status" onchange="proses_edit_kategori_pegawai()"  aria-label="Default select example">
                            
                              </select>
                              <span class="text-danger error-text kode-error" id="StatusPegawaiCheckEdit"></span>
                              {{-- kategori --}}
                            {{-- nidn --}}
                            {{-- <div class="form-group">
                              <input type="text" class="form-control p-2 mb-2" id="nidn_dosen_edit" name="nidn"
                              value="" placeholder="NIDN">
                              <span class="text-danger error-text kode-error" id="nidnDosenCheckEdit"></span>
                            </div> --}}
                            <div class="form-group">
                              <input type="text" class="form-control p-2 mb-2" id="npk_pegawai_edit" name="npk"
                              value="" placeholder="NPK/NIP">
                              <span class="text-danger error-text kode-error" id="npkPegawaiCheckEdit"></span>
                            </div>
    
                         
  
                          {{-- edit pangkat --}}
                          <label for="" class="label-input">Pangkat</label>         
                          <select id="get-select-pangkat" name="kode_pangkat" onchange="GetGolonganFromPangkatToEdit()"   class="form-select" aria-label="Default select example">                        
                          </select>  
                          <span class="text-danger error-text kode-error" id="kode_pangkatPegawaiCheck"></span>
                           {{-- edit golongan --}}
                           <label for="" class="label-input">Golongan</label>     
                          <select id="get-select-golongan-pegawai" name="kode_golongan" class="form-select" aria-label="Default select example">
                          
                          </select>
  
                          <span class="text-danger error-text kode-error" id="kode_jabatanPegawaiCheckAdd"></span>
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
                            
                          
                                {{-- tgl_sk uir --}}
                                <div class="form-group mt-2">
                                  <label for="" class="label-input ">Tanggal SK Yayasan</label>
                                  <input type="date" class="form-control mb-2" id="tgl_sk_yayasan_pegawai_edit" name="tgl_sk_yayasan"
                                  value="" >
                                <span class="text-danger error-text kode-error" id="tgl_skPegawaiCheckEdit"></span>
                              </div>
                                {{-- tgl_sk uir --}}

                                <span class="text-danger fs-10 mt-3">Ditujukan untuk dosen dengan status dosen kontrak</span>
                                 {{-- tgl_sk uir kontrak --}}
                                 <div class="form-group">
                                  <label for="" class="label-input ">Mulai Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="start_tgl_sk_kontrak_pegawai_edit" name="start_tgl_sk_kontrak"
                                  value="" >
                                <span class="text-danger error-text kode-error" id="start_tgl_sk_kontrakPegawaiCheck"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
                                {{-- tgl_sk uir kontrak --}}
                                <div class="form-group">
                                  <label for="" class="label-input ">Berakhir Tanggal SK Kontrak</label>
                                  <input type="date" class="form-control mb-2" id="end_tgl_sk_kontrak_pegawai_edit" name="end_tgl_sk_kontrak"
                                  value="">
                                <span class="text-danger error-text kode-error" id="end_tgl_sk_kontrakPegawaiCheckAdd"></span>
                              </div>
                                {{-- tgl_sk uir kontrak --}}
      
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    
                  
                  </div>

                  <div class="tab-pane fade" id="verif-tab-pane" role="tabpanel" aria-labelledby="verif-tab" tabindex="0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-header">Verifikasi Dokumen</div>  
                          <div class="card-body">
                             {{-- verif pangkat --}}
                             <select class="form-select" name="verif_data_pangkat" id="get-select-verif-data-pangkat" aria-label="Default select example">
                              <option selected>Verif Dokumen Pangkat</option>
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