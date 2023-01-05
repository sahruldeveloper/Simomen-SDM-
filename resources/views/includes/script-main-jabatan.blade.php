<script>
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

     //   KODE SCRIPT JABATAN

  //TOMBOL TAMBAH DATA JABATAN
            //jika tombol-tambah diklik maka
          
            $(document).on('click','#tombol-tambah-jabatan', function(){
            $('#button-simpan-jabatan').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-jabatan').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Jabatan Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-jabatan').modal('show'); //modal tampil
                    
        });
        

        // Menampilkan data menggunakan datatable
        $(document).ready(function() {
            $('#tabel_jabatan').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('jabatan.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_jabatan',name:'kode_jabatan'},
                    {data:'nama_jabatan',name:'nama_jabatan'},
          
                    {data:'action',name:'action'},
                  
                ],
                order: [[0, 'asc']]

            })
          
        } );

         //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-tambah-jabatan").length > 0) {
            $("#form-tambah-jabatan").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-jabatan')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('jabatan.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                        //  console.log(data);
                            if(data.status == 0) {
                                if(data.errors.kode_jabatan){
                                    $('#kodeJabatanCheck').html(data.errors.kode_jabatan[0]);
                                }
                                
                                if(data.errors.nama_jabatan){
                                    $('#namaJabatanCheck').html(data.errors.nama_jabatan[0]);
                                }
                              $('#tombol-simpan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-jabatan').trigger("reset"); //form reset
                                $('#tambah-modal-jabatan').modal('hide'); //modal hide
                                $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Jabatan Berhasil Disimpan',
                                
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                            });
                            }
                            
                        }
                      
                    });
                }
            });
        }

        // KLIK TOMBOL EDIT
        $(document).on('click','.edit-post-jabatan', function(){
                var kode_jabatan = $(this).data('kode_jabatan');
              
                $('.editJabatan').find('form')[0].reset();
                $("#kode_Getgolongan_select").empty();
                $('.editJabatan').find('span.error-text').text('');
                // console.log(kode_jabatan);
    
                $.post('<?= route("get.jabatan.details") ?>',{kode_jabatan:kode_jabatan}, function(data){
                        //  alert(data.details.nama_golongan);

                        $('.editJabatan').find('input[name="kode_jabatan_id"]').val(data.details.kode_jabatan);
                        $('.editJabatan').find('input[name="kode_jabatan"]').val(data.details.kode_jabatan);
                        $('.editJabatan').find('input[name="nama_jabatan"]').val(data.details.nama_jabatan);
                       
                       
                        $('.editJabatan').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

     

      //UPDATE JABATAN DETAILS
      $('#update-jabatan-form').on('submit', function(e){
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
                               
                                if(data.error.kode_jabatan){
                                    $('#jabatan_kode_error').html(data.error.kode_jabatan[0]);
                                }
                                if(data.error.nama_jabatan){
                                    $('#jabatan_name_error').html(data.error.nama_jabatan[0]);
                                }
                                if(data.error.nama_jabatan){
                                    $('#jabatan_name_error').html(data.error.nama_jabatan[0]);
                                }
                              }else{
                                
                                $('#update-jabatan-form').trigger("reset"); //form reset
                                $('.editJabatan').modal('hide'); //modal hide
                                $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Jabatan Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
            // END UPDATE JABATAN

     
            // END UPDATE GOLONGAN

             // DELETE JABATAN
            //DELETE COUNTRY RECORD
            $(document).on('click','#deleteJabatanBtn', function(){
                                var kode_jabatan = $(this).data('id');
                                var url = '<?= route("delete.jabatan") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Jabatan',
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
                                        $.post(url,{kode_jabatan:kode_jabatan}, function(data){
                                            if(data.code == 1){
                                                $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                                iziToast.success({title: 'Data berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});
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
                            

            // END  DELETE GOLONGAN
            //DELETE PEGAWAI RECORD
          
            // END  DELETE GOLONGAN


      

//   END KODE SCRIPT JABATAN
</script>