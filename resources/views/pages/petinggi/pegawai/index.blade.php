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
  <h4 class="fw-bold color-primary">Data Pegawai</h4>
 
 
  <div class="content-wrapper">

     <div class="row mb-3">
      <div class="row mb-3">
        <div class="col-md-5">
          <form action="{{ route('halaman-pegawai-petinggi.index')}}">
            <div class="input-group mb-3">
              <input type="search" class="form-control" id="search_pegawai_section_petinggi" name="search" placeholder="Search.." >
              <button class="btn btn-outline-success" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
          {{-- <form action="{{ route('halaman-pegawai-petinggi.index') }}" method="get">
            <div class="input-group mb-3 col-md-4 float-right">
                <input type="text" id="date_pegawai" name="date" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                </div>
             
            </div>
        </form> --}}
        </div>
     </div>
          @if (session('success'))
          <div class="alert alert-success mb-2">{{ session('success') }}</div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
     

    

      <div class="page_data_pegawai_petinggi" id="page_data_pegawai_petinggi"></div>
  </div>
</main>

 @endsection

 