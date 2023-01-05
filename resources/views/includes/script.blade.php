
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ url('backend/assets/js/popper.min.js') }}"></script>
<script src="{{ url('backend/assets/js/bootstrap.js') }}"></script>
<script src="{{ url('backend/assets/js/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
    <script src="{{ url('backend/assets/js/main.js') }}"></script>


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>






<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

   
        // update sub kategori (jabatan) pada fotm tambah dosenkode_jabatan
        function updateSubKategoriJabatan(){
            let  kode_jabatan = $("#select-jabatan").val();
          
                $("#SubKategoriPangkat").empty();
                $("#SubKategoriPangkat").append('<option >Pilih Pangkat</option>');
                $("#SubKategoriPangkat").prop("disabled", true);
                $('#SubKategoriPangkat').find('span.error-text').text('');
            if(kode_jabatan != '' && kode_jabatan!=null){
                 $.post('<?= route("get.pangkat.from.jabatan") ?>',{kode_jabatan:kode_jabatan}, function(data){
            
                         $("#SubKategoriPangkat").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#SubKategoriPangkat").append('<option value="'+entry.kode_pangkat+'">'+entry.nama_pangkat+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        // end update sub kategori (jabatan)

        // to edit page pegawai
         // update sub kategori (jabatan)
         function EditSubKategoriJabatan(){
            let  kode_golongan = $("#get-select-golongan").val();
          
                $("#get-select-jabatan").empty();
                $("#get-select-jabatan").append('<option >Pilih Pangkat</option>');
                $("#get-select-jabatan").prop("disabled", true);
                $('#get-select-jabatan').find('span.error-text').text('');
            if(kode_golongan != '' && kode_golongan!=null){
                 $.post('<?= route("get.pangkat.from.jabatan") ?>',{kode_golongan:kode_golongan}, function(data){
                         console.log(data);
                         $("#get-select-jabatan").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-jabatan").append('<option value="'+entry.kode_jabatan+'">'+entry.nama_jabatan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        // end update sub kategori (jabatan)
        // end to edit page pegawai

     




//   KODE SCRIPT GOLONGAN
        //TOMBOL TAMBAH DATA GOLONGAN
            //jika tombol-tambah diklik maka
        // $('#tombol-tambah-golongan').click(function () {
        //     $('#button-simpan-golongan').val("create-post"); //valuenya menjadi create-post
        //     $('#form-tambah-golongan').trigger("reset"); //mereset semua input dll didalamnya
        //     $('span').trigger("reset"); //mereset semua input dll didalamnya
        //     $('#modal-judul').html("Tambah Golongan Baru"); //valuenya tambah pegawai baru
        //     $('#tambah-modal-golongan').modal('show'); //modal tampil
        // });

        $(document).on('click','#tombol-tambah-golongan', function(){
            $('#button-simpan-golongan').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-golongan').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Golongan Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-golongan').modal('show'); //modal tampil
                    
        });

    

       

        //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-tambah-golongan").length > 0) {
            $("#form-tambah-golongan").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-golongan').val();
                    $('#tombol-simpan-golongan').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-golongan')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('golongan.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                            console.log(data.errors);
                            if(data.status == 0) {
                                if(data.errors.kode_golongan){
                                    $('#kodeGolonganCheck').html(data.errors.kode_golongan[0]);
                                }
                                if(data.errors.nama_golongan){
                                    $('#namaGolonganCheck').html(data.errors.nama_golongan[0]);
                                }
                                if(data.errors.kategori){
                                    $('#kategoriCheck').html(data.errors.kategori[0]);
                                }
                                if(data.errors.keterangan){
                                    $('#keteranganCheck').html(data.errors.keterangan[0]);
                                }
                              $('#tombol-simpan-golongan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-golongan').trigger("reset"); //form reset
                                $('#tambah-modal-golongan').modal('hide'); //modal hide
                                $('#tabel_golongan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Golongan Berhasil Disimpan',
                                
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

    
        
//   END KODE SCRIPT GOLONGAN

// SCRIPT FAKULTAS
 // Menampilkan data menggunakan datatable
 $(document).ready(function() {
            $('#tabel_fakultas').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('fakultas.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_fakultas',name:'kode_fakultas'},
                    {data:'nama_fakultas',name:'nama_fakultas'},
                    {data:'action',name:'action'}
                ],
                order: [[0, 'asc']]

            })
          
        } );
 // END TAMPIL DATA
 //TOMBOL TAMBAH DATA FAKULTAS
            //jika tombol-tambah diklik maka
        
        $(document).on('click','#tombol-tambah-fakultas', function(){
               
                $('#button-simpan-fakultas').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-fakultas').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Fakultas Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-fakultas').modal('show'); //modal tampil
                    
        });

   
   
        // TAMBAH DATA FAKULTAS
        if ($("#form-tambah-fakultas").length > 0) {
            $("#form-tambah-fakultas").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-fakultas').val();
                    $('#tombol-simpan-fakultas').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-fakultas')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('fakultas.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                            console.log(data.errors);
                            if(data.status == 0) {
                                if(data.errors.kode_fakultas){
                                    $('#kodeFakultasCheck').html(data.errors.kode_fakultas[0]);
                                }
                                if(data.errors.nama_fakultas){
                                    $('#namaFakultasCheck').html(data.errors.nama_fakultas[0]);
                                }
                               
                              $('#tombol-simpan-fakultas').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-fakultas').trigger("reset"); //form reset
                                $('#tambah-modal-fakultas').modal('hide'); //modal hide
                                $('#tabel_fakultas').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Fakultas Berhasil Disimpan',
                                
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
        // END TAMBAH DATA FAKULTAS

         // KLIK TOMBOL EDIT
         $(document).on('click','.edit-post-fakultas', function(){
                var kode_fakultas = $(this).data('kode_fakultas');
              
                $('.editFakultas').find('form')[0].reset();
                $('.editFakultas').find('span.error-text').text('');
                // console.log(kode_golongan);
    
                $.post('<?= route("get.fakultas.details") ?>',{kode_fakultas:kode_fakultas}, function(data){
                        //  alert(data.details.nama_golongan);
                        //  console.log(data);
                   
                        $('.editFakultas').find('input[name="kode_fakultas_id"]').val(data.details.kode_fakultas);
                        $('.editFakultas').find('input[name="kode_fakultas"]').val(data.details.kode_fakultas);
                        $('.editFakultas').find('input[name="nama_fakultas"]').val(data.details.nama_fakultas);
                       
                        $('.editFakultas').modal('show');
                       
                    },'json');
                    
        });

       
         //UPDATE FAKULTAS DETAILS
         $('#update-fakultas-form').on('submit', function(e){
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
                               
                                if(data.error.kode_fakultas){
                                    $('#fakultas_kode_error').html(data.error.kode_fakultas[0]);
                                }
                                if(data.error.nama_fakultas){
                                    $('#fakultas_name_error').html(data.error.nama_fakultas[0]);
                                }
                              }else{
                                
                                $('#update-fakultas-form').trigger("reset"); //form reset
                                $('.editFakultas').modal('hide'); //modal hide
                                $('#tabel_fakultas').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Fakultas Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
            // END UPDATE JABATAN
     // KLIK TOMBOL EDIT

     
         //UPDATE PROFILE ADMIN DETAILS
         $('#update-profile-admin-form').on('submit', function(e){
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
                               
                                if(data.errors.nama){
                                    $('#profile_admin_nama_error').html(data.error.nama[0]);
                                }
                                if(data.errors.email){
                                    $('#profile_admin_email_error').html(data.error.email[0]);
                                }
                                if(data.errors.password){
                                    $('#profile_admin_password_error').html('password harus di isi');
                                }
                              }else{
                                
                              
                            
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Admin Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
            // END UPDATE PROFILE ADMIN

       

            // PRPFILE PETINGGI
            $('#update-profile-petinggi-form').on('submit', function(e){
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
                               
                                if(data.errors.nama){
                                    $('#profile_petinggi_nama_error').html(data.error.nama[0]);
                                }
                                if(data.errors.email){
                                    $('#profile_petinggi_email_error').html(data.error.email[0]);
                                }
                                if(data.errors.password){
                                    $('#profile_petinggi_password_error').html('password harus di isi');
                                }
                              }else{
                                
                              
                            
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Petinggi Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                           
                        }
                    });
                });
            // PRPFILE PETINGGI


       

    //  DELETE FAKULTAS
    $(document).on('click','#deleteFakultasBtn', function(){
                                var kode_fakultas = $(this).data('id');
                                var url = '<?= route("delete.fakultas") ?>';

                                swal.fire({
                                    title:'Yakin?',
                                    html:'Hapus <b>delete</b> data fakultas',
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
                                        $.post(url,{kode_fakultas:kode_fakultas}, function(data){
                                            if(data.code == 1){
                                                $('#tabel_fakultas').DataTable().ajax.reload(null, false);
                                                iziToast.success({title: 'Data Fakultas berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});
                                            }
                                            else if(data.code == 0){
                                                $('#tabel_fakultas').DataTable().ajax.reload(null, false);
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
    //  DELETE FAKULTAS


// END CRIPT FAKULTAS

// SKRIP JURUSAN
    // TAMPIL DATA
    $(document).ready(function() {
            $('#tabel_jurusan').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('jurusan.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_jurusan',name:'kode_jurusan'},
                    {data:'nama_jurusan',name:'nama_jurusan'},
                    // {data:'kode_fakultas',name:'kode_fakultas'},
                    {data:'action',name:'action'}
                ],
                order: [[0, 'asc']]

            })
          
        } );
 // END TAMPIL DATA

 //TOMBOL TAMBAH DATA JURUSAN
            //jika tombol-tambah diklik maka
        $(document).on('click','#tombol-tambah-jurusan', function(){
            $('#button-simpan-jurusan').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-jurusan').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Jurusan Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-jurusan').modal('show'); //modal tampil
                    
        });
    
        // TAMBAH DATA JURUSAN
        if ($("#form-tambah-jurusan").length > 0) {
            $("#form-tambah-jurusan").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-jurusan').val();
                    $('#tombol-simpan-jurusan').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-jurusan')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('jurusan.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                            console.log(data.errors);
                            if(data.status == 0) {
                                if(data.errors.kode_jurusan){
                                    $('#kodeJurusanCheck').html(data.errors.kode_jurusan[0]);
                                }
                                if(data.errors.nama_jurusan){
                                    $('#namaJurusanCheck').html(data.errors.nama_jurusan[0]);
                                }
                               
                              $('#tombol-simpan-jurusan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-jurusan').trigger("reset"); //form reset
                                $('#tambah-modal-jurusan').modal('hide'); //modal hide
                                $('#tabel_jurusan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Jurusan Berhasil Disimpan',
                                
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
        // END TAMBAH DATA JURUSAN

         // KLIK TOMBOL EDIT
         $(document).on('click','.edit-post-jurusan', function(){
                var kode_jurusan = $(this).data('kode_jurusan');
              
                $('.editJurusan').find('form')[0].reset();
                $("#kode_Getfakultas_select").empty();
                $('.editJurusan').find('span.error-text').text('');
                // console.log(kode_jabatan);
    
                $.post('<?= route("get.jurusan.details") ?>',{kode_jurusan:kode_jurusan}, function(data){
                        //  alert(data.details.nama_golongan);
                        // console.log(data.details);

                        $('.editJurusan').find('input[name="kode_jurusan_id"]').val(data.details.kode_jurusan);
                        $('.editJurusan').find('input[name="kode_jurusan"]').val(data.details.kode_jurusan);
                        $('.editJurusan').find('input[name="nama_jurusan"]').val(data.details.nama_jurusan);
                        $("#kode_Getfakultas_select").append('<option value="'+data.details.kode_fakultas+'">'+data.details.fakultas.nama_fakultas+'</option>');
                       
                       $.each(data.fakultas,function(key,entry){
                            $("#kode_Getfakultas_select").append('<option value="'+entry.kode_fakultas+'">'+entry.nama_fakultas+'</option>');
                                                  
                        }); 
                       
                        $('.editJurusan').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

     //UPDATE JURUSAN DETAILS
     $('#update-jurusan-form').on('submit', function(e){
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
                               
                                if(data.error.kode_jurusan){
                                    $('#jurusan_kode_error').html(data.error.kode_jurusan[0]);
                                }
                                if(data.error.nama_jurusan){
                                    $('#jurusan_name_error').html(data.error.nama_jurusan[0]);
                                }
                                if(data.error.nama_jurusan){
                                    $('#jurusan_name_error').html(data.error.nama_jurusan[0]);
                                }
                              }else{
                                
                                $('#update-jurusan-form').trigger("reset"); //form reset
                                $('.editJurusan').modal('hide'); //modal hide
                                $('#tabel_jurusan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Jurusan Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
            // END UPDATE JURUSAN

  // DELETE JURUSAN
          
        $(document).on('click','#deleteJurusanBtn', function(){
         
                                var kode_jurusan = $(this).data('id');
                                var url = '<?= route("delete.jurusan") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Jurusan',
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
                                        $.post(url,{kode_jurusan:kode_jurusan}, function(data){
                                            if(data.code == 1){
                                                $('#tabel_jurusan').DataTable().ajax.reload(null, false);
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

            // END  DELETE JURUSAB


// END SKRIP JURUSAN
 


</script>
