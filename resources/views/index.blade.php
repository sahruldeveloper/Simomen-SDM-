<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">

   <!-- my fonts -->
   <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">

   <!-- my css -->
   <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">
   <title>Sistem Monitoring dan Manajemen</title>
</head>

<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
         <a class="navbar-brand" href="#">SIMOMEN</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
               <!--membuat agar kekanan -->
               <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
               <a class="nav-item nav-link" href="#">Petinggi YLPI</a>
               <a class="nav-item nav-link" href="#">Struktur</a>
               <a class="nav-item nav-link " href="#">About</a>
         {{-- mobile button --}}
         @guest
         
        
         {{-- dekstop button --}}
         @endguest

      @php
          if (Auth::guard('petinggi')->check() || Auth::guard('staff-admin')->check()) {
      @endphp      
          <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="POST">
            @csrf
          <button class="btn btn-login my-2 my-sm-0" type="submit">
              Masuk
            </button>
          </form>
          <!-- Desktop Button -->
          <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}" method="POST">
            @csrf
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
              Keluar
            </button>
          </form>   
      @<?php }else { ?>
        <form  class="form-inline d-sm-block d-md-none">
           <button class="btn tbn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{ url('login')}}';">Masuk</button>
         </form>
         {{-- mobile button --}}

         {{-- dekstop button --}}
         <form class="form-inline my-2 my-lg-0 d-none d-md-block">
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{ url('login')}}';">
            Masuk
          </button>
         </form>
        <?php } ?>
            
       
       

            </div>
         </div>
      </div>
   </nav>
   <!-- akhir navbar -->

   <!-- jumbotron -->
   <div class="jumbotron jumbotron-fluid">
      <div class="container">
         <h1 class="display-4">Selamat Datang di <br><span> Sistem Monitoring dan Manajemen   </span> <br><span>Sumber Daya Manusia</span> 
            <br>Yayasan Lembaga Pendidikan Islam Riau </h1>
         <!-- <a href="" class="btn btn-utama tombol">OUR WORK</a> -->

      </div>
   </div>
   <!-- akhir jumbotron -->

   <!-- container -->
   <div class="container">
      <!-- info panel -->
      <section class="section-stats row justify-content-center" id="stats">
        <div class="col-3 col-md-2 stats-detail">
          <h2>{{$total_aktif_pegawai }}</h2>
          <p>Pegawai Aktif</p>
        </div>
        <div class="col-3 col-md-2 stats-detail">
          <h2>{{$total_pensiun_pegawai }}</h2>
          <p>Pegawai Pensiun</p>
        </div>
        <div class="col-3 col-md-2 stats-detail">
          <h2>{{$total_aktif_dosen }}</h2>
          <p>Dosen Aktif</p>
        </div>
        <div class="col-3 col-md-2 stats-detail">
          <h2>{{$total_pensiun_dosen }}</h2>
          <p>Dosen Pensiun</p>
        </div>
      </section>
      <!-- akhir info panel -->
   </div>
   <!-- akhir container -->

   <section class="section-petinggi" id="petinggi">
      <div class="container">
        <div class="row">
          <div class="col text-center section-petinggi-heading">
            <h2>Petinggi Yayasan</h2>
          </div>
        </div>
      </div>
    </section>
    <section class="section-petinggi-content" id="petinggiContent">
      <div class="container">
        <div class="section-petinggi-profile row justify-content-center">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div
              class="card-petinggi text-center d-flex flex-column"
              style="background-image: {{ url('frontend/img/Prabowo-Presidenku.jpg') }}');"
            >
            <div class="wrapper-name-bidang">
              <div class="petinggi-name">RIDWAN KAMIL</div>
              <div class="petinggi-bidang">PENDIDIKAN</div>
              <div class="petinggi-button mt-auto">
                <a href="details.html" class="btn btn-travel-details px-4">
                  View Details
                </a>
              </div>
            </div>
             
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div
              class="card-petinggi text-center d-flex flex-column"
              style="background-image: {{ url('frontend/img/ridwan-kamil.jpg') }});"
            >
            <div class="wrapper-name-bidang">
              <div class="petinggi-name">RIDWAN KAMIL</div>
              <div class="petinggi-bidang">PENDIDIKAN</div>
              <div class="petinggi-button mt-auto">
                <a href="details.html" class="btn btn-travel-details px-4">
                  View Details
                </a>
              </div>
            </div>
             
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div
              class="card-petinggi text-center d-flex flex-column"
              style="background-image: {{url('frontend/img/jokowi-presiden.jpg') }};"
            >
            <div class="wrapper-name-bidang">
              <div class="petinggi-name">JOKOWI DODO</div>
              <div class="petinggi-bidang">PENDIDIKAN</div>
              <div class="petinggi-button mt-auto">
                <a href="details.html" class="btn btn-travel-details px-4">
                  View Details
                </a>
              </div>
            </div>
             
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div
              class="card-petinggi text-center d-flex flex-column"
              style="background-image: {{ url('frontend/img/Susi-Pudjiastuti.jpg') }};"
            >
            <div class="wrapper-name-bidang">
              <div class="petinggi-name">SUSI PUDJIASTUTI</div>
              <div class="petinggi-bidang">PENDIDIKAN</div>
              <div class="petinggi-button mt-auto">
                <a href="details.html" class="btn btn-travel-details px-4">
                  View Details
                </a>
              </div>
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-title-about" id="petinggi">
      <div class="container">
        <div class="row">
          <div class="col text-center section-petinggi-heading">
            <h2>About</h2>
          </div>
        </div>
      </div>
    </section>

    <section class ="about">
      <div class="container">
      <p>Yayasan Lembaga  Pendidikan Islam (YLPI) berdiri pada tanggal 30 Maret 1957, berdasarkan akte notaris Syawal Sutan Diatas No. 10/157 dengan ketua umum Soeman Hs dan ketua harian Zaini Kunin. Akte YLPI ini mengalami beberapa kali perubahan dan penyempurnaan. Namun, nama Soeman Hs dan Zaini Kunin selalu menempati posisi penting dalam mengomandokan kegiatan-kegiatan yayasan tersebut.</p>
      </div>
     
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="footer-col">
              <div class="brand">
                <img src="{{ url('frontend/img/logo-ylpi.png') }}" alt="" class="rounded">
                <h1>YAYASAN LEMBAGA PENDIDIKAN ISLAM RIAU</h1>
              </div>
                <p class="tentang">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat illo nesciunt quos officiis asperiores aliquid pariatur architecto voluptates. Quidem eaque ipsa pariatur officiis reiciendis quam alias repellendus? Possimus, cumque vitae.</p>
                <ul class="sosmed">
                  <li><a href=""><i class="fab fa-facebook"></i></a></li>
                  <li><a href=""><i class="fab fa-instagram"></i></a></li>
                  <li><a href=""><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
          </div>

          <div class="col-md-4">
            <div class="footer-col">
              <h2>Kontak</h2>
              <p class="alamat">Jl. Kaharudin Nasution</p>
              <ul class="kontak">
                <li><i class="fa fa-phone" aria-hidden="true"></i>Telp/Fax : 0892323121</li>
                <li><i class="fas fa-envelope"></i>Email : humas@teamverrul.com</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="footer-col">
              <h2>Navigasi</h2>
              <ul class="footer-nav">
                <li><a href="">Profil</a></li>
                <li><a href="">Visi dan Misi</a></li>
                <li><a href="">Struktur Organisasi</a></li>
                <li><a href="">Sumber Daya Manusia</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>


   

















   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ url('frontend/js/jquery-3.4.1.min.js') }}"></script>

   <script src="{{ url('frontend/js/popper.min.js') }}"></script>
   <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
</body>

</html>