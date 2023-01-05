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
  <h4 class="fw-bold color-primary">Dashboard</h4>
 
  <div class="row">
    <div class="col-sm-6 my-2 ps-0">
      <div class="classic-tabs">
        <ul class="nav nav-pills mb-3 chart-header-tab" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a href="#" class="nav-link chart-nav active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-week" type="button" role="tab" aria-controls="pills-week" aria-selected="true">Pegawai</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link chart-nav" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-month" type="button" role="tab" aria-controls="pills-month" aria-selected="false">Dosen</a>
          </li>
          
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-week" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="widget-content">
              <div id="chart-pegawai-petinggi"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="widget-content">
              <div id="chart-dosen-petinggi"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-year" role="tabpanel" aria-labelledby="pills-contact-tab">Year</div>
        </div>
      </div>
    </div>

    <div class="col-md-6 content-card-numbers">
         <div class="row ">

             <div class=" col-xl-6 col-sm-6">
               <div style="background-color: #004029"  class="card card-numbers shadow-sm">
                   <div class="card-body ">
                     <div class="col-4">
                       <div class="icon icon-shape  shadow text-center border-radius-md">
                        <i class="bi bi-person-badge text-lg-center"></i>
                       </div>
                     </div>

                     <div class="col-8">
                       <div class="numbers">
                         <h4 class=" mb-0">
                           {{ $total_aktif_pegawai }}
                         </h4>
                           <h5 class=" mb-0">Pegawai (Aktif)</h5>
                           
                       </div>
                   </div>
                   
                   </div>
               </div>
               </div>

             <div class=" col-xl-6 col-sm-6">
                 <div style="background-color: white" class="card card-numbers shadow-sm">
                     <div class="card-body p-3">
                         <div class="row">
                             <div class="col-9">
                                 <div class="numbers">
                                   
                                     <h4 class=" mb-0 text-black fw-bolder">
                                      {{ $total_pensiun_pegawai }}
                                     </h4>
                                     <h5 class=" mb-0 text-black" >Pegawai (Pensiun) </h5>
                                 </div>
                             </div>
                             <div class="col-md-2 card-icon-dashboard">
                                 <div class="icon icon-shape  shadow text-center border-radius-md">
                                  <i class="bi bi-person-badge-fill"></i>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class=" col-xl-6 col-sm-6">
               <div style="background-color: white" class="card  card-numbers mb-4 shadow-sm">
                   <div class="card-body p-3">
                       <div class="row">
                           <div class="col-9">
                               <div class="numbers">
                                 
                                   <h4 class=" mb-0 text-black fw-bolder">
                                    {{ $total_pensiun_dosen }}
                                   </h4>
                                   <h5 class=" mb-0 text-black" >Dosen (Pensiun) </h5>
                               </div>
                           </div>
                           <div class="col-md-2 card-icon-dashboard">
                               <div class="icon icon-shape shadow text-center border-radius-md">
                                <i class="bi bi-file-person-fill"></i>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
                       

             <div class=" col-xl-6 col-sm-6">
               <div style="background-color: #004029"  class="card card-numbers shadow-sm">
                   <div class="card-body ">
                     <div class="col-4">
                       <div class="icon icon-shape  shadow text-center border-radius-md">
                        <i class="bi bi-file-person"></i>
                       </div>
                     </div>

                     <div class="col-8">
                       <div class="numbers">
                         <h4 class=" mb-0">
                          {{ $total_aktif_dosen }}
                         </h4>
                           <h5 class=" mb-0">Dosen (Aktif)</h5>
                           
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
       

       
         @foreach ($data_dosen as $item)
         <tr class="baris">
          <td>
            <div class="d-flex align-items-center">
              <img class="img-information mb-1" src="{{ asset('storage/assets/foto/' . $item->foto) }}" alt=""  class="rounded-circle">
              <div class="ms-3">
                <p class="fw-bold mb-0">{{ $item->pegawai->nama }}</p>
                <p class="text-muted mb-0">{{ $item->pegawai->email }}</p>
              </div>
            </div>
          </td>
          <td>
            @php
                if($item->status == 'Pensiun') {
                  echo '<span class="badge rounded-pill text-bg-secondary">'. $item->pegawai->status. '</span>';
                }
                else {
                  echo '<span class="badge rounded-pill text-bg-success">'. $item->pegawai->status. '</span>';
                }
            @endphp
          </td>
          <td><p class="fw-bold mb-0">{{ $item->pegawai->tgl_sk_yayasan }}</p></td>
        </tr>
         @endforeach

         
         
        
        
       </table>
     </div>
   </div>

   <div class="col-md-6 monitor">
     <div class="card card-information card-right">
       <h5 class="text-center fw-bold">Informasi Pegawai Terbaru</h5>
       <hr>
       <table class="table table-responsive sdm-information align-middle">
        @foreach ($data_pegawai as $item)
        <tr class="baris">
          <td>
            <div class="d-flex align-items-center">
              <img class="img-information mb-1" src="{{ asset('storage/assets/foto/' . $item->foto) }}" alt=""  class="rounded-circle">
              <div class="ms-3">
                <p class="fw-bold mb-0">{{ $item->nama }}</p>
                <p class="text-muted mb-0">{{ $item->email }}</p>
              </div>
            </div>
          </td>
          <td>
            @php
                if($item->status == 'Pensiun') {
                  echo '<span class="badge rounded-pill text-bg-secondary">'. $item->status. '</span>';
                }
                else {
                  echo '<span class="badge rounded-pill text-bg-success">'. $item->status. '</span>';
                }
            @endphp
           
          </td>
          <td><p class="fw-bold mb-0">{{ $item->tgl_sk_yayasan }}</p></td>
        </tr>
        @endforeach

       

         
         
        
        
       </table>
     </div>
   </div>
  </div>
</main>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

Highcharts.chart('chart-pegawai-petinggi', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Statistik Pegawai'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
      
        colorByPoint: true,
        data: [{
            name: 'Aktif',
           
          y: {!!json_encode($total_aktif_pegawai)!!},
            sliced: true,
            selected: true
        }, {
            name: 'Pensiun',
            y:  {!!json_encode($total_pensiun_pegawai)!!},
        }]
    }]
});
</script>
  
</script>

<script>
 Highcharts.chart('chart-dosen-petinggi', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Statistik Dosen'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
       
        colorByPoint: true,
        data: [{
            name: 'Aktif',
           
          y: {!!json_encode($total_aktif_dosen)!!},
            sliced: true,
            selected: true
        }, {
            name: 'Pensiun',
            y:  {!!json_encode($total_pensiun_dosen)!!},
        }]
    }]
});
  
</script>

 @endsection