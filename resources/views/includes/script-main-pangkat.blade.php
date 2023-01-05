<script>
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

     //   KODE SCRIPT JABATAN

  //TOMBOL TAMBAH DATA JABATAN
            //jika tombol-tambah diklik maka
          
            $(document).on('click','#tombol-tambah-pangkat', function(){
            $('#button-simpan-pangkat').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-pangkat').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Pangkat Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-pangkat').modal('show'); //modal tampil
                    
        });

        $(document).on('click','#deletePangkatBtn', function(){
                                var kode_pangkat = $(this).data('id');
                                var url = '<?= route("delete.pangkat") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Pangkat',
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
                                        $.post(url,{kode_pangkat:kode_pangkat}, function(data){
                                            if(data.code == 1){
                                             
                                                iziToast.success({title: 'Data berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});
                                                    location.reload(true);
                                            }else{
                                                iziToast.error( {
                                                    title: 'Data gagal dihapus/ data berelasi!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'
                                                });
                                                
                                            }
                                        },'json');
                                    }
                                });

                            });
        

        // Menampilkan data menggunakan datatable
        $(document).ready(function() {
            $('#tabel_pangkat').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pangkat.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_pangkat',name:'kode_pangkat'},
                    {data:'nama_pangkat',name:'nama_pangkat'},
                    // {data:'jabatan',name:'jabatan'},
                 
              
          
                    {data:'action',name:'action'},
                  
                ],
            

            })
          
        } );

    
        if ($("#form-tambah-pangkat").length > 0) {
            $("#form-tambah-pangkat").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-pangkat')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('pangkat.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                        //  console.log(data);
                            if(data.status == 0) {
                                if(data.errors.kode_pangkat){
                                    $('#kodeJabatanCheck').html(data.errors.kode_pangkat[0]);
                                }
                                
                                if(data.errors.nama_pangkat){
                                    $('#namaJabatanCheck').html(data.errors.nama_pangkat[0]);
                                }
                             
                                
                              $('#tombol-simpan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-pangkat').trigger("reset"); //form reset
                                $('#tambah-modal-pangkat').modal('hide'); //modal hide
                                $('#tabel_pangkat').DataTable().ajax.reload(null, false);
                              
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Pangkat Berhasil Disimpan',
                                
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                            });
                            location.reload(true);
                            }
                            
                        }
                      
                    });
                }
            });
        }

         // KLIK TOMBOL EDIT
         $(document).on('click','.edit-post-pangkat', function(){
                var kode_pangkat = $(this).data('kode_pangkat');
              
                $('.editPangkat').find('form')[0].reset();
                $("#kode_Getjabatan_select").empty();
                $("#kode_Getgolongan_select").empty();
                $("#kode_Get_select").empty();
                // $("#getRoleSelect").empty();
                $('.editPangkat').find('span.error-text').text('');
                // console.log(kode_pangkat);
    
                $.post('<?= route("get.pangkat.details") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);

                        $('.editPangkat').find('input[name="kode_pangkat_id"]').val(data.details.kode_pangkat);
                        $('.editPangkat').find('input[name="kode_pangkat"]').val(data.details.kode_pangkat);
                        $('.editPangkat').find('input[name="nama_pangkat"]').val(data.details.nama_pangkat);

                        // if(data.details.role == null) {
                        //     $("#getRoleSelect").append('<option value="'+data.details.role+'">'+data.details.role+'</option>',);

                        //         $("#getRoleSelect").append('<option value="SD">SD</option>',);
                        //         $("#getRoleSelect").append('<option value="SMP">SMP</option>',);
                        //         $("#getRoleSelect").append('<option value="SMA/SMK">SMA/SMK</option>',);
                        //         $("#getRoleSelect").append('<option value="DI">DI</option>',);
                        //         $("#getRoleSelect").append('<option value="DII">DII</option>',);
                        //         $("#getRoleSelect").append('<option value="DIII">DIII</option>',);
                        //         $("#getRoleSelect").append('<option value="DIV">DIV</option>',);
                        //         $("#getRoleSelect").append('<option value="S1">S1</option>',);
                        //         $("#getRoleSelect").append('<option value="S2">S2</option>',);
                        //         $("#getRoleSelect").append('<option value="S3">S3</Ioption>',);
                        // }else {
                        //     $("#getRoleSelect").append('<option value="'+data.details.role+'">'+data.details.role+'</option>',);

                        //             $("#getRoleSelect").append('<option value="SD">SD</option>',);
                        //             $("#getRoleSelect").append('<option value="SMP">SMP</option>',);
                        //             $("#getRoleSelect").append('<option value="SMA/SMK">SMA/SMK</option>',);
                        //             $("#getRoleSelect").append('<option value="DI">DI</option>',);
                        //             $("#getRoleSelect").append('<option value="DII">DII</option>',);
                        //             $("#getRoleSelect").append('<option value="DIII">DIII</option>',);
                        //             $("#getRoleSelect").append('<option value="DIV">DIV</option>',);
                        //             $("#getRoleSelect").append('<option value="S1">SI</option>',);
                        //             $("#getRoleSelect").append('<option value="S2">S2</option>',);
                        //             $("#getRoleSelect").append('<option value="S3">S3</Ioption>',);
                        // }
                       
                     
                        if(data.details.kode_jabatan == null) {
                            $("#kode_Getjabatan_select").append('<option value=""></option>');
                                $.each(data.jabatan,function(key,entry){
                                        $("#kode_Getjabatan_select").append('<option value="'+entry.kode_jabatan+'">'+entry.nama_jabatan+'</option>');
                                                    
                                }); 
                        }
                        else {
                            $("#kode_Getjabatan_select").append('<option value="'+data.details.kode_jabatan+'">'+data.details.jabatan.nama_jabatan+'</option>');
                            $.each(data.jabatan,function(key,entry){
                                    $("#kode_Getjabatan_select").append('<option value="'+entry.kode_jabatan+'">'+entry.nama_jabatan+'</option>');
                                                  
                        }); 
                        }
                        $("#kode_Getjabatan_select").append('<option value="">Tidak ada jabatan</option>');
                       

                        if(data.details.kode_golongan == null || data.details.kode_golongan == '') {
                            $("#kode_Getgolongan_select").append('<option value=""></option>');
                                $.each(data.golongan,function(key,entry){
                                        $("#kode_Getgolongan_select").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                    
                                }); 
                        }
                        else {
                            $("#kode_Getgolongan_select").append('<option value="'+data.details.kode_golongan+'">'+data.details.golongan.nama_golongan+'</option>');
                            $.each(data.golongan,function(key,entry){
                                    $("#kode_Getgolongan_select").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                        }
                        $("#kode_Getgolongan_select").append('<option value="">Tidak ada jabatan</option>');

                      
                       
                       
                        $('.editPangkat').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

       //UPDATE Pangkat DETAILS
       $('#update-pangkat-form').on('submit', function(e){
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
                               
                              
                                if(data.error.nama_pangkat){
                                    $('#pangkat_name_error').html(data.error.nama_pangkat[0]);
                                }

                                if(data.error.kode_golongan){
                                    $('#pangkat_golongan_error').html(data.error.kode_golongan[0]);
                                }
                               
                               
                              }else{
                                
                                $('#update-pangkat-form').trigger("reset"); //form reset
                                $('.editPangkat').modal('hide'); //modal hide
                                $('#tabel_pangkat').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Pangkat Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
            // END UPDATE JURUSAN

        
</script>