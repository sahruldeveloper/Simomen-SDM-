<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="Store Transactions Purple Dashboard" />
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Halaman Petinggi YLPI</title>

    @include('includes.petinggi.style')
{{-- 
    <script
      src="https://kit.fontawesome.com/32f82e1dca.js"
      crossorigin="anonymous"
    ></script> --}}
  </head>
  <body>
    {{-- navbar --}}
   
    @include('includes.petinggi.sidebar-petinggi')
    {{-- navbar --}}

   {{-- content --}}
   @yield('content-petinggi')
   {{-- content --}}

   @include('includes.script')
   @include('includes.petinggi.script-petinggi')
  
  </body>
</html>
