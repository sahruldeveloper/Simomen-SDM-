<div class="table-responsive">
     <table class="table table-borderred table-data align-middle">
       <thead>
         <tr>
           <th class="name-th">Nama</th>
          
           <th>Jabatan/Pangkat</th>
           <th>Fakultas/Jurusan</th>
           <th>Umur</th>
         
           <th>Masa Kerja</th>
           <th>Status</th>
         
           <th>Actions</th>
         </tr>
       </thead>
       <tbody id="tbody-pegawai">
         @forelse ($dosen as $data)

         {{-- @php
             dd($data);
         @endphp --}}
        
         <tr>
           <td>
             <div class="d-flex align-items-center">
               <img src="{{ asset('storage/assets/foto/' . $data->pegawai->foto) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle">
               <div class="ms-3">
                 <p class="fw-bold mb-1">{{$data->nidn }}</p>
                 <p class="text-muted mb-0">{{ $data->pegawai->nama }}</p>
               </div>
             </div>
           </td>
    
           <td>
             <p class="fw-bold mb-1">{{ $data->pegawai->kode_jabatan == '' ? '-' : $data->pegawai->jabatan->nama_jabatan  }}</p>
             @php
              
             @endphp
             <p class="fw-muted mb-1">{{ $data->pegawai->kode_pangkat == null ? '-' : $data->pegawai->pangkat->nama_pangkat }}</p>
             {{-- <p class="text-muted fs-6 mb-0">{{ $data->kode_golongan->nama_golongan }}</p> --}}
           </td>

           <td>
             <p class="fw-bold mb-1">{{ $data->jurusan->nama_jurusan }}</p>
             <p class="fw-muted mb-1">{{ $data->fakultas->nama_fakultas }}</p>
             {{-- <p class="text-muted fs-6 mb-0">{{ $data->kode_golongan->nama_golongan }}</p> --}}
           </td>
          
           <td>{{ $data->pegawai->umur }}</td>
          
        
           </td>
        
           <td>{{ $data->pegawai->masa_jabatan }}
           <td> @php
            if($data->pegawai->status == 'Pensiun') {
              echo '<span class="badge rounded-pill text-bg-secondary">'. $data->pegawai->status. '</span>';
            }
            else if($data->pegawai->status == "Kontrak") {
              echo '<span class="badge rounded-pill text-bg-warning">'. $data->pegawai->status. '</span>';
            }
            else {
              echo '<span class="badge rounded-pill text-bg-success">'. $data->pegawai->status. '</span>';
            }
        @endphp
          
          </td>
           
          
           <td>
          
              {{-- <form action="{{ route('send.notif.pensiun', $data->nidn) }}" method="post">
                @csrf
                @method('post')
               
                @php
             
             if(empty($data->notifPensiunDosen->status))
                {
                  echo ' <button class="btn btn-notif-dosen-petinggi text-white btn-sm" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pensiun
                      </i></button>';
                }  
                else {
                      echo ' <button class="btn btn-notif-dosen-petinggi text-white btn-sm disabled" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pensiun
                     </button>';
                    }
              
           
               
                @endphp
               
      
                
           </form> --}}
           
        
           <a href="{{ route('halaman-dosen-petinggi.show', $data->id) }}" data-toggle="tooltip" data-original-title="Detail" class="btn btn-detail-dosen-petinggi text-white btn-sm" style="width: 130px"><i class="far fa-edit"></i> Detail Dosen</a>
     
           </td>
         </tr>
         @empty
         <td colspan="8" class="text-center not-found">
          <img src="{{ url('backend/assets/image/404.png') }}" alt="">
          <div class="title">Tidak ada data</div></td>
         @endforelse
       </tbody>
         
     </table>
     <div id="page_dosen_petinggi_links">
      {{ $dosen->links()}}
     </div>
      {{-- table --}}
</div>