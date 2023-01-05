@extends('layouts.petinggi')
 <!-- main  -->
 
 @section('content-petinggi')
 
 <main id="main-content" class="content"> 
  <div class="top-bar d-flex justify-content-between  ">
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

    <div class="wrap-content-topbar d-flex justify-content-center"> 
      <div class="user-img d-flex">
        <img src="{{ asset('storage/assets/foto/' . Auth::guard('petinggi')->user()->foto) }}" alt="">
      </div>
      <div class="name-user">
        <span class="color-secondary">{{ Auth::guard('petinggi')->user()->nama_petinggi }}</span>
      </div>
    </div>
    
 </div>
  </div>


  <h4 class="fw-bold color-primary mt-2">Data Dosen</h4>
 
 
  <div class="content-wrapper">
    <div class="row mt-4 mb-3">
      <div class="col-md-5">
        <form action="{{ route('halaman-dosen-petinggi.index')}}">
         
          <div class="input-group mb-3">
            {{-- @if(request('pangkat'))
            <input type="search" class="form-control" name="pangkat" value="{{ request('pangkat') }}" >
            @endif --}}
            <input type="search" class="form-control" id="search_dosen_section_petinggi" name="search" value="{{$keyword }}" placeholder="Search.." >
            <button class="btn btn-outline-success" type="submit" id="button-addon2">Search</button>
          </div>
        </form>
        {{-- <form action="{{ route('petinggi.read.dosen') }}" method="get">
          <div class="input-group mb-3 col-md-4 float-right">
              <input type="text" id="date_dosen" name="date" class="form-control">
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

    <!-- FORM UNTUK FILTER BERDASARKAN DATE RANGE -->
   
    
  

    {{-- table --}}
   <div class="page_data_dosen_petinggi" id="page_data_dosen_petinggi"></div>
</main>


 @endsection

 