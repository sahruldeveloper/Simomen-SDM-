<div class="table-responsive">
     <table class="table table-borderred table-data align-middle" id="tabel_pegawai">
       <thead>
         <tr>
           <th class="name-th">Nama</th>
          
           <th>Pangkat/Golongan</th>
           <th>Umur</th>
           <th>Masa Jabatan</th>
           <th>Kategori</th>
           <th>Status</th>
         
           <th>Aksi</th>
         </tr>
       </thead>
       <tbody id="tbody-pegawai">
         @forelse ($pegawai as $data)
        
         <tr>
           <td>
             <div class="d-flex align-items-center">
               <img src="{{ asset('storage/assets/foto/' . $data->foto) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle">
               <div class="ms-3">
                 <p class="fw-bold mb-1">{{$data->npk }}</p>
                 <p class="text-muted mb-0">{{ $data->nama }}</p>
               </div>
             </div>
           </td>
    
           <td>
             <p class="fw-bold mb-1">{{ $data->kode_pangkat == null ? '-' : $data->pangkat->nama_pangkat }}</p>
             <p class="fw-muted mb-1">{{ $data->kode_golongan == null ? '-' : $data->golongan->nama_golongan }}</p>
             {{-- <p class="text-muted fs-6 mb-0">{{ $data->kode_golongan->nama_golongan }}</p> --}}
           </td>
          
           <td>{{ $data->umur }}</td>
           <td>{{ $data->masa_jabatan }}</td>
           <td>@php
               if($data->kategori == 'Pegawai Akademik(Dosen)'){
                 echo '<span class="badge rounded-pill text-bg-success">Akademik - Dosen</span>';
               } else {
                 echo '<span class="badge rounded-pill text-bg-primary">Non Akademik</span>';
               }
           @endphp</td>
           <td>
             @php
               if($data->status == 'Pensiun') {
                 echo '<span class="badge rounded-pill text-bg-secondary">'. $data->status. '</span>';
               }
               else if($data->status == 'Aktif') {
                 echo '<span class="badge rounded-pill text-bg-success">'. $data->status. '</span>';
               } else {
                 echo '<span class="badge rounded-pill text-bg-warning">'. $data->status. '</span>';
               }
             @endphp
         </td>
         @php
              
         @endphp
           
          
         
             {{-- <form action="{{ route('send.notif.pensiun.pegawai', $data->npk) }}" method="post">
               @csrf
               @method('post')
              
               @php
                 if($data->status == 'Aktif'){
                   echo ' <button class="btn btn-notif-dosen-petinggi text-white btn-sm disabled" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pensiun
                         </button>';
                 }
                   else if(empty($data->notifPensiunPegawai->status))
                       {
                         echo ' <button class="btn btn-notif-dosen-petinggi text-white btn-sm " id="tombol-notif-pensiun" style="width: 130px"><i class="fa-solid fa-paper-plane"></i> Notif Pensiun
                             </i></button>';
                       }  
                     else {
                             echo ' <button class="btn btn-notif-dosen-petinggi text-white btn-sm disabled" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pensiun
                           </button>';
                           }
             
               @endphp
              
     
               
          </form> --}}
       <td>
        @php
        // dd($data->notifPangkatPegawai->status == 'Terkirim');
        @endphp
          <form action="{{ route('send.notif.pangkat.pegawai', $data->id) }}" method="post">
           @csrf
           @method('post')
          
           @php
          if($data->status == 'Kontrak' || $data->status == 'Pensiun'){
             echo ' <button class="btn btn-notif-pangkat text-white btn-sm disabled" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pangkat
                   </button>';
           }
            else if($data->verif_data_pangkat == 'Sudah'){
             echo ' <button class="btn btn-notif-pangkat text-white btn-sm disabled" style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pangkat
                   </button>';
           }
         
           else if($data->notifPangkatPegawai == null)
               {
                 echo ' <button class="btn btn-notif-pangkat text-white btn-sm " id="tombol-notif-pensiun" style="width: 130px"><i class="fa-solid fa-paper-plane"></i> Notif Pangkat
                     </i></button>';
               }
            
            else if($data->notifPangkatPegawai->status == 'Terkirim') {
                     echo ' <button class="btn btn-notif-pangkat text-white btn-sm disabled " style="width: 130px" id="tombol-notif-pensiun"><i class="fa-solid fa-paper-plane"></i> Notif Pangkat
                   </button>';
                   }
      
          
           @endphp
          
 
           
      </form>

          
             <a href="{{ route('halaman-pegawai-petinggi.show', $data->id) }}" data-toggle="tooltip" data-original-title="Detail" class="btn btn-detail-dosen-petinggi btn-secondary text-white btn-sm" style="width: 130px"><i class="far fa-edit"></i> Detail Pegawai</a>
           </td>
         </tr>
       
         @empty
         <td colspan="8" class="text-center not-found">
          <img src="{{ url('backend/assets/image/404.png') }}" alt="">
          <div class="title">Tidak ada data</div></td>
         @endforelse



       </tbody>
       
     </table>
     <div id="page_pegawai_petinggi_links">
      {{ $pegawai->links()}}
     </div>
    