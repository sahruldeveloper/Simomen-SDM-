<nav
      id="nav-sidebar"
      class="sidebar offcanvas-md offcanvas-start"
      data-bs-scroll="true"
    >
      <div class="d-flex justify-content-end mt-3 me-4 d-block d-md-none">
        <button
          aria-label="Close"
          data-bs-dismiss="offcanvas"
          data-bs-target="#nav-sidebar"
          class="btn border-0 p-0 fs-4"
        >
          <i class="fas fa-close"></i>
        </button>
      </div>
      <div
        class="d-flex flex-column gap-1 align-items-center object-fit-contain mt-3 mt-md-5 mb-5"
      >
      <div class="nav-brand">
        <img src="{{ url('frontend/img/logo-ylpi.png') }}"  alt="">
        <p class="fw-bold fs-5 mt-3 color-primary">SIMOMEN</p>
        <p class="color-secondary">YLPI RIAU</p>
      </div>
        
      </div>
      <div class="menus d-flex flex-column gap-4">
        <p class="kategori color-secondary">Daily Use</p>
        <a href="{{ url('petinggi/') }}" class="item-menu {{ Request:: path() === 'petinggi' ? 'active' : '' }}">
          <svg class="icon-sidebar" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 14H14V21H21V14Z" stroke="currentColor" />
            <path d="M10 14H3V21H10V14Z" stroke="currentColor" />
            <path d="M21 3H14V10H21V3Z" stroke="currentColor" />
            <path d="M10 3H3V10H10V3Z" stroke="currentColor" />
          </svg>
          <p>Dashboard</p>
        </a>
        <a href="{{ url('petinggi/halaman-dosen-petinggi') }}" class="item-menu {{ Request:: path() === 'petinggi/halaman-dosen-petinggi' ? 'active' : '' }} ">
          <svg class="icon-sidebar" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_24_22)">
            <rect width="32" height="32" fill="#F8F9FD"/>
            <path d="M4 5H28V29C28 30.6569 26.6569 32 25 32H7C5.34315 32 4 30.6569 4 29V5Z" fill="currentColor"/>
            <rect opacity="0.5" x="24" y="24" width="4" height="16" rx="2" transform="rotate(90 24 24)" fill="white"/>
            <rect x="17" y="17" width="4" height="9" rx="2" transform="rotate(90 17 17)" fill="white"/>
            <path d="M28 5.5L3.99996 5.5L3.99997 3.99997C3.99999 1.79084 5.79084 1.39627e-06 7.99997 1.5894e-06L24 2.98817e-06C26.2091 3.1813e-06 28 1.79087 28 4.00001L28 5.5Z" fill="currentColor"/>
            </g>
            <defs>
            <clipPath id="clip0_24_22">
            <rect width="32" height="32" fill="white"/>
            </clipPath>
            </defs>
            </svg>
            
            
          <p>Data Dosen</p>
        </a>
        <a href="{{ url('petinggi/halaman-pegawai-petinggi') }}" class="item-menu {{ Request:: path() === 'petinggi/halaman-pegawai-petinggi' ? 'active' : '' }}">
          <svg class="icon-sidebar" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_24_18)">
            <rect width="32" height="32" fill="#F8F9FD"/>
            <path d="M0 13H32V23C32 26.866 28.866 30 25 30H7C3.13401 30 0 26.866 0 23V13Z" fill="currentColor"/>
            <rect x="16" y="20" width="4" height="12" rx="2" transform="rotate(90 16 20)" fill="white"/>
            <path d="M32 11L1.90735e-06 11L1.99477e-06 10C4.25397e-07 6.13402 3.13401 3.00001 7 3.00001L25 3.00001C28.866 3.00001 32 6.134 32 9.99997L32 11Z" fill="currentColor"/>
            </g>
            <defs>
            <clipPath id="clip0_24_18">
            <rect width="32" height="32" fill="white"/>
            </clipPath>
            </defs>
            </svg>
            
          <p>Data Pegawai</p>
        </a>
        <p class="kategori color-secondary mt-5">Other</p>
        <a href="{{ route('profile-petinggi.edit',  Auth::guard('petinggi')->user()->id) }}" class="item-menu {{ Request:: path() === 'petinggi/profile-petinggi' ? 'active' : '' }}">
        
          <svg class="icon-sidebar"  viewBox="0 0 39 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_808_595)">
            <rect width="38.9371" height="32" fill="#F8F9FD"/>
            <path d="M13.1206 2.74732C13.8138 -0.321413 18.1862 -0.321412 18.8794 2.74733C19.3287 4.73618 21.611 5.68155 23.335 4.59288C25.9951 2.91311 29.0869 6.00493 27.4071 8.665C26.3185 10.389 27.2638 12.6713 29.2527 13.1206C32.3214 13.8138 32.3214 18.1862 29.2527 18.8794C27.2638 19.3287 26.3185 21.611 27.4071 23.335C29.0869 25.9951 25.9951 29.0869 23.335 27.4071C21.611 26.3185 19.3287 27.2638 18.8794 29.2527C18.1862 32.3214 13.8138 32.3214 13.1206 29.2527C12.6713 27.2638 10.389 26.3185 8.665 27.4071C6.00493 29.0869 2.91311 25.9951 4.59288 23.335C5.68155 21.611 4.73618 19.3287 2.74732 18.8794C-0.321413 18.1862 -0.321412 13.8138 2.74733 13.1206C4.73618 12.6713 5.68155 10.389 4.59288 8.665C2.91311 6.00493 6.00493 2.91311 8.665 4.59288C10.389 5.68155 12.6713 4.73618 13.1206 2.74732Z" fill="#848BA2"/>
            <circle cx="16" cy="16" r="4" fill="white"/>
            </g>
            <defs>
            <clipPath id="clip0_808_595">
            <rect width="38.9371" height="32" fill="white"/>
            </clipPath>
            </defs>
            </svg>
      
          <p>Setting Account</p>
        </a>
     
       
        @auth
        <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="POST">
         @csrf
         <svg class="icon-sidebar" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_709_1115)">
          <rect width="32" height="32" fill="#F8F9FD"/>
          <path d="M17 7C17 5.34315 18.3431 4 20 4H29C30.6569 4 32 5.34315 32 7V26C32 27.6569 30.6569 29 29 29H20C18.3431 29 17 27.6569 17 26V7Z" fill="#5C697C"/>
          <path d="M0 7.80558C0 5.94364 1.28471 4.32793 3.09878 3.90843L15.0988 1.13341C17.6057 0.55368 20 2.45747 20 5.03057V26.9694C20 29.5425 17.6057 31.4463 15.0988 30.8666L3.09879 28.0916C1.28472 27.6721 0 26.0564 0 24.1945V7.80558Z" fill="#848BA2"/>
          <circle cx="14.5" cy="16.5" r="2.5" fill="white"/>
          </g>
          <defs>
          <clipPath id="clip0_709_1115">
          <rect width="32" height="32" fill="white"/>
          </clipPath>
          </defs>
          </svg>
          <button class="btn  btn-logout my-2 my-sm-0 px-4" type="submit">
            Logout
          </button>
          
       </form>
       <!-- Desktop Button -->
       <form class="form-inline my-lg-0 mt-5 d-none d-md-block" action="{{ url('logout') }}" method="POST">
         @csrf
       <div class="icon-logout mt-5">
        
        <svg class="icon-sidebar" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_709_1115)">
          <rect width="32" height="32" fill="#F8F9FD"/>
          <path d="M17 7C17 5.34315 18.3431 4 20 4H29C30.6569 4 32 5.34315 32 7V26C32 27.6569 30.6569 29 29 29H20C18.3431 29 17 27.6569 17 26V7Z" fill="#5C697C"/>
          <path d="M0 7.80558C0 5.94364 1.28471 4.32793 3.09878 3.90843L15.0988 1.13341C17.6057 0.55368 20 2.45747 20 5.03057V26.9694C20 29.5425 17.6057 31.4463 15.0988 30.8666L3.09879 28.0916C1.28472 27.6721 0 26.0564 0 24.1945V7.80558Z" fill="#848BA2"/>
          <circle cx="14.5" cy="16.5" r="2.5" fill="white"/>
          </g>
          <defs>
          <clipPath id="clip0_709_1115">
          <rect width="32" height="32" fill="white"/>
          </clipPath>
          </defs>
          </svg>
          <button class="btn  btn-logout my-2 my-sm-0 px-4" type="submit">
            Logout
          </button>
       </div>
       </form>
        @endauth
       
      </div>
    </nav>

   