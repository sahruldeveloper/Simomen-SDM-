




<script>
     $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

     // Menampilkan data menggunakan datatable
     $(document).ready(function() {
            $('#tabel_golongan').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('golongan.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_golongan',name:'kode_golongan'},
                    {data:'nama_golongan',name:'nama_golongan'},
                    {data:'keterangan',name:'keterangan'},
                    // {data:'kode_pangkat',name:'kode_pangkat'},
                 
                  
                    {data:'action',name:'action'}
                ],
                order: [[0, 'asc']]

            })
          
        } );

// KLIK TOMBOL EDIT
$(document).on('click','.edit-post-golongan', function(){
                var kode_golongan = $(this).data('kode_golongan');
                // $("#Getpangkat_select").empty();
                $('.editGolongan').find('form')[0].reset();
                $('.editGolongan').find('span.error-text').text('');
                // console.log(kode_golongan);
    
                $.post('<?= route("get.golongan.details") ?>',{kode_golongan:kode_golongan}, function(data){
                        //  alert(data.details.nama_golongan);
                         console.log(data.details.pangkat);
                   
                        $('.editGolongan').find('input[name="kode_golongan_id"]').val(data.details.kode_golongan);
                        $('.editGolongan').find('input[name="kode_golongan"]').val(data.details.kode_golongan);
                        $('.editGolongan').find('input[name="nama_golongan"]').val(data.details.nama_golongan);
                        $('.editGolongan').find('input[name="keterangan"]').val(data.details.keterangan);
                        $("#kode_Getjabatan_select").append('<option value="</option>');
                        $("#Getpangkat_select").append('<option value="'+data.details.kode_pangkat+'">'+data.details.pangkat.nama_pangkat+'</option>');
                                $.each(data.pangkat,function(key,entry){
                                        $("#Getpangkat_select").append('<option value="'+entry.kode_pangkat+'">'+entry.nama_pangkat+'</option>');
                                                    
                                }); 
                        // if(data.details.kode_pangkat == null) {
                          
                        // }
                    
                        $('.editGolongan').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

    
   //UPDATE GOLONGAN DETAILS
   $('#update-golongan-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                               
                                if(data.error.kode_golongan){
                                    $('#golongan_kode_error').html(data.error.kode_golongan[0]);
                                }
                                if(data.error.nama_golongan){
                                    $('#golongan_name_error').html(data.error.nama_golongan[0]);
                                }
                                if(data.error.keterangan){
                                    $('#golongan_keterangan_error').html(data.error.keterangan[0]);
                                }
                                if(data.error.kode_pangkat){
                                    $('#pangkat_name_error').html(data.error.kode_pangkat[0]);
                                }
                              }else{
                                
                                $('#update-golongan-form').trigger("reset"); //form reset
                                $('.editGolongan').modal('hide'); //modal hide
                           
                                $('#tabel_golongan').DataTable().ajax.reload(null, false);
                              
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                           
                              location.reload(true);
                            }
                          
                              
                        }
                    });
                });
            // END UPDATE GOLONGAN

            // DELETE GOLONGAN
            //DELETE GOLONGAN RECORD
            $(document).on('click','#deleteGolonganBtn', function(){
                                var kode_golongan = $(this).data('id');
                                var url = '<?= route("delete.golongan") ?>';

                                swal.fire({
                                    title:'Are you sure?',
                                    html:'Anda Yakin <b>Menghapus</b> Data Golongan ',
                                    showCancelButton:true,
                                    showCloseButton:true,
                                    cancelButtonText:'Cancel',
                                    confirmButtonText:'Yes, Delete',
                                    cancelButtonColor:'#d33',
                                    confirmButtonColor:'#556ee6',
                                    width:300,
                                    allowOutsideClick:false
                                }).then(function(result){
                                    if(result.value){
                                        $.post(url,{kode_golongan:kode_golongan}, function(data){
                                            if(data.code == 1){
                                                $('#tabel_golongan').DataTable().ajax.reload(null, false);
                                                iziToast.success({title: 'Data berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});
                                            }
                                            else if(data.code == 0){
                                                $('#tabel_golongan').DataTable().ajax.reload(null, false);
                                                iziToast.error({title: 'Data gagal dihapus/ data berelasi!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});
                                            }
                                            else{
                                                iziToast.error( {
                                                    title: 'Data gagal dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'
                                                });
                                            }
                                        },'json');
                                    }
                                });

                            });
           

        
  
</script>