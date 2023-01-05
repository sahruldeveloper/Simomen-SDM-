<!-- aside -->
<aside>
     <div class="d-flex navigation flex-column  text-white bg-light" ">
          <div class="navbar-brand">
               <a href="#" class="d-flex text-white text-decoration-none">  
                    <img src="{{ url('backend/assets/image/Logo.png') }}" alt="">
                  </a>
          </div>
          <hr>
          <div class="navbar-daily">
               <span>Daily Use</span>
          </div>
          <ul class="nav  flex-column mb-auto">
            <li class="nav-item {{ Request:: path() === '' ? 'active' : '' }}  pb-2 pt-2">
              
              <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center " aria-current="page">
               <span class="icon">
                 <i class="bi bi-grid"></i>
                  </span>
               <span class="title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item pb-2 pt-2 {{ Request:: path() === 'admin/dosen' ? 'active' : '' }}">
              
               <a href="{{route('dosen.index')}}" class="nav-link d-flex align-items-center" aria-current="page">
                <span class="icon">
                 <i class="bi bi-mortarboard"></i>
                   </span>
                <span class="title">Data Dosen</span>
               </a>
             </li>
             <li class="nav-item pb-2 pt-2 {{ Request:: path() === 'admin/pegawai' ? 'active' : '' }}">
              
               <a href="{{route('pegawai.index')}}" class="nav-link d-flex align-items-center" aria-current="page">
                <span class="icon">
                 <i class="bi bi-people"></i>
                   </span>
                <span class="title">Data Pegawai</span>
               </a>
             </li>

             </li>
          

            

            


            
            
           
          </ul>
          <div class="navbar-daily">
            <span>Other</span>
          </div>
          <ul class="nav  flex-column mb-auto">
          
             <li class="nav-item pb-2 pt-2">
              
               <a href="#" class="nav-link d-flex align-items-center" aria-current="page">
                <span class="icon">
                 <i class="bi bi-people"></i>
                   </span>
                <span class="title">Setting Account</span>
               </a>
             </li>
             <li class="nav-item pb-2 pt-2">
              
              <form action="/logout" method="post">
                @csrf
                <button  type="submit" class="btn btn-primary d-flex align-items-center">Logout</button>
              </form>
              {{-- <a href="" class="nav-link d-flex align-items-center" aria-current="page">
               <span class="icon">
                <i class="bi bi-people"></i>
                  </span>
               <span class="title">Logout</span>
              </a> --}}
            </li>
           
          </ul>
        
        </div>
</aside>
<!-- aside -->