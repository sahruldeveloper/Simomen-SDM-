<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('backend/assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
      body{
        background-image: url('backend/assets/image/background.png');
        background-size: cover;
        background-position: center;
      }
    </style>

    <title>Login</title>
  </head>
  <body>
     <div class="wrapper-login">
          <div class="row header justify-content-between">
               <div class="col-md-8 logo">
                    <img src="{{url('backend/assets/image/Logo.png') }}" alt="">                    
               </div>
               <div class="col-md-4 branding">
                    <div class="card simomen-explain" >
                         <div class="card-body">
                           <h5 class="card-title">SIMOMEN( 
                             <span>SDM</span>)
                           </h5>
                           <p class="card-text">Adalah sebuah sistem yang diperuntukan untuk melakukan monitoring dan manajemen data Sumber Daya Manusia pada Yayasan Lembaga Pendidikan Islam (YLPI)</p>
                      
                         </div>
                       </div>
               </div>
          </div>
          <div class="row content-login">
            <div class="col-md-6 layout-login">
              <div class="title">
                <h3>SISTEM MONITORING DAN MANAJEMEN</h3>
                <h5>SUMBER DAYA MANUSIA</h5>
              </div>

              {{-- validasi form --}}
          {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
              {{-- akhir validasi form --}}
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if(session()->has('loginError'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('loginError')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

              <form action="/register" method="post"   class="form-login">
              @csrf
               <div class="form-group mb-4">
                  <label for="">Nama</label>
                  
                  <input type="text" name="nama" id="nama"  class="form-control  @error('nama')is-invalid @enderror" placeholder="Masukan Nama" value="{{old('email') }}">
                  <p class="text-danger">{{ $errors->first('nama') }}</p>
    
                </div>
                <div class="form-group mb-4">
                  <label for="">Email</label>
                  
                  <input type="text" name="email" id="email"  class="form-control form-input @error('email') is-invalid @enderror" placeholder="Masukan Email" aria-describedby="helpId" value="{{old('email') }}" >
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message}}
                      </div>
                  @enderror
    
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="text" name="password" id="password"  class="form-control form-input @error('password') is-invalid @enderror" placeholder="Masukan Password" aria-describedby="helpId">
                  @error('password')
                  <div class="invalid-feedback">
                    {{ $message}}
                  </div>
              @enderror

                </div>

               <button class="btn btn-lg btn-login text-light" type="submit">Register</button>
              </form>
              
            </div>
            {{-- <div class="col-md-6 col-sm-8">
              <div id="carousel3" class="carousel  slide mb-5" data-ride="carousel">
                <ol class="carousel-indicators ">
                  <li data-target="#carousel3" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel3" data-slide-to="1"></li>
                  <li data-target="#carousel3" data-slide-to="2"></li>
                </ol>
      
                <div class="carousel-inner" style="width: 600px; height: 400px;">
                  <div class="carousel-item active">
                    <img class="d-block img-fluid " src="{{url('backend/assets/image/simomen-1.png') }}" alt="Gambar 1">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid rounded" src="assets/image/simomen-1.png" alt="Gambar 2">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid rounded" src="assets/image/simomen-1.png" alt="Gambar 3">
                  </div>
                </div>
      
                <a href="#carousel3" class="carousel-control-prev" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
      
                <a href="#carousel3" class="carousel-control-next" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
              </div>
            </div> --}}
          </div>
         
     </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   
  </body>
</html>