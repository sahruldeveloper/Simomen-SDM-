@extends('layouts.admin')
 <!-- main  -->
 
 @section('content-admin')
 
 <div class="content-wrapper">
  <section class="dashboard-top-sec">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="bg-white top-chart-earn">
            <div class="row">
              <div class="col-sm-12 my-2 pe-0">
                <div class="last-month">
                  <h5>Dashboard</h5>
                  <p>Overview</p>
                 
                </div>
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
                      <div class="row">
                        <div class="col-md-6">
                          <div class="widget-content">
                            <div id="chart-pegawai-aktif"></div>
                          </div>
                        </div>
                        <div class="col-md-6 mr-4">
                          <div class="widget-content">
                            <div id="chart-pegawai-pensiun"></div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="widget-content">
                            <div id="chart-dosen-aktif"></div>
                          </div>
                        </div>
                        <div class="col-md-6 mr-4">
                          <div class="widget-content">
                            <div id="chart-dosen-pensiun"></div>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>

            

              
            </div>

          
          </div>
        </div>

        

        

       
      </div>

    
   
    </div>
  </section>

  <section>
    <div class="sm-chart-sec my-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-8 my-2">
            <div class="revinue revinue-one_hybrid">
              <div class="revinue-heading">
                <div class="w-title">
                  <div class="w-icon">
                    <span class="fas fa-users"></span>
                  </div>
                  <div class="sm-chart-text">
                    <p class="w-value">{{ $total_aktif_pegawai }}</p>
                    <h5>Pegawai Aktif</h5>
                  </div>
                </div>
              </div>
              <div class="revinue-content">
                <div id="hybrid-followers">

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-8 my-2">
            <div class="revinue revinue-one_hybrid">
              <div class="revinue-heading">
                <div class="w-title">
                  <div class="w-icon">
                    <span class="fas fa-users"></span>
                  </div>
                  <div class="sm-chart-text">
                    <p class="w-value">{{ $total_pensiun_pegawai }}</p>
                    <h5>Pegawai Pensiun</h5>
                  </div>
                </div>
              </div>
              <div class="revinue-content">
                <div id="hybrid-followers">

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-8 my-2">
            <div class="revinue revinue-one_hybrid">
              <div class="revinue-heading">
                <div class="w-title">
                  <div class="w-icon">
                    <span class="fas fa-users"></span>
                  </div>
                  <div class="sm-chart-text">
                    <p class="w-value">{{ $total_aktif_dosen }}</p>
                    <h5>Dosen Aktif</h5>
                  </div>
                </div>
              </div>
              <div class="revinue-content">
                <div id="hybrid-followers">

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-8 my-2">
            <div class="revinue revinue-one_hybrid">
              <div class="revinue-heading">
                <div class="w-title">
                  <div class="w-icon">
                    <span class="fas fa-users"></span>
                  </div>
                  <div class="sm-chart-text">
                    <p class="w-value">{{ $total_pensiun_dosen }}</p>
                    <h5>Dosen Pensiun</h5>
                  </div>
                </div>
              </div>
              <div class="revinue-content">
                <div id="hybrid-followers">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
  Highcharts.chart('chart-pegawai-aktif', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Statistik Pegawai Aktif'
      },
      subtitle: {
          text: 'Source: Yayasan Lembaga Pendidikan Islam'
      },
     
      xAxis: {
        categories: {!!$bulan_data_pegawai_aktif!!}
         
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Total'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} orang</b></td></tr> ',
             
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
        name: 'Aktif',
        data: {!!json_encode($pegawai_aktif)!!}
      },
     
    ]
      });

   

      Highcharts.chart('chart-pegawai-pensiun', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Statistik Pegawai Pensiun'
      },
      subtitle: {
          text: 'Source: Yayasan Lembaga Pendidikan Islam'
      },
     
      xAxis: {
        categories: {!!$bulan_data_pegawai_pensiun!!}
         
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Total'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} orang</b></td></tr> ',
             
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
        name: 'Pensiun',
        data: {!!json_encode($pegawai_pensiun)!!}
      },
     
    ]
      });


</script>

{{-- chart pegawai aktif --}}

{{-- Dosen --}}
<script>
  Highcharts.chart('chart-dosen-pensiun', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Dosen Pensiun'
    },
    subtitle: {
        text: 'Source: Yayasan Lembaga Pendidikan Islam'
    },
  
    xAxis: {
      categories: {!!$bulan_data_dosen_pensiun!!}
      
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} orang</b></td></tr> ',
          
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
  
    series: [{
      name: 'Pensiun',
      data: {!!json_encode($dosen_pensiun)!!}
    },
  
  ]
    });


</script>

<script>
  Highcharts.chart('chart-dosen-aktif', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Dosen Aktif'
    },
    subtitle: {
        text: 'Source: Yayasan Lembaga Pendidikan Islam'
    },
  
    xAxis: {
      categories: {!!json_encode($bulan_dosen_aktif)!!}
      
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} orang</b></td></tr> ',
          
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
      name: 'aktif',
      data: {!!json_encode($dosen_aktif)!!}
    },
  
  ]
    });


</script>
{{-- Dosen --}}


@endsection



