 <!-- NAVBAR -->
 <div class="header-container fixed-top">
     <header class="header navbar bg-white navbar-expand-sm expand-header fixed-top">
       <div class="header-left d-flex">
         <div class="logo">
           Simomen
         </div>
         <a href="#" class="sidebarCollapse" id="toogleSidebar" data-placement="bottom">
           <span class="fas fa-bars"></span>
         </a>
       </div>
       <ul class="navbar-item flex-row ml-auto">
         {{-- <li class="nav-item dropdown user-profile-dropdown ">
           <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
             <img src="{{ url('backend/assets/icon/bell.png') }}" alt="" class="icon">
             <p class="count purple-gradient">5</p>
           </a>
           <div class="dropdown-menu">
             <div class="dp-main-menu">
               <a href="" class="dropdown-item message-item">
                 <img src="{{ url('backend/assets/icon/servers.png') }}" alt="" class="user-note">
                 <div class="note-info-desmis">
                   <div class="user-notify-info">
                     <p class="note-name">Server Rebooted</p>
                     <p class="note-time">20 min ago</p>
                     
                   </div>
                   <p href="" class="status-link"><span class="fas fa-times"></span></p>
                 </div>
               </a>

               <a href="" class="dropdown-item message-item">
                 <img src="{{ url('backend/assets/icon/servers.png') }}" alt="" class="user-note">
                 <div class="note-info-desmis">
                   <div class="user-notify-info">
                     <p class="note-name">Server Rebooted</p>
                     <p class="note-time">20 min ago</p>
                     
                   </div>
                   <p href="" class="status-link"><span class="fas fa-times"></span></p>
                 </div>
               </a>

               <a href="" class="dropdown-item message-item">
                 <img src="{{ url('backend/assets/icon/servers.png') }}" alt="" class="user-note">
                 <div class="note-info-desmis">
                   <div class="user-notify-info">
                     <p class="note-name">Server Rebooted</p>
                     <p class="note-time">20 min ago</p>
                     
                   </div>
                   <p href="" class="status-link"><span class="fas fa-times"></span></p>
                 </div>
               </a>

               <a href="" class="dropdown-item message-item">
                 <img src="{{ url('backend/assets/icon/servers.png')}}" alt="" class="user-note">
                 <div class="note-info-desmis">
                   <div class="user-notify-info">
                     <p class="note-name">Server Rebooted</p>
                     <p class="note-time">20 min ago</p>
                     
                   </div>
                   <p href="" class="status-link"><span class="fas fa-times"></span></p>
                 </div>
               </a>
             </div>
           </div>
         </li> --}}
{{-- 
         <li class="nav-item dropdown user-profile-dropdown ">
           <a href="" class="nav-link user" id="notify" data-bs-toggle=""dropdown>
             <img src="{{ url('backend/assets/icon/email.png') }}" alt="" class="icon">
             <p class="count purple-gradient">5</p>
           </a>
         </li> --}}
         <li class="nav-item dropdown user-profile-dropdown mt-3 mr-5 ">
          <p>Halo, {{Auth::guard('staff-admin')->user()->nama }}</p>
         </li>

        
         <li class="nav-item dropdown user-profile-dropdown ">
           <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
             <img src="{{ url('backend/assets/icon/profile.png') }}" alt="" class="icon">
             <p class="count">5</p>
           </a>
           <div class="dropdown-menu dropdown-menu-profile ">
             <div class="user-profile-section">
               <div class="media mx-auto">
                 <img src="{{ url('backend/assets/icon/profile.png') }}" alt="" class="img-fluid img-profile mr-2">
                 <div class="media-body">
                   <h5>Sahrul Gunawan</h5>
                   <p>Super admin</p>
                 </div>
               </div>
             </div>
             <div class="dp-main-menu">
           
              <a href="{{ route('profile-admin.edit', Auth::guard('staff-admin')->user()->id) }}" class="dropdown-item">
                Edit Profile
            </a>
               <a href="" class="dropdown-item"><span class="fas fa-message"></span>Inbox</a>
               @auth
               <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="POST">
                @csrf
                <button class="btn btn-login my-2 my-sm-0" type="submit" >
                  Logout
                </button>
              </form>
              <!-- Desktop Button -->
              <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}" method="POST">
                @csrf
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                  Logout
                </button>
              </form>
               @endauth
             </div>
           </div>
           
         </li>
         {{-- <li class="nav-item dropdown user-profile-dropdown ">
           <a href="" class="nav-link user" id="notify" data-bs-toggle=""dropdown>
             <img src="{{ url('backend/assets/icon/settings.png') }}" alt="" class="icon">
             <p class="count bg-clc">5</p>
           </a>
         </li> --}}
       </ul>
     </header>
   </div>
   <!-- END NAVBAR -->