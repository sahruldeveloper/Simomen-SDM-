<script type="text/javascript">
    // $(document).ready(function () {
    //   $('input[type="radio"]').click(function () {
    //     var inputValue = $(this).attr("value");
    //   if(inputValue == 'Pegawai YLPI') {
    //     $("#nidn_petinggi").prop("disabled", false);
    //     $("#npk_petinggi").prop("disabled", false);
    //     $("#tmp_lahir_petinggi").prop("disabled", true);
    //     $("#tgl_lahir_petinggi").prop("disabled", true);
    //     $("#pendidikan_petinggi").prop("disabled", true);
    //     $('#jenkel_petinggi').attr('disabled', 'true');
      
    //   }else{
    //     $("#nidn_petinggi").prop("disabled", true);
    //     $("#npk_petinggi").prop("disabled", true);

    //     $("#tmp_lahir_petinggi").prop("disabled", false);
    //     $("#tgl_lahir_petinggi").prop("disabled", false);
    //     $("#pendidikan_petinggi").prop("disabled", false);
      
    //     document.getElementById("jenkel_petinggi").removeAttribute("disabled");  
    //   }
       
    //   });
    // });
  </script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

     // fungsi untuk auto value golongan digunakan pada page edit petinggi

     function EditGetGolonganFromPangkat(){
            let  kode_pangkat = $("#get-select-pangkat-petinggi").val();
      
                $("#get-select-golongan-petinggi").empty();
             
                $("#get-select--petinggi").prop("disabled", true);
                $('#get-select--petinggi').find('span.error-text').text('');
            if(kode_pangkat != '' && kode_pangkat!=null){
                 $.post('<?= route("get.golongan.from.pangkat") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);
                         $("#get-select-golongan-petinggi").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-golongan-petinggi").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
    // fungsi untuk auto value golongan

     // script petinggi ylpi
     $('#tombol-tambah-petinggi').click(function () {
            $('#tombol-simpan-petinggi').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-petinggi').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Data Pengurus YLPI Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-petinggi').modal('show'); //modal tampil
        });

        if ($("#form-tambah-petinggi").length > 0) {
            $("#form-tambah-petinggi").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-petinggi').val();
                    $('#tombol-simpan-petinggi').html('Sending..');

                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function(){
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                         console.log(data);
                            if(data.status == 0) {
                                if(data.errors.npk){
                                    $('#npkPetinggiCheck').html(data.errors.npk[0]);
                                }
                                if(data.errors.nama_petinggi){
                                    $('#namaPetinggiCheck').html(data.errors.nama_petinggi[0]);
                                }
                                if(data.errors.password){
                                    $('#passwordPetinggiCheck').html(data.errors.password[0]);
                                }
                                if(data.errors.email){
                                    $('#emailPetinggiCheck').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirlPetinggiCheck').html(data.errors.tmp_lahir[0]);
                                }
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirPetinggiCheck').html(data.errors.tgl_lahir[0]);
                                }
                                if(data.errors.tgl_sk){
                                    $('#tgl_skPetinggiCheck').html(data.errors.tgl_sk[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminPetinggiCheck').html(data.errors.jenis_kelamin[0]);
                                }
                                if(data.errors.kode_golongan){
                                    $('#kode_golonganPetinggiCheck').html(data.errors.kode_golongan[0]);
                                }
                                
                                if(data.errors.kode_pangkat){
                                    $('#kode_jabatanPetinggiCheck').html(data.errors.kode_pangkat[0]);
                                }
                                if(data.errors.deskripsi){
                                    $('#deskripsiPetinggiCheck').html(data.errors.deskripsi[0]);
                                }
                                if(data.errors.pendidikan){
                                    $('#endidikanPetinggiCheck').html(data.errors.pendidikan[0]);
                                }
                                if(data.errors.foto){
                                    $('#fotoPetinggiCheck').html(data.errors.foto[0]);
                                }
                              $('#tombol-simpan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-petinggi').trigger("reset"); //form reset
                                 $('#tombol-simpan-petinggi').html('Simpan');

                                $('#tambah-modal-petinggi').modal('hide'); //modal hide
                                location.reload(true);
                                // $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Petinggi Berhasil Disimpan',
                                
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
        $(document).on('click','.edit-post-petinggi', function(){
            // alert('data');
                var id = $(this).data('id');
              
                $('.editPetinggi').find('form')[0].reset();
                $("#JenisKelaminPetinggiSelect").empty();
                $("#get-select-pangkat-petinggi").empty();
                $("#get-select-golongan-petinggi").empty();
              
                $('.editPetinggi').find('span.error-text').text('');
                // console.log(kode_pegawai);
    
                $.post('<?= route("get.petinggi.details") ?>',{id:id}, function(data){
                        
                    // console.log(data.details.pegawai.tgl_lahir);
                    if(data.details.pegawai == null) {
                        $('.editPetinggi').find('input[name="npk"]').val('');
                        $('.editPetinggi').find('input[name="id"]').val(data.details.id);
                        $('.editPetinggi').find('input[name="nama"]').val(data.details.nama);
                     
                        $('.editPetinggi').find('input[name="tmp_lahir"]').val(data.details.tmp_lahir);
                        $('.editPetinggi').find('input[name="tgl_lahir"]').val(data.details.tgl_lahir);
                        $("#JenisKelaminPetinggiSelect").append('<option value="'+data.details.jenis_kelamin+'">'+data.details.jenis_kelamin+'</option>',);

                        $("#JenisKelaminPetinggiSelect").append('<option value="pria">pria</option>',);
                        $("#JenisKelaminPetinggiSelect").append('<option value="wanita">wanita</option>',);
                      
                    } else if(data.details.pegawai != null) {
                        $('.editPetinggi').find('input[name="npk"]').val(data.details.npk);
                        $('.editPetinggi').find('input[name="id"]').val(data.details.id);
                        $('.editPetinggi').find('input[name="nama"]').val(data.details.pegawai.nama);
                       
                        $('.editPetinggi').find('input[name="tmp_lahir"]').val(data.details.pegawai.tmp_lahir);
                        $('.editPetinggi').find('input[name="tgl_lahir"]').val(data.details.pegawai.tgl_lahir);
                        $("#JenisKelaminPetinggiSelect").append('<option value="'+data.details.pegawai.jenis_kelamin+'">'+data.details.pegawai.jenis_kelamin+'</option>',);

                        $("#JenisKelaminPetinggiSelect").append('<option value="pria">pria</option>',);
                        $("#JenisKelaminPetinggiSelect").append('<option value="wanita">wanita</option>',);
                      
                    }
                      
                    $('.editPetinggi').find('input[name="pendidikan"]').val(data.details.pendidikan);
                      
                        $('.editPetinggi').find('input[name="email"]').val(data.details.email);
                        // $('.editPetinggi').find('input[name="password"]').val(data.details.password);
                      
                     
                        
                       
                      
                       
                      
                    

                        
                       
                        $('.editPetinggi').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

    //  update data petinggi
    $('#update-petinggi-form').on('submit', function(e){
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
                            console.log(data)
                              if(data.code == 0){
                               
                                if(data.errors.npk){
                                    $('#npkPetinggiCheckEdit').html(data.errors.npk[0]);
                                }
                                if(data.errors.nama_petinggi){
                                    $('#namaPetinggiCheckEdit').html(data.errors.nama_petinggi[0]);
                                }
                                if(data.errors.password){
                                    $('#passwordPetinggiCheckEdit').html(data.errors.password[0]);
                                }
                                if(data.errors.email){
                                    $('#emailPetinggiCheckEdit').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirPegawaiCheckEdit').html(data.errors.tmp_lahir[0]);
                                }
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirPetinggiCheckEdit').html(data.errors.tgl_lahir[0]);
                                }
                                if(data.errors.tgl_sk){
                                    $('#tgl_skPetinggiCheckEdit').html(data.errors.tgl_sk[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminPetinggiCheckEdit').html(data.errors.jenis_kelamin[0]);
                                }
                                if(data.errors.kode_golongan){
                                    $('#kode_golonganPetinggiCheckEdit').html(data.errors.kode_golongan[0]);
                                }
                                
                                if(data.errors.kode_pangkat){
                                    $('#kode_jabatanPetinggiCheckEdit').html(data.errors.kode_pangkat[0]);
                                }
                                if(data.errors.deskripsi){
                                    $('#deskripsiPetinggiCheckEdit').html(data.errors.deskripsi[0]);
                                }
                                if(data.errors.foto){
                                    $('#fotoPetinggiCheckEdit').html(data.errors.foto[0]);
                                }
                              }else{
                                
                                $('#update-petinggi-form').trigger("reset"); //form reset
                                $('.editPetinggi').modal('hide'); //modal hide
                                location.reload(true);
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
    // END EDIT PEGAWAI
    //  update data petinggi

    //DELETE PETINGGI YLPI
    $(document).on('click','#deletePetinggiBtn', function(){
                                var id = $(this).data('id');
                                var url = '<?= route("delete.petinggi") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Petinggi YLPI',
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
                                        $.post(url,{id:id}, function(data){
                                            if(data.code == 1){
                                               
                                                iziToast.success({title: 'Data berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'});

                                                   
                                            }else{
                                                iziToast.error( {
                                                    title: 'Data gagal dihapus',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'
                                                });
                                            }
                                            location.reload(true);
                                        },'json');
                                    }
                                });

                            });

            // END  DELETE GOLONGAN

    // end script petinggi ylpi
</script>