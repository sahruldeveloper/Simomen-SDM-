<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
        
              getDataDosenPageAdmin(page);
           
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '#page_dosen_admin_links a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getDataDosenPageAdmin(page);
        
           
        });
  
    });

  
    function getDataDosenPageAdmin(page){
        $.ajax(
        {
            url: 'dataDosen?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#page_admin_read_data_dosen").empty().html(data);
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
      read_data_dosen();
     

      $('#search_dosen').keyup(function() {
        var strcari = $('#search_dosen').val();
        if(strcari != "") {
            $.ajax({
                type:"get",
                url: "{{url('admin/dataDosen') }}",
                data: "search=" + strcari,
                success: function(data) {
                    $("#page_admin_read_data_dosen").html(data);
                }
            });
        }else {
            read_data_dosen()
        }
      });
    });

    function read_data_dosen() {
        $.get("{{ url('admin/dataDosen') }}", {}, function(data, status){
            $("#page_admin_read_data_dosen").html(data);
          
        });
    }

    

    function proses_input_kategori_dosen(){
        var status_dosen =document.getElementById("status_dosen_add").value;
        console.log(status_dosen);
        var select_jabatan = document.getElementById('select_jabatan');
        
        if(status_dosen == "Kontrak") {
           
            $("#nidn_dosen").prop("disabled", true);
            $("#npk_dosen").prop("disabled", true);
            $("#start_tgl_sk_kontrak").prop("disabled", false);
            $("#end_tgl_sk_kontrak").prop("disabled", false);
            $("#tgl_sk_add").prop("disabled", true);
            $("#tgl_sk_yayasan").prop("disabled", true);
            $('#select-jabatan').attr('disabled', 'disabled');
            $('#SubKategoriPangkat').attr('disabled', 'disabled');
            $('#add-select-golongan-dosen').attr('disabled', 'disabled');
            $('#select-verif-data-pangkat-input').attr('disabled', 'disabled');
            
            
           
        }else {
            $("#nidn_dosen").prop("disabled", false);
            $("#npk_dosen").prop("disabled", false);
            $("#start_tgl_sk_kontrak").prop("disabled", true);
            $("#end_tgl_sk_kontrak").prop("disabled", true);
            $("#tgl_sk_add").prop("disabled", false);
            $("#tgl_sk_yayasan").prop("disabled", false);
            $("#kode_golonganDosenCheckAdd").prop("disabled", false);
            $("#kode_jabatanDosenCheckAdd").prop("disabled", false);
            $("#kode_pangkatDosenCheckAdd").prop("disabled", false);
          
            $("#tgl_sk_yayasan").prop("disabled", false);
            document.getElementById("select-jabatan").removeAttribute("disabled");  
            document.getElementById("SubKategoriPangkat").removeAttribute("disabled");  
            document.getElementById("add-select-golongan-dosen").removeAttribute("disabled");  
            document.getElementById("select-verif-data-pangkat-input").removeAttribute("disabled");  
           
      
            
        }
     
    }

    
    function proses_edit_kategori_dosen(){
        var kategori_dosen =document.getElementById("KategoriDosenSelect").value;
        console.log(kategori_dosen);
        if(kategori_dosen == "Kontrak") {
          
            $("#nidn_dosen_edit").prop("disabled", true);
            $("#npk_dosen_edit").prop("disabled", true);
            $("#tgl_sk_edit").prop("disabled", true);
            $("#start_sk_kontrak_edit").prop("disabled", false);
            $("#end_sk_kontrak_edit").prop("disabled", false);
            $("#get-select-jabatan-dosen").prop("disabled", true);
            $("#get-select-pangkat-dosen-edit").prop("disabled", true);
            $("#get-select-golongan-dosen-edit").prop("disabled", true);
            $("#tgl_sk_uir_edit").prop("disabled", true);
            $("#tgl_sk_yayasan_edit").prop("disabled", true);
             
            $('#get-select-golongan-dosen-edit').attr('value', '');  
               $('#verif-data-pangkat-edit-dosen').attr('disabled', 'disabled');
            
            
           
        }else {
            $("#nidn_dosen_edit").prop("disabled", false);
            $("#npk_dosen_edit").prop("disabled", false);
            $("#start_sk_kontrak_edit").prop("disabled", true);
            $("#end_sk_kontrak_edit").prop("disabled", true);
            $("#tgl_sk_edit").prop("disabled", false);
            $("#tgl_sk_yayasan_edit").prop("disabled", false);
            $("#tgl_sk_uir_edit").prop("disabled", false);
            document.getElementById("get-select-jabatan-dosen").removeAttribute("disabled");  
            document.getElementById("get-select-pangkat-dosen-edit").removeAttribute("disabled");  
            document.getElementById("get-select-golongan-dosen-edit").removeAttribute("disabled");  
            document.getElementById("get-select-pangkat-dosen-edit").removeAttribute("disabled");  
            document.getElementById("verif-data-pangkat-edit-dosen").removeAttribute("disabled");  
           
        }
     
    }

    function GetGolonganFromPangkatToEditDosen(){
            let  kode_pangkat = $("#get-select-pangkat-dosen-edit").val();
      
                $("#get-select-golongan-dosen-edit").empty();
             
                $("#get-select-golongan-dosen-edit").prop("disabled", true);
                $('#get-select-golongan-dosen-edit').find('span.error-text').text('');
            if(kode_pangkat != '' && kode_pangkat!=null){
                 $.post('<?= route("get.golongan.from.pangkat.dosen") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);
                         $("#get-select-golongan-dosen-edit").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-golongan-dosen-edit").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }


          // update sub kategori (jurusan)
          function updateSubKategoriJurusan(){
            let  kode_fakultas = $("#get-select-fakultas-dosen").val();
          
                $("#get-select-jurusan-dosen").empty();
                // $("#get-select-jurusan-dosen").append('<option >Pilih Jurusan</option>');
                $("#get-select-jurusan-dosen").prop("disabled", true);
                $('#get-select-jurusan-dosen').find('span.error-text').text('');
            if(kode_fakultas != '' && kode_fakultas!=null){
                 $.post('<?= route("get.jurusan.from.fakultas") ?>',{kode_fakultas:kode_fakultas}, function(data){
            
                         $("#get-select-jurusan-dosen").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-jurusan-dosen").append('<option value="'+entry.kode_jurusan+'">'+entry.nama_jurusan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        // update sub kategori jurusan

        function SubKategoriJurusan(){
            let  kode_fakultas = $("#select-fakultas").val();
          
                $("#select-jurusan").empty();
                $("#select-jurusan").append('<option >Pilih Jurusan</option>');
                $("#select-jurusan").prop("disabled", true);
                $('#select-jurusan').find('span.error-text').text('');
            if(kode_fakultas != '' && kode_fakultas!=null){
                 $.post('<?= route("get.jurusan.from.fakultas") ?>',{kode_fakultas:kode_fakultas}, function(data){
            
                         $("#select-jurusan").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#select-jurusan").append('<option value="'+entry.kode_jurusan+'">'+entry.nama_jurusan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        


        // update sub kategori pangkat/pangkat pada page halaman edit
        function EditSubKategoriPangkatDosen(){
            let  kode_jabatan = $("#get-select-jabatan-dosen").val();
          
                $("#get-select-pangkat-dosen-edit").empty();
          
                $("#get-select-pangkat-dosen-edit").prop("disabled", true);
                $('#get-select-pangkat-dosen-edit').find('span.error-text').text('');
            if(kode_jabatan != '' && kode_jabatan!=null){
                 $.post('<?= route("get.pangkat.from.jabatan") ?>',{kode_jabatan:kode_jabatan}, function(data){
                         console.log(data);
                         $("#get-select-pangkat-dosen-edit").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#get-select-pangkat-dosen-edit").append('<option value="'+entry.kode_pangkat+'">'+entry.nama_pangkat+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
        // update sub kategori pangkat/jabatan

    //   Fungsi untuk Form Tambah Dosen
    function GetGolonganFromPangkatDosen(){
            let  kode_pangkat = $("#SubKategoriPangkat").val();
                $("#add-select-golongan-dosen").empty();
                $("#add-select-golongan-dosen").prop("disabled", true);
                $('#add-select-golongan-dosen').find('span.error-text').text('');
            if(kode_pangkat != '' && kode_pangkat!=null){
                 $.post('<?= route("get.golongan.from.pangkat.dosen") ?>',{kode_pangkat:kode_pangkat}, function(data){
                         console.log(data);
                         $("#add-select-golongan-dosen").prop('disabled', false);
                       
                       $.each(data,function(key,entry){
                            $("#add-select-golongan-dosen").append('<option value="'+entry.kode_golongan+'">'+entry.nama_golongan+'</option>');
                                                  
                        }); 
                       
                       
                    },'json');
            }
          
        }
    //   Fungsi untuk Form Tambah Dosen




    
    

    $('#tombol-tambah-dosen').click(function () {
            $('#tombol-simpan-dosen').val("create-post"); //valuenya menjadi create-post
            $('#form-tambah-dosen').trigger("reset"); //mereset semua input dll didalamnya
            $('span').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Data Dosen Baru"); //valuenya tambah pegawai baru
        
            $('#tambah-modal-dosen').modal('show'); //modal tampil
        
        });

        if ($("#form-tambah-dosen").length > 0) {
            $("#form-tambah-dosen").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan-dosen').val();
                    $('#tombol-simpan-dosen').html('Sending..');

                   
                    
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

                                if(data.errors.nidn){
                                    $('#nidnDosenCheckAdd').html(data.errors.nidn[0]);
                                }
                                if(data.errors.npk){
                                    $('#npkDosenCheckAdd').html(data.errors.npk[0]);
                                }
                                if(data.errors.nama){
                                    $('#namaDosenCheckAdd').html(data.errors.nama[0]);
                                }
                                if(data.errors.password){
                                    $('#passwordDosenCheckAdd').html(data.errors.password[0]);
                                }
                                if(data.errors.email){
                                    $('#emailDosenCheckAdd').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirlDosenCheckAdd').html(data.errors.tmp_lahir[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminDosenCheckAdd').html(data.errors.jenis_kelamin[0]);
                                }
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirDosenCheckAdd').html(data.errors.tgl_lahir[0]);
                                }
                                if(data.errors.tgl_sk_yayasan){
                                    $('#tgl_skDosenCheckAdd').html(data.errors.tgl_sk_yayasan[0]);
                                }
                                if(data.errors.start_tgl_sk_kontrak){
                                    $('#start_tgl_sk_kontrakDosenCheckAdd').html(data.errors.start_tgl_sk_kontrak[0]);
                                }
                                if(data.errors.end_tgl_sk_kontrak){
                                    $('#end_tgl_sk_kontrakDosenCheckAdd').html(data.errors.end_tgl_sk_kontrak[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminDosenCheckAdd').html(data.errors.jenis_kelamin[0]);
                                }
                                if(data.errors.kode_golongan){
                                    $('#kode_golonganDosenCheckAdd').html(data.errors.kode_golongan[0]);
                                }
                                
                                if(data.errors.kode_jabatan){
                                    $('#add_kode_jabatanDosenCheckAdd').html(data.errors.kode_jabatan[0]);
                                }
                                
                                if(data.errors.kode_pangkat){
                                    $('#add_kode_pangkatDosenCheckAdd').html(data.errors.kode_pangkat[0]);
                                }
                                if(data.errors.kode_fakultas){
                                    $('#kode_fakultasDosenCheckAdd').html(data.errors.kode_fakultas[0]);
                                }
                                if(data.errors.kode_jurusan){
                                    $('#kode_jurusabDosenCheckAdd').html(data.errors.kode_jurusan[0]);
                                }
                                if(data.errors.tgl_sk_yayasan){
                                    $('#tgl_sk_yayasanDosenCheckAdd').html(data.errors.tgl_sk_yayasan[0]);
                                }
                                if(data.errors.tgl_sk_uir){
                                    $('#tgl_sk_uirDosenCheckAdd').html(data.errors.tgl_sk_uir[0]);
                                }
                                if(data.errors.pendidikan_strata){
                                    $('#pendidikanStrataDosenCheckAdd').html(data.errors.pendidikan_strata[0]);
                                }
                                if(data.errors.pendidikan_magister){
                                    $('#pendidikanMagisterDosenCheckAdd').html(data.errors.pendidikan_magister[0]);
                                }
                                
                                if(data.errors.foto){
                                    $('#fotoDosenCheckAdd').html(data.errors.foto[0]);
                                }
                              $('#tombol-simpan').html('Simpan');
                            
                            }else {
                                 $('#form-tambah-dosen').trigger("reset"); //form reset
                                 $('#tombol-simpan-dosen').html('Simpan');
                              

                                $('#tambah-modal-dosen').modal('hide'); //modal hide
                             
                                // $('#tabel_jabatan').DataTable().ajax.reload(null, false);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Dosen Berhasil Disimpan',
                                timeout: 10000,
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


    
          


        // tekan tombol edit
         // KLIK TOMBOL EDIT
         $(document).on('click','.edit-post-dosen', function(){
            // alert('data');
                var id = $(this).data('id');
                var kategori_dosen =document.getElementById("KategoriDosenSelect").value;
              
              
                $('.editDosen').find('form')[0].reset();
                $("#JenisKelaminSelect").empty();
                $("#KategoriDosenSelect").empty();
                $("#get-select-jabatan-dosen").empty();
                $("#get-select-jabatan-dosen").empty();
                $("#get-select-fakultas-dosen").empty();
                $("#get-select-jurusan-dosen").empty();
                $("#get-select-status-dosen").empty();
                $("#verif-data-pangkat-edit-dosen").empty();
              
                $('.editDosen').find('span.error-text').text('');
                // console.log(kode_pegawai);

                
    
                $.post('<?= route("get.dosen.details") ?>',{id:id}, function(data){
                        
                    console.log(data.details);

                    if(data.details.pegawai.status == "Kontrak") {
          
                        $("#nidn_dosen_edit").prop("disabled", true);
                        $("#npk_dosen_edit").prop("disabled", true);
                        $("#tgl_sk_edit").prop("disabled", true);
                        $("#start_sk_kontrak_edit").prop("disabled", false);
                        $("#end_sk_kontrak_edit").prop("disabled", false);
                        $("#get-select-jabatan-dosen").prop("disabled", true);
                        $("#get-select-pangkat-dosen-edit").prop("disabled", true);
                        $("#get-select-golongan-dosen-edit").prop("disabled", true);
                        $("#tgl_sk_uir_edit").prop("disabled", true);
                        $("#tgl_sk_yayasan_edit").prop("disabled", true);
                        
                        $('#get-select-golongan-dosen-edit').attr('value', '');  
                            $('#verif-data-pangkat-edit-dosen').attr('disabled', 'disabled');
          
        
                }else {
                    $("#nidn_dosen_edit").prop("disabled", false);
                    $("#npk_dosen_edit").prop("disabled", false);
                    $("#start_sk_kontrak_edit").prop("disabled", true);
                    $("#end_sk_kontrak_edit").prop("disabled", true);
                    $("#tgl_sk_edit").prop("disabled", false);
                    $("#tgl_sk_yayasan_edit").prop("disabled", false);
                    $("#tgl_sk_uir_edit").prop("disabled", false);
                    document.getElementById("get-select-jabatan-dosen").removeAttribute("disabled");  
                    document.getElementById("get-select-pangkat-dosen-edit").removeAttribute("disabled");  
                    document.getElementById("get-select-golongan-dosen-edit").removeAttribute("disabled");  
                    document.getElementById("get-select-pangkat-dosen-edit").removeAttribute("disabled");  
                    document.getElementById("verif-data-pangkat-edit-dosen").removeAttribute("disabled");  
         
                }

                        $('.editDosen').find('input[name="nidn"]').val(data.details.nidn);
                        $('.editDosen').find('input[name="id"]').val(data.details.id);
                      
                        $('.editDosen').find('input[name="npk"]').val(data.details.pegawai.npk);
                        $('.editDosen').find('input[name="nama"]').val(data.details.pegawai.nama);
                        $('.editDosen').find('input[name="email"]').val(data.details.pegawai.email);
                        $('.editDosen').find('input[name="sd"]').val(data.details.jenjang_pendidikan.sd);
                        $('.editDosen').find('input[name="smp"]').val(data.details.jenjang_pendidikan.smp);
                        $('.editDosen').find('input[name="sma"]').val(data.details.jenjang_pendidikan.sma);
                        $('.editDosen').find('input[name="pendidikan_strata"]').val(data.details.jenjang_pendidikan.pendidikan_strata);
                        $('.editDosen').find('input[name="pendidikan_magister"]').val(data.details.jenjang_pendidikan.pendidikan_magister);
                        $('.editDosen').find('input[name="pendidikan_doctor"]').val(data.details.jenjang_pendidikan.pendidikan_doctor);
                        $('.editDosen').find('input[name="tmp_lahir"]').val(data.details.pegawai.tmp_lahir);
                        $('.editDosen').find('input[name="tgl_lahir"]').val(data.details.pegawai.tgl_lahir);
                        $('.editDosen').find('input[name="tgl_sk_yayasan"]').val(data.details.pegawai.tgl_sk_yayasan);
                        $('.editDosen').find('input[name="tgl_sk_uir"]').val(data.details.tgl_sk_uir);
                        $('.editDosen').find('input[name="start_tgl_sk_kontrak"]').val(data.details.pegawai.start_tgl_sk_kontrak);
                        $('.editDosen').find('input[name="end_tgl_sk_kontrak"]').val(data.details.pegawai.end_tgl_sk_kontrak);
                     
                     
                        $("#KategoriDosenSelect").append('<option value="'+data.details.pegawai.status+'">'+data.details.pegawai.status+'</option>',);
                        $("#KategoriDosenSelect").append('<option value="Aktif">Aktif/Tetap</option>',);
                        $("#KategoriDosenSelect").append('<option value="Kontrak">Kontrak</option>',);
                      
                       

                        $("#JenisKelaminDosenSelect").append('<option value="'+data.details.pegawai.jenis_kelamin+'">'+data.details.pegawai.jenis_kelamin+'</option>',);

                        $("#JenisKelaminDosenSelect").append('<option value="pria">pria</option>',);
                        $("#JenisKelaminDosenSelect").append('<option value="wanita">wanita</option>',);

                    
                        if(data.details.pegawai.kode_jabatan == null) {
                            $("#get-select-jabatan-dosen").append('<option value=""></option>');
                                $.each(data.jabatan,function(key,entry){
                                        $("#get-select-jabatan-dosen").append('<option value="'+entry.kode_jabatan+'">'+entry.nama_jabatan+'</option>');
                                                    
                                }); 
                        }
                        else {
                            $("#get-select-jabatan-dosen").append('<option value="'+data.details.pegawai.kode_jabatan+'">'+data.details.pegawai.jabatan.nama_jabatan+'</option>');
                            $.each(data.jabatan,function(key,entry){
                                    $("#get-select-jabatan-dosen").append('<option value="'+entry.kode_jabatan+'">'+entry.nama_jabatan+'</option>');
                                                  
                        }); 
                        }

                        if(data.details.pegawai.kode_pangkat == '' || data.details.pegawai.kode_pangkat == null) {
                            $("#get-select-pangkat-dosen-edit").append('<option value=""></option>');
                              
                        }
                        else {
                            $("#get-select-pangkat-dosen-edit").append('<option value="'+data.details.pegawai.kode_pangkat+'">'+data.details.pegawai.pangkat.nama_pangkat+'</option>');
                         
                        }

                        if(data.details.pegawai.kode_golongan == '' || data.details.pegawai.kode_golongan == null ) {
                            $("#get-select-golongan-dosen-edit").append('<option value=""></option>');
                              
                        }
                        else {
                      
                            $("#get-select-golongan-dosen-edit").append('<option value="'+data.details.pegawai.kode_golongan+'">'+data.details.pegawai.golongan.nama_golongan+'</option>');
                        }

                    
            
                        $("#get-select-fakultas-dosen").append('<option value="'+data.details.kode_fakultas+'">'+data.details.fakultas.nama_fakultas+'</option>');
                       
                       $.each(data.fakultas,function(key,entry){
                               $("#get-select-fakultas-dosen").append('<option value="'+entry.kode_fakultas+'">'+entry.nama_fakultas+'</option>');
                                                   
                           }); 

                       
                        $("#get-select-jurusan-dosen").append('<option value="'+data.details.kode_jurusan+'">'+data.details.jurusan.nama_jurusan+'</option>');
                       
                        
                        $("#verif-data-pangkat-edit-dosen").append('<option value="'+data.details.pegawai.verif_data_pangkat+'">'+data.details.pegawai.verif_data_pangkat+'</option>',);
                        $("#verif-data-pangkat-edit-dosen").append('<option value="Sudah">Sudah</option>',);
                        $("#verif-data-pangkat-edit-dosen").append('<option value="Belum">Belum</option>',);



                        $('.editDosen').modal('show');
                       
                    },'json');
                    
        });
     // KLIK TOMBOL EDIT

        // end tekan tombol edit

    //proses edit
    //  update data petinggi
    $('#update-dosen-form').on('submit', function(e){
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
                               
                                if(data.errors.nidn){
                                    $('#nidnDosenCheck').html(data.errors.nidn[0]);
                                }
                                if(data.errors.nama_dosen){
                                    $('#namaDosenCheck').html(data.errors.nama_dosen[0]);
                                }
                                if(data.errors.email){
                                    $('#emailDosenCheck').html(data.errors.email[0]);
                                }
                                if(data.errors.tmp_lahir){
                                    $('#tmp_lahirlDosenCheck').html('Tempat Lahir harus diisi');
                                }
                                
                                if(data.errors.tgl_lahir){
                                    $('#tgl_lahirDosenCheck').html(data.errors.tgl_lahir[0]);
                                }
                                if(data.errors.tgl_sk){
                                    $('#tgl_skDosenCheck').html(data.errors.tgl_sk[0]);
                                }
                                if(data.errors.jenis_kelamin){
                                    $('#jenis_kelaminDosenCheck').html(data.errors.jenis_kelamin[0]);
                                }
                                // if(data.errors.status){
                                //     $('#statusDosenCheck').html(data.errors.status[0]);
                                // }
                                if(data.errors.kode_pangkat){
                                    $('#kode_pangkatDosenCheck').html(data.errors.kode_pangkat[0]);
                                }
                                
                                if(data.errors.kode_jabatan){
                                    $('#kode_jabatanDosenCheck').html(data.errors.kode_jabatan[0]);
                                }
                                if(data.errors.kode_fakultas){
                                    $('#kode_fakultasDosenCheck').html(data.errors.kode_fakultas[0]);
                                }
                                if(data.errors.kode_jurusan){
                                    $('#kode_jurusanDosenCheck').html(data.errors.kode_jurusan[0]);
                                }
                                if(data.errors.pendidikan){
                                    $('#kode_pendidikanDosenCheck').html(data.errors.pendidikan[0]);
                                }
                              
                                if(data.errors.foto){
                                    $('#fotoDosenCheck').html(data.errors.foto[0]);
                                }
                              }else{
                                
                                $('#update-dosen-form').trigger("reset"); //form reset
                                $('.editDosen').modal('hide'); //modal hide
                              
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Dosen Berhasil',
                             
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight',
                                timeout: 15000,
                              });
                              read_data_dosen();
                            }
                              
                        }
                    });
                });
    // END EDIT PEGAWAI
    //  update data petinggi 
    //end proses edit 

    // DELETE
    $(document).on('click','#deleteDosenBtn', function(){
                                var id = $(this).data('id');
                                var url = '<?= route("delete.dosen") ?>';

                                swal.fire({
                                    title:'Anda Yakin?',
                                    html:'Anda Menghapus <b>delete</b> Data Dosen YLPI',
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
                                                    timeout: 15000,
                                                    position: 'topRight'});

                                                   
                                            }else{
                                                iziToast.error( {
                                                    title: 'Data gagal dihapus',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight',
                                                    timeout: 15000,
                                                });
                                            }
                                            // location.reload(true);
                                            read_data_dosen();
                                        },'json');
                                    }
                                });

                            });

    // DELETE
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- section admin --}}
<script>
    //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
    $(document).ready(function() {
        let start = moment().startOf('years')
        let end = moment().endOf('years')

        //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
        $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //INISIASI DATERANGEPICKER
        $('#page_admin_date_dosen').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
            //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
            $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
</script>
{{-- section admin --}}
<script>
    //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
    $(document).ready(function() {
        let start = moment().startOf('years')
        let end = moment().endOf('years')

        //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
        $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //INISIASI DATERANGEPICKER
        $('#created_at_dosen').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
            //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
            $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
</script>