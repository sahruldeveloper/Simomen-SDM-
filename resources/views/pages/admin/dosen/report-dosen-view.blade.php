@extends('layouts.admin')
 <!-- main  -->
 

 @section('content-admin')

 <!-- main  -->
 
 <main class="content-wrapper">
    
     <div class="container-fluid">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Data Dosen</a></li>
               <li class="breadcrumb-item">Laporan Dosen</li>
           </ol>
         <div class="animated fadeIn">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">
                                 Laporan Dosen
                             </h4>
                         </div>
                         <div class="card-body">
                             @if (session('success'))
                                 <div class="alert alert-success">{{ session('success') }}</div>
                             @endif
 
                             @if (session('error'))
                                 <div class="alert alert-danger">{{ session('error') }}</div>
                             @endif
 
                             <!-- FORM UNTUK FILTER BERDASARKAN DATE RANGE -->
                             <form action="{{ route('report.dosen') }}" method="get">
                                 <div class="input-group mb-3 col-md-4 float-right">
                                     <input type="text" id="created_at_dosen" name="date" class="form-control">
                                     <div class="input-group-append">
                                         <button class="btn btn-secondary" type="submit">Filter</button>
                                     </div>
                                     <a class="btn btn-primary ml-2" id="exportpdfdosen">Export PDF</a>
                                 </div>
                             </form>
                             <div class="table-responsive">
                                 <!-- TAMPILKAN DATA YANG BERHASIL DIFILTER -->
                                 <table class="table table-hover table-bordered">
                                     <thead>
                                         <tr>
                                             <th>NIDN</th>
                                             <th>Nama Dosen</th>
                                             <th>Status</th>
                                             <th>Tanggal Pensiun</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @forelse ($dosen as $row)
                                         <tr>
                                             <td><strong>{{ $row->nidn }}</strong></td>
                                             <td><strong>{{ $row->pegawai->nama }}</strong></td>
                                             <td>{{ $row->pegawai->status }}</td>
                                             <td>{{ $row->updated_at->format('d-m-Y') }}</td>
                                         </tr>
                                         @empty
                                         <tr>
                                             <td colspan="6" class="text-center">Tidak ada data</td>
                                         </tr>
                                         @endforelse
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>
 
 @endsection

 <!-- KITA GUNAKAN LIBRARY DATERANGEPICKER -->
{{-- @section('js')

@endsection() --}}

 