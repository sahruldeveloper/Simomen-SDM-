<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
  @include('includes.admin.style');
  

    <title>Administrator</title>
  </head>
  <body>

    <div class="main-wrapper">
      @if (session('success'))
      <div class="alert alert-success mb-2">{{ session('success') }}</div>
  @endif

  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
      <!-- NAVBAR -->
      @include('includes.admin.navbar-admin')
      <!-- END NAVBAR -->

      <!-- START SIDEBAR -->
      @include('includes.admin.sidebar-admin')
      <!-- END SIDEBAR -->
      @include('pages.admin.golongan.edit-golongan')
   
      {{-- @include('pages.petinggiYLPI.edit-petinggi') --}}
      @include('pages.admin.jabatan.edit-jabatan')
      @include('pages.admin.pegawai.edit-pegawai')
      @include('pages.admin.fakultas.edit-fakultas')
      @include('pages.admin.jurusan.edit-jurusan')
      @include('pages.admin.dosen.edit-dosen')
      @include('pages.admin.pangkat.edit-pangkat')
      @include('pages.admin.staffAdmin.edit-staff-admin')
 
      @yield('content-admin')     
    </div>

   

    
   

    
    @include('includes.script')
    @include('includes.script-main-dosen')
    @include('includes.script-main-pegawai')
    @include('includes.script-main-petinggi')
    @include('includes.script-main-jabatan')
    @include('includes.script-main-pangkat')
    @include('includes.script-main-golongan')
    @include('includes.script-main-staff')

    
   
 
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>