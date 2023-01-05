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
   @php
       
       if (auth()->check()) {
            return back();
        }
   @endphp
     <div class="wrapper-login">
          <div class="row header justify-content-between">
               <div class="col-md-8 logo">
                    <img src="{{url('backend/assets/image/Logo.png') }}" alt="">                    
               </div>
               <div class="col-md-4 d-none d-md-block branding">
                    <div class="card simomen-explain" >
                         <div class="card-body">
                           <h5 class="card-title">SIMOMEN( 
                             <span>SDM</span> )
                           </h5>
                           <p class="card-text">Adalah sebuah sistem yang diperuntukan untuk melakukan monitoring dan manajemen data Sumber Daya Manusia pada Yayasan Lembaga Pendidikan Islam (YLPI)</p>
                      
                         </div>
                       </div>
               </div>
          </div>
          
          <div class="row content-login">
            <div class="col-md-5  layout-login">
              <div class="title">
                <h3>SISTEM MONITORING DAN MANAJEMEN</h3>
                <h5>SUMBER DAYA MANUSIA</h5>
              </div>
              
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if(session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

              <form action="/login" method="post"   class="form-login">
              @csrf
                <div class="form-group mb-4">
                  <label for="">Email</label>
                  
                  <input type="text" name="email" id="email"  class="form-control form-input @error('email') is-invalid @enderror" placeholder="Masukan Email"  autofocus required >
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message}}
                      </div>
                  @enderror
    
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" id="password"  class="form-control form-input" placeholder="Masukan Password" aria-describedby="helpId" required>
    
                </div>

                <div class="d-grid gap-2">
                  <button class="btn btn-success" type="submit">Login</button>
               
                </div>
               
              </form>
              {{-- <a href="/register">register</a> --}}
              
            </div>
            <div class="col-md-6 d-none d-md-block col-sm-8 offset-1">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{url('backend/assets/image/Dashboard.png') }}" class="d-block" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{url('backend/assets/image/Dashboard.png') }}" class="d-block" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{url('backend/assets/image/Dashboard.png') }}" class="d-block" alt="...">
                  </div>
                </div>
              </div>
            </div>
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