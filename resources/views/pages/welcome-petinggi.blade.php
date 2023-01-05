@extends('layouts.petinggi')
 <!-- main  -->
 
 @section('content-petinggi')
 
 <main id="main-content"  class="content content-welcome-petinggi d-flex flex-column">
  <div class="btn-hamburger">
    <button
      id="sidebarCollapseDefault"
      class="btn btn-hamburger border-0 p-0 d-none d-md-block"
      aria-label="hamburger-button"
    >
      <i class="fa-solid fa-bars icon-hamburger"></i>
    </button>
    <button
      id="sidebarCollapseMobile"
      data-bs-toggle="offcanvas"
      data-bs-target="#nav-sidebar"
      aria-controls="nav-sidebar"
      aria-label="hamburger-button"
      class="btn btn-hamburger border-0 p-0 d-block d-md-none"
    >
      <i class="fa-solid fa-bars icon-hamburger"></i>
    </button>
  </div>
 

  <div class="section-login-petinggi d-flex align-items-center">
    <div class="col text-center">
        <div class="img-petinggi">
            <img class=" rounded-circle" src="{{ asset('storage/assets/foto/' . Auth::guard('petinggi')->user()->foto) }}" alt="">
        </div>
      
        <div class="nama-pengurus mb-1 mt-1">
          <span class="badge bg-warning text-black">{{ Auth::guard('petinggi')->user()->nama}}</span>
        </div>
        
        <span class="jabatan-struktural">{{ Auth::guard('petinggi')->user()->jabatan_struktural }} (YLPI) </span>
        <h5 class="p-2 sambutan">Selamat Datang <br> Pada Sistem Monitoring dan manajemen SDM  <br> Yayasan Lembaga Pendidikan Islam (YLPI)</h5>
      
        <a href="{{ route('dashboard-petinggi')}}" class="btn btn-home-page mt-3 px-5">Dashboard</a>
    </div>
</div>
 
  </main>

 @endsection