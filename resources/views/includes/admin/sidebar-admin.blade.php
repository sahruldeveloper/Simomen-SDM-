<!-- START SIDEBAR -->
      <div class="left-menu">
        <div class="menubar-content">
          <nav class="animated bounceInDown">
            <ul id="sidebar">
              <li class="{{ Request:: path() === 'admin' ? 'active' : '' }}"> <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i></i>Dashboard</a></li>
        
              <li class="{{ Request:: path() === 'admin/dosen' ? 'active' : '' }}"> <a href="{{url('admin/dosen')}}"><i class="bi bi-files"></i>Data Dosen</a></li>
              <li class="{{ Request:: path() === 'admin/pegawai' ? 'active' : '' }}"> <a href="{{url('admin/pegawai')}}"><i class="bi bi-files"></i>Data Pegawai</a></li>
              <li class="{{ Request:: path() === 'admin/petinggiYLPI' ? 'active' : '' }}"> <a href="{{route('petinggiYLPI.index')}}"><i class="bi bi-files"></i>Data Pengurus YLPI</a></li>
              @php
              if(Auth::guard('staff-admin')->user()-> role == 'super-admin') {
          @endphp
                <li class="{{ Request:: path() === 'super-admin/dataStaff' ? 'active' : '' }}"> <a href="{{ route('staff-admin.index')}}"><i class="bi bi-files"></i>Data Staff</a></li>
           <?php }  ?>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-fw fa-building text-dark"></i>
          
              <span>Data Master</span> 
              </a>
              <ul class="dropdown-menu ">
                <li><a class="collapse-item " href="{{route('jabatan.index')}}">Jabatan Fungsional</a></li>
                <li>  <a class="collapse-item" href="{{route('pangkat.index')}}">Pangkat</a></li>
              <li>  <a class="collapse-item" href="{{route('golongan.index')}}">Golongan</a></li>
              <li>    <a class="collapse-item" href="{{route('fakultas.index')}}">Fakultas</a></li>
              <li>  <a class="collapse-item" href="{{route('jurusan.index')}}">Jurusan</a></li>
              </ul>
            </li>
           
            
                
         
           

              <!-- Nav Item - Pages Collapse Menu -->
    
     
          
            
             
            </ul>
          </nav>
        </div>
      </div>
      <!-- END SIDEBAR -->