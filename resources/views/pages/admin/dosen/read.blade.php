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
                @php
                    if($data->nidn == null){
                      echo "-";
                    }else{
                      echo"  <p class='fw-bold mb-1'>$data->nidn</p>";
                    }
                @endphp
               
                 <p class="text-muted mb-0">{{ $data->pegawai->nama }}</p>
               </div>
             </div>
           </td>
    
           <td>
             {{-- <p class="fw-bold mb-1">{{ $data->jabatan->nama_jabatan }}</p> --}}
            
             <p class="fw-bold mb-1">{{ $data->pegawai->kode_pangkat == null ? '-' : $data->pegawai->pangkat->nama_pangkat }}</p>
             <p class="fw-muted mb-1">{{ $data->pegawai->kode_golongan == null ? '-' : $data->pegawai->golongan->nama_golongan }}</p>
        
           </td>
   
           <td>
             <p class="fw-bold mb-1">{{ $data->jurusan->nama_jurusan }}</p>
             <p class="fw-muted mb-1">{{ $data->fakultas->nama_fakultas }}</p>
             {{-- <p class="text-muted fs-6 mb-0">{{ $data->kode_golongan->nama_golongan }}</p> --}}
           </td>
          
           <td>{{ $data->pegawai->umur }}</td>
          
        
           </td>
    
           <td>{{ $data->pegawai->masa_jabatan }}
           <td class="text-center"> @php
            if($data->pegawai->status == 'Pensiun') {
              echo '<span class="badge rounded-pill text-white bg-danger">'. $data->pegawai->status. '</span>';
            } else if($data->pegawai->status == 'Kontrak'){
              echo '<span class="badge rounded-pill text-white bg-warning">'. $data->pegawai->status. '</span>';
            }
            else {
              echo '<span class="badge rounded-pill text-white bg-success">'. $data->pegawai->status. '</span>';
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
           
        
           <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-dosen"><i class="far fa-edit"></i> Edit</a>
           <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Hapus" class="edit btn btn-danger btn-sm" " id="deleteDosenBtn"><i class="bi bi-trash3"></i> Hapus</a>
        
           <a href="{{ route('dosen.show', $data->id) }}" data-toggle="tooltip" data-original-title="Detail" class="detail btn btn-secondary text-white btn-sm detail-post-dosen"><i class="far fa-edit"></i> Detail</a>
           </td>
         </tr>
         @empty
         <td colspan="8" class="text-center">Tidak ada data</td>
         @endforelse
       </tbody>
         
     </table>
     <div id="page_dosen_admin_links">
      {{ $dosen->links()}}
     </div>
    
      {{-- table --}}
        
        
        </div>
    
   </div>