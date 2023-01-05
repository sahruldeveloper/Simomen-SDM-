<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
              getDataPegawaiPageAdmin(page);
            
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '#page_pegawai_admin_links a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getDataPegawaiPageAdmin(page);
        
           
        });
  
    });

  
    function getDataPegawaiPageAdmin(page){
        $.ajax(
        {
            url: 'dataPegawai?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#read_data_pegawai").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }

    
  </script>
<script>
     $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $(document).ready(function (){
      read_data_pegawai();
      proses_edit_kategori_pegawai();

      $('#search_data_pegawai').keyup(function() {
        var strcari = $('#search_data_pegawai').val();
        if(strcari != "") {
            $.ajax({
                type:"get",
                url: "{{url('admin/dataPegawai') }}",
                data: "search=" + strcari,
                success: function(data) {
                    $("#read_data_pegawai").html(data);
                }
            });
        }else {
            read_data_pegawai()
        }
      });
    });

    function read_data_pegawai() {
        $.get("{{ url('admin/dataPegawai') }}", {}, function(data, status){
            $("#read_data_pegawai").html(data);
        });
    }

    function proses_input_kategori_pegawai(){
        var status_pegawai =document.getElementById("status_pegawai_add").value;
        console.log(status_pegawai);
        var select_jabatan = document.getElementById('select_jabatan');
        
        if(status_pegawai == "Kontrak") {
           
            $("#npk_pegawai").prop("disabled", true);
            $("#start_tgl_sk_kontrak_pegawai").prop("disabled", false);
            $("#end_tgl_sk_kontrak_pegawai").prop("disabled", false);
            $("#tgl_sk_yayasan_pegawai").prop("disabled", true);
            $('#select-pangkat').attr('disabled', 'disabled');
            $('#get-select-golongan').attr('disabled', 'disabled');
            $('#select-verif-data-pangkat').attr('disabled', 'disabled');
            document.getElementById("#start_tgl_sk_kontrak_pegawai").removeAttribute("disabled");  
            document.getElementById("#end_tgl_sk_kontrak_pegawai").removeAttribute("disabled");  
            
            
        }else {
            $("#npk_pegawai").prop("disabled", false);
            $("#start_tgl_sk_kontrak_pegawai").prop("disabled", true);
            $("#end_tgl_sk_kontrak_pegawai").prop("disabled", true);
            $("#tgl_sk_yayasan_pegawai").prop("disabled", false);
           
          
            document.getElementById("select-pangkat").removeAttribute("disabled");  
            document.getElementById("get-select-golongan").removeAttribute("disabled");  
            document.getElementById("select-verif-data-pangkat").removeAttribute("disabled");  
           
           
      
            
        }
     
    }
    function proses_edit_kategori_pegawai(){
        var status_pegawai =document.getElementById("get-select-status").value;
        console.log(status_pegawai);
      
        if(status_pegawai == "Kontrak") {
           
            $("#npk_pegawai_edit").prop("disabled", true);
          
            $("#tgl_sk_yayasan_pegawai_edit").prop("disabled", true);
            $('#get-select-pangkat').attr('disabled', 'disabled');
            $('#get-select-golongan-pegawai').attr('disabled', 'disabled');
            $('#get-select-verif-data-pangkat').attr('disabled', 'disabled');
            document.getElementById("start_tgl_sk_kontrak_pegawai_edit").removeAttribute("disabled");  
            document.getElementById("end_tgl_sk_kontrak_pegawai_edit").removeAttribute("disabled");  
            
            
        }else {
            $("#npk_pegawai_edit").prop("disabled", false);
            $("#start_tgl_sk_kontrak_pegawai_edit").prop("disabled", true);
            $("#end_tgl_sk_kontrak_pegawai_edit").prop("disabled", true);
            $("#tgl_sk_yayasan_pegawai_edit").prop("disabled", false);
           
          
            document.getElementById("get-select-pangkat").removeAttribute("disabled");  
            document.getElementById("get-select-golongan-pegawai").removeAttribute("disabled");  
            document.getElementById("get-select-verif-data-pangkat").removeAttribute("disabled");  
           
           
      
            
        }
     
    }

    // fungsi untuk auto value golongan
     // to edit page pegawai
         // update sub kategori (jabatan)
         function GetGolonganFromPangkat(){
            let  kode_pangkat = $("#select-pangkat").val();
      
                $("#get-select-golongan").empty();
             
                $("#get-select-golongan").prop("disabled", true);
                $('#get-select-golongan').find('span.error-text').text('');
            if(kode_pangkat != '' && kode_pangkat!=null){
                 $.post('<?= route("get.golongan.from.pangkat") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);
                         $("#get-select-golongan").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-golongan").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        // 

        // Edit Pegawai
        function GetGolonganFromPangkatToEdit(){
            let  kode_pangkat = $("#get-select-pangkat").val();
      
                $("#get-select-golongan-pegawai").empty();
             
                $("#get-select-pegawai").prop("disabled", true);
                $('#get-select-pegawai').find('span.error-text').text('');
            if(kode_pangkat != '' && kode_pangkat!=null){
                 $.post('<?= route("get.golongan.from.pangkat") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);
                         $("#get-select-golongan-pegawai").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-golongan-pegawai").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
   


//    start tambah data
     $('#tombol-tambah-pegawai').click(function () {
            $('#tombol-simpan-pegawai').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-pegawai').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Pegawai Baru"); //valuenya tambah pegawai baru
            $('#tambah-modal-pegawai').modal('show'); //modal tampil
        });

        if ($("#form-tambah-pegawai").length > 0) {
            $("#form-tambah-pegawai").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-pegawai').val();
                    $('#tombol-simpan-pegawai').html('Sending..');

                   
                    
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
                                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Cek kembali Pengisian Form',
                                timeout: 10000,
                                message: '{{ Session('
                                error ')}}',
                                position: 'topRight'
                            });
                                if(data.errors.npk){
                                    $('#npkPegawaiCheckAdd').html(data.errors.npk[0]);
                                }
                                if(data.errors.nama){
                                    $('#namaPegawaiCheckAdd').html(data.errors.nama[0]);
                                }
                                if(data.errors.email){
                                    $('#emailPegawaiCheckAdd').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirPegawaiCheckAdd').html(data.errors.tmp_lahir[0]);
                                }
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirPegawaiCheckAdd').html(data.errors.tgl_lahir[0]);
                                }
                                  
                                if(data.errors.tgl_sk_yayasan){
                                    $('#tgl_sk_yayasanPegawaiCheckAdd').html(data.errors.tgl_sk_yayasan[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminPegawaiCheckAdd').html(data.errors.jenis_kelamin[0]);
                                }
                                if(data.errors.kode_pangkat){
                                    $('#kode_pangkatPegawaiCheckAdd').html(data.errors.kode_pangkat[0]);
                                }
                                if(data.errors.kode_golongan){
                                    $('#kode_golonganPegawaiCheckAdd').html(data.errors.kode_golongan[0]);
                                }
                              
                                if(data.errors.verif_data_pangkat){
                                    $('#verif_data_pangkatPegawaiCheckAdd').html(data.errors.verif_data_pangkat[0]);
                                }
                             
                                if(data.errors.foto){
                                    $('#fotoPegawaiCheckAdd').html(data.errors.foto[0]);
                                }
                              $('#tombol-simpan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-pegawai').trigger("reset"); //form reset
                                 $('#tombol-simpan-pegawai').html('Simpan');

                                $('#tambah-modal-pegawai').modal('hide'); //modal hide
                              
                                // $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Pegawai Berhasil Disimpan',
                                
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight',
                                timeout: 15000,
                            });
                            location.reload(true);
                            }
                            
                        }
                      
                    });
                }
            });
        }
  
//    end tambah data

// Start Edit
  // KLIK TOMBOL EDIT
  $(document).on('click','.edit-post-pegawai', function(){
                var id = $(this).data('id');
              
                $('.editPegawai').find('form')[0].reset();
                $("#JenisKelaminPegawaiSelect").empty();
                $("#PendidikanSelect").empty();
               
                $("#get-select-pangkat").empty();
                $("#get-select-status").empty();
                $("#get-select-verif-data-pensiun").empty();
                $("#get-select-verif-data-pangkat").empty();
                $('.editJabatan').find('span.error-text').text('');
                // console.log(kode_pegawai);
    
                $.post('<?= route("get.pegawai.details") ?>',{id:id}, function(data){
                        
                    console.log(data.details);
                    if(data.details.status == "Kontrak") {
                            $("#npk_pegawai_edit").prop("disabled", true);
                            $("#tgl_sk_yayasan_pegawai_edit").prop("disabled", true);
                            $("#start_sk_kontrak_edit").prop("disabled", false);
                            $("#end_sk_kontrak_edit").prop("disabled", false);
                            $("#get-select-pangkat").prop("disabled", true);
                            $("#get-select-golongan-pegawai").prop("disabled", true);
                            $("#get-select-verif-data-pangkat").prop("disabled", true);
 
                    }else {
                        $("#npk_pegawai_edit").prop("disabled", false);
                        $("#start_sk_kontrak_pegawai_edit").prop("disabled", true);
                        $("#end_sk_kontrak_pegawai_edit").prop("disabled", true);
                        $("#tgl_sk_yayasan_pegawai_edit").prop("disabled", false);
                    
                        document.getElementById("get-select-pangkat").removeAttribute("disabled");  
                        document.getElementById("get-select-golongan-pegawai").removeAttribute("disabled");  
        
                        document.getElementById("get-select-verif-data-pangkat").removeAttribute("disabled");  

                    }
                        $('.editPegawai').find('input[name="npk"]').val(data.details.npk);
                        $('.editPegawai').find('input[name="id"]').val(data.details.id);
                        $('.editPegawai').find('input[name="nama"]').val(data.details.nama);
                        $('.editPegawai').find('input[name="email"]').val(data.details.email);
                        $('.editPegawai').find('input[name="tmp_lahir"]').val(data.details.tmp_lahir);
                        $('.editPegawai').find('input[name="tgl_lahir"]').val(data.details.tgl_lahir);
                        $('.editPegawai').find('input[name="tgl_sk_yayasan"]').val(data.details.tgl_sk_yayasan);
                        $('.editPegawai').find('input[name="start_tgl_sk_kontrak"]').val(data.details.start_tgl_sk_kontrak);
                        $('.editPegawai').find('input[name="end_tgl_sk_kontrak"]').val(data.details.end_tgl_sk_kontrak);
                        $('.editPegawai').find('input[name="pendidikan_sd"]').val(data.details.jenjang_pendidikan_pegawai.sd);
                        $('.editPegawai').find('input[name="pendidikan_smp"]').val(data.details.jenjang_pendidikan_pegawai.smp);
                        $('.editPegawai').find('input[name="pendidikan_sma"]').val(data.details.jenjang_pendidikan_pegawai.sma);
                        $('.editPegawai').find('input[name="pendidikan_strata_pegawai"]').val(data.details.jenjang_pendidikan_pegawai.pendidikan_strata);
                        $('.editPegawai').find('input[name="pendidikan_magister_pegawai"]').val(data.details.jenjang_pendidikan_pegawai.pendidikan_magister);
                        $('.editPegawai').find('input[name="pendidikan_doctor_pegawai"]').val(data.details.jenjang_pendidikan_pegawai.pendidikan_doctor);
                        
                
                        $("#JenisKelaminPegawaiSelect").append('<option value="'+data.details.jenis_kelamin+'">'+data.details.jenis_kelamin+'</option>',);

                        $("#JenisKelaminPegawaiSelect").append('<option value="pria">pria</option>',);
                        $("#JenisKelaminPegawaiSelect").append('<option value="wanita">wanita</option>',);

                        $('.editPegawai').find('input[name="pendidikan_strata"]').val(data.details.pendidikan_strata);
                        $('.editPegawai').find('input[name="pendidikan_magister"]').val(data.details.pendidikan_magister);
                        $('.editPegawai').find('input[name="pendidikan_doctor"]').val(data.details.pendidikan_doctora);

                    

            
                       
                        
                        if(data.details.kode_pangkat == '' || data.details.kode_pangkat == null) {
                            $("#get-select-pangkat").append('<option value=""></option>');
                              
                        }
                        else {
                            $("#get-select-pangkat").append('<option value="'+data.details.kode_pangkat+'">'+data.details.pangkat.nama_pangkat+'</option>');
                         
                        }                       
                            $.each(data.pangkat,function(key,entry){
                                    $("#get-select-pangkat").append('<option value="'+entry.kode_pangkat+'">'+entry.nama_pangkat+'</option>');
                                                        
                                }); 
                        
                        if(data.details.kode_golongan == '' || data.details.kode_golongan == null ) {
                            $("#get-select-golongan-pegawai").append('<option value=""></option>');
                              
                        }
                        else {
                            $("#get-select-golongan-pegawai").append('<option value="'+data.details.kode_golongan+'">'+data.details.golongan.nama_golongan+'</option>');
                        }
                        // $("#get-select-golongan-pegawai").append('<option value="'+data.details.kode_golongan+'">'+data.details.golongan.nama_golongan+'</option>',);        
                        $("#get-select-status").append('<option value="'+data.details.status+'">'+data.details.status+'</option>',);
                        $("#get-select-status").append('<option value="Aktif">Aktif/Tetap</option>',);
                        $("#get-select-status").append('<option value="Kontrak">Kontrak</option>',);
                     
                      

                        $("#get-select-verif-data-pangkat").append('<option value="'+data.details.verif_data_pangkat+'">'+data.details.verif_data_pangkat+'</option>',);
                        $("#get-select-verif-data-pangkat").append('<option value="Sudah">Sudah</option>',);
                        $("#get-select-verif-data-pangkat").append('<option value="Belum">Belum</option>',);

                        // $("#get-select-verif-data-pensiun").append('<option value="'+data.details.verif_data_pensiun+'">'+data.details.verif_data_pensiun+'</option>',);
                        // $("#get-select-verif-data-pensiun").append('<option value="Sudah">Sudah</option>',);
                        // $("#get-select-verif-data-pensiun").append('<option value="Belum">Belum</option>',);
                   
                       
                        $('.editPegawai').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

     $('#update-pegawai-form').on('submit', function(e){
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
                                    $('#npkPegawaiCheckEdit').html(data.errors.npk[0]);
                                }
                                if(data.errors.npk){
                                    $('#namaPegawaiCheckEdit').html(data.errors.nama_pegawai[0]);
                                }
                                if(data.errors.email){
                                    $('#emailPegawaiCheckEdit').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirPegawaiCheckEdit').html(data.errors.tmp_lahir[0]);
                                }
                
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirPegawaiCheckEdit').html(data.errors.tgl_lahir[0]);
                                }
                                if(data.errors.tgl_sk){
                                    $('#tgl_skPegawaiCheck').html(data.errors.tgl_sk[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminPegawaiCheckEdit').html(data.errors.jenis_kelamin[0]);
                                }
                                if(data.errors.kode_golongan){
                                    $('#kode_golonganPegawaiCheck').html(data.errors.kode_golongan[0]);
                                }
                                if(data.errors.status){
                                    $('#statusPegawaiChecKEdit').html(data.errors.status[0]);
                                }
                            
                            
                                if(data.errors.foto){
                                    $('#fotoPegawaiCheckEdit').html(data.errors.foto[0]);
                                }
                              }else{
                                
                                $('#update-pegawai-form').trigger("reset"); //form reset
                                $('.editPegawai').modal('hide'); //modal hide
                              
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Pegawai Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                                
                              });
                              read_data_pegawai();
                            //   location.reload(true);
                            }
                              
                        }
                    });
                });
    // END EDIT PEGAWAI

    // delete pegawai
    $(document).on('click','#deletePegawaiBtn', function(){
                                var id = $(this).data('id');
                                var url = '<?= route("delete.pegawai") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Pegawai',
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
                                                    title: 'Data gagal dihapus/ data berelasi!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight'
                                                });
                                            }
                                            read_data_pegawai();
                                        },'json');
                                    }
                                });

                            });


    // delete pegawai

// End Edit
        


  
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
    $(document).ready(function() {
        let start = moment().startOf('years')
        let end = moment().endOf('years')


        //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
        $('#exportpdf').attr('href', '/admin/pegawai-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //INISIASI DATERANGEPICKER
        $('#created_at').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
            //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
            $('#exportpdf').attr('href', '/admin/pegawai-report/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
</script>