@extends('layouts.petinggi')
 <!-- main  -->
 

 @section('content')
 
   <!-- main  -->
   <div class="main ">
     <div class="topbar d-flex justify-content-between ">
      <!-- <div class="toggle">
           <ion-icon name="menu"></ion-icon>
      </div> -->
      <div class="topbar-title">
           <h5>Dashboard</h5>
           <span>Manage data for growth</span>
      </div>
      {{-- <div class="wrap-content-topbar d-flex">
           <div class="name-user">
             <span>Halo, {{ Auth::user()->nama }}</span>
           </div>
           <div class="user">
                <img src="{{url('backend/assets/image/profile.png') }}" alt="">
           </div>
      </div> --}}
      
     </div>

     <!-- content -->
     <div class="content">
      

       <div class="row">

      
         <div class="col-md-6">
          <div class="card">
            <div id="chart-sdm"></div>
          </div>
         </div>

         <div class="col-md-6">
              <div class="row ">

                  <div class=" col-xl-6 col-sm-6">
                    <div style="background-color: #004029"  class="card card-numbers rounded shadow-sm">
                        <div class="card-body ">
                          <div class="col-4">
                            <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                              <i class="bi bi-person text-lg-center"></i>
                            </div>
                          </div>

                          <div class="col-8">
                            <div class="numbers">
                              <h4 class=" mb-0">
                                982
                              </h4>
                                <h5 class=" mb-0">Pegawai (Aktif)</h5>
                                
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    </div>

                  <div class=" col-xl-6 col-sm-6">
                      <div style="background-color: #DCE2F4" class="card  card-numbers mb-4 rounded shadow-sm">
                          <div class="card-body p-3">
                              <div class="row">
                                  <div class="col-9">
                                      <div class="numbers">
                                        
                                          <h4 class=" mb-0 text-black fw-bolder">
                                              200
                                          </h4>
                                          <h5 class=" mb-0 text-black" >Pegawai (Pensiun) </h5>
                                      </div>
                                  </div>
                                  <div class="col-md-2 card-icon-dashboard">
                                      <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                        <i class="bi bi-mortarboard text-lg-center"></i>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class=" col-xl-6 col-sm-6">
                    <div style="background-color: #DCE2F4" class="card  card-numbers mb-4 rounded shadow-sm">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-9">
                                    <div class="numbers">
                                      
                                        <h4 class=" mb-0 text-black fw-bolder">
                                            200
                                        </h4>
                                        <h5 class=" mb-0 text-black" >Pegawai (Pensiun) </h5>
                                    </div>
                                </div>
                                <div class="col-md-2 card-icon-dashboard">
                                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                      <i class="bi bi-mortarboard text-lg-center"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            

                  <div class=" col-xl-6 col-sm-6">
                    <div style="background-color: #004029"  class="card card-numbers rounded shadow-sm">
                        <div class="card-body ">
                          <div class="col-4">
                            <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                              <i class="bi bi-person text-lg-center"></i>
                            </div>
                          </div>

                          <div class="col-8">
                            <div class="numbers">
                              <h4 class=" mb-0">
                                982
                              </h4>
                                <h5 class=" mb-0">Pegawai (Aktif)</h5>
                                
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    </div>

                 
                              
                            
                      
                </div>
         </div>

         <div class="col-md-6 monitor">
          <div class="card card-information card-right">
            <h5 class="text-center fw-bold">Informasi Dosen Terbaru</h5>
            <hr>
            <table class="table table-responsive sdm-information align-middle">
            

              <tr class="baris">
                <td>
                  <div class="d-flex align-items-center">
                    <img class="img-information mb-1" src="{{ url('backend/assets/image/profile.png') }}" alt=""  class="rounded-circle">
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Sahrul Gunawan</p>
                      <p class="text-muted mb-0">Sahrulgunawan @gmail.com</p>
                    </div>
                  </div>
                </td>
                <td><span class="badge rounded-pill bg-success">Active</span>
                </td>
                <td><p class="fw-bold mb-0">Hari ini</p></td>
              </tr>
              <tr class="baris">
                <td>
                  <div class="d-flex align-items-center">
                    <img class="img-information mb-1" src="{{ url('backend/assets/image/profile.png') }}" alt=""  class="rounded-circle">
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Sahrul Gunawan</p>
                      <p class="text-muted mb-0">Sahrulgunawan @gmail.com</p>
                    </div>
                  </div>
                </td>
                <td><span class="badge rounded-pill bg-success">Active</span>
                </td>
                <td><p class="fw-bold mb-0">Hari ini</p></td>
              </tr>

              
              
             
             
            </table>
          </div>
        </div>

        <div class="col-md-6 monitor">
          <div class="card card-information card-right">
            <h5 class="text-center fw-bold">Informasi Pegawai Terbaru</h5>
            <hr>
            <table class="table table-responsive sdm-information align-middle">
              <tr class="baris">
                <td>
                  <div class="d-flex align-items-center">
                    <img class="img-information mb-1" src="{{ url('backend/assets/image/profile.png') }}" alt=""  class="rounded-circle">
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Sahrul Gunawan</p>
                      <p class="text-muted mb-0">Sahrulgunawan @gmail.com</p>
                    </div>
                  </div>
                </td>
                <td><span class="badge rounded-pill bg-success">Active</span>
                </td>
                <td><p class="fw-bold mb-0">Hari ini</p></td>
              </tr>

              <tr class="baris">
                <td>
                  <div class="d-flex align-items-center">
                    <img class="img-information mb-1" src="{{ url('backend/assets/image/profile.png') }}" alt=""  class="rounded-circle">
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Sahrul Gunawan</p>
                      <p class="text-muted mb-0">Sahrulgunawan @gmail.com</p>
                    </div>
                  </div>
                </td>
                <td><span class="badge rounded-pill bg-success">Active</span>
                </td>
                <td><p class="fw-bold mb-0">Hari ini</p></td>
              </tr>

              
              
             
             
            </table>
          </div>
        </div>
       </div>
         

        

         
      
   </div>
   
     <!-- content -->
</div>
    <!-- main  -->
 @endsection