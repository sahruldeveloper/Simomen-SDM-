<div class="table-responsive">
  <table class="table table-borderless table-data align-middle" id="tabel_pegawai">
    <thead>
      <tr>
        <th>Nama</th>
       
        <th>Pangkat/Golongan</th>
        <th>Umur</th>
        <th>Masa Kerja</th>
        <th>SK</th>
        <th>Status</th>
        <th>Kategori</th>
        <th>Verif data pangkat</th>
        {{-- <th>Verif data pensiun</th> --}}
      
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="tbody-pegawai">
      @forelse ($pegawai as $data)
     
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img src="{{ asset('storage/assets/foto/' . $data->foto) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle">
            <div class="ms-3">
              <p class="fw-bold mb-1">{{$data->npk == null ? '-' : $data->npk }}</p>
              <p class="text-muted mb-0">{{ $data->nama }}</p>
            </div>
          </div>
        </td>
 
        <td>
          <p class="fw-bold mb-1">{{ $data->kode_pangkat == null ? '-' : $data->pangkat->nama_pangkat }}</p>
     
          <p class="fw-muted mb-1">{{ $data->kode_golongan == null ? '-' : $data->golongan->nama_golongan }}</p>
        </td>
       
        <td>{{ $data->umur }}</td>
       
        
  
       
        <td>
         {{$data->masa_jabatan}}       
         
    
        </td>
        <td>{{Carbon\Carbon::parse($data->tgl_sk_yayasan)->format('d-m-Y') }}</td>

        {{-- <td>{{ $data->masa_jabatan }}</td> --}}
        <td>@php
             if($data->status == "Aktif"){
            echo '<span class="badge rounded-pill text-white bg-success">'. $data->status. '</span>';
            } else if($data->status == 'Kontrak'){
              echo '<span class="badge rounded-pill text-white bg-warning">'. $data->status. '</span>';
            }
            else {
              echo '<span class="badge rounded-pill text-white  bg-danger">'. $data->status. '</span>';
            
          }
        @endphp
         
        </td>
        <td>@php
          if($data->kategori == 'Pegawai Akademik(Dosen)'){
            echo '<span class="badge rounded-pill text-white bg-success">Akademik - Dosen</span>';
          } else {
            echo '<span class="badge rounded-pill text-white bg-primary">Non Akademik</span>';
          }
      @endphp</td>
        <td class="text-center">
          @php
              if($data->verif_data_pangkat == 'Sudah' )
              {
                echo '<i class="fa-regular fa-circle-check" style="color:green; font-size:18px;"></i>';
              }
              else {
                echo '<i class="fa-regular fa-circle-xmark" style="color:red; font-size:18px;"></i>';
              }
          @endphp
        {{-- <td class="text-center" >
          @php
          if($data->verif_data_pensiun == 'Sudah' )
          {
            echo '<i class="fa-regular fa-circle-check" style="color:green; font-size:18px;"></i>';
          }
          else {
            echo '<i class="fa-regular fa-circle-xmark" style="color:red; font-size:18px;"></i>';
          }
      @endphp
        </td> --}}
        
      
        <td>

          <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-pegawai"><i class="far fa-edit"></i> Edit</a>
          <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$data->id}}" data-original-title="Hapus" class="edit btn btn-danger btn-sm" " id="deletePegawaiBtn"><i class="bi bi-trash3"></i> Hapus</a>
          {{-- <a href="{{ route('delete.pegawai', $data->id) }}" data-toggle="tooltip" data-original-title="Hapus" class="detail btn btn-secondary text-white btn-sm"><i class="far fa-trash"></i> Hapus</a> --}}
          <a href="{{ route('pegawai.show', $data->id) }}" data-toggle="tooltip" data-original-title="Detail" class="detail btn btn-secondary text-white btn-sm detail-post-pegawai"><i class="far fa-edit"></i> Detail</a>
        </td>
      </tr>
      @empty
      <td colspan="8" class="text-center">Tidak ada data</td>
      @endforelse



    </tbody>
      
  </table>

  <div class="" id="page_pegawai_admin_links">
    {{ $pegawai->links() }}
  </div>

  
</div>
