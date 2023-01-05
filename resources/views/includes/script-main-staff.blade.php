<script>

</script>



<script>
$.ajaxSetup({
     headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
});






$('#tombol-tambah-staff').click(function() {
     $('#tombol-simpan-staff').val("create-post"); //valuenya menjadi create-post
     $('#form-tambah-staff').trigger("reset"); //mereset semua input dll didalamnya
     $('span').trigger("reset"); //mereset semua input dll didalamnya
     $('#modal-judul').html("Tambah Data Dosen Baru"); //valuenya tambah pegawai baru

     $('#tambah-modal-staff').modal('show'); //modal tampil

});

if ($("#form-tambah-staff").length > 0) {
     $("#form-tambah-staff").validate({
          submitHandler: function(form) {
               var actionType = $('#tombol-simpan-staff').val();
               $('#tombol-simpan-staff').html('Sending..');



               $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                         $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                         console.log(data);

                         if (data.status == 0) {
                              iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                   title: 'Cek kembali Pengisian Form',
                                   timeout: 10000,
                                   message: '{{ Session('
                                   error ')}}',
                                   position: 'topRight'
                              });


                              if (data.errors.nama) {
                                   $('#namaDosenCheckAdd').html(data.errors.nama[0]);
                              }
                              if (data.errors.password) {
                                   $('#passwordDosenCheckAdd').html(data.errors.password[
                                        0]);
                              }
                              if (data.errors.email) {
                                   $('#emailDosenCheckAdd').html(data.errors.email[0]);
                              }

                              $('#tombol-simpan').html('Simpan');

                         } else {
                              $('#form-tambah-staff').trigger("reset"); //form reset
                              $('#tombol-simpan-staff').html('Simpan');


                              $('#tambah-modal-staff').modal('hide'); //modal hide

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
$(document).on('click', '.edit-post-staff', function() {
   
     var id = $(this).data('id');
  
  
     // $('.editStaff').find('form')[0].reset();
     $.ajax(
          {
                                   url: "staff-admin/"+id+"/edit",
                                   type: 'get', // replaced from put
                                   dataType: "JSON",
                                   data: {
                                        "id": id // method and token not needed in data
                                   },
                                   success: function (response)
                                   {
                                      
                                        $('.editStaff').find('input[name="nama"]').val(response.staff.nama);
                                        $('.editStaff').find('input[name="email"]').val(response.staff.email);
                                        $('.editStaff').find('input[name="id"]').val(response.staff.id);
                                       
                                        $('.editStaff').modal('show');
                                        
                                   },
                                   error: function(xhr) {
                                        iziToast.error( {
                                                    title: 'Data gagal dihapus',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight',
                                                    timeout: 15000,
                                                });

                                   }
                                 
                         });
                       

});
// KLIK TOMBOL EDIT

// end tekan tombol edit

//proses edit
//  update data petinggi

    $('#update-staff-form').on('submit', function(e){
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
                               
                                if(data.errors.nama){
                                    $('#namaStaffCheckEdit').html(data.errors.nama[0]);
                                }
                                if(data.errors.password){
                                    $('#passwordStaffCheckEdit').html(data.errors.password[0]);
                                }
                                if(data.errors.email){
                                    $('#emailStaffCheckEdit').html(data.errors.email[0]);
                                }
                               
                              }else{
                                
                                $('#update-staff-form').trigger("reset"); //form reset
                                $('.editStaff').modal('hide'); //modal hide
                                location.reload(true);
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Perubahan Data Staff Berhasil',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                              });
                            }
                              
                        }
                    });
                });
    // END EDIT PEGAWAI
// END EDIT PEGAWAI
//  update data petinggi 
//end proses edit 



$(document).on('click','#deleteStaffBtn', function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
          var id = $(this).data('id');  
          console.log(id);
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
                                        $.ajax(
                              {
                                   url: "staff-admin/"+id,
                                   type: 'delete', // replaced from put
                                   dataType: "JSON",
                                   data: {
                                        "id": id // method and token not needed in data
                                   },
                                   success: function (response)
                                   {
                                        iziToast.success({title: 'Data berhasil dihapus!',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    timeout: 15000,
                                                    position: 'topRight'});
                                                    location.reload(true);
                                   },
                                   error: function(xhr) {
                                        iziToast.error( {
                                                    title: 'Data gagal dihapus',
                                                    message: '{{ Session('
                                                    error ')}}',
                                                    position: 'topRight',
                                                    timeout: 15000,
                                                });

                                   }
                         });
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
     $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end
          .format('YYYY-MM-DD'))

     //INISIASI DATERANGEPICKER
     $('#page_admin_date_dosen').daterangepicker({
          startDate: start,
          endDate: end
     }, function(first, last) {
          //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
          $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + first.format(
               'YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
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
     $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end
          .format('YYYY-MM-DD'))

     //INISIASI DATERANGEPICKER
     $('#created_at_dosen').daterangepicker({
          startDate: start,
          endDate: end
     }, function(first, last) {
          //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
          $('#exportpdfdosen').attr('href', '/admin/dosen-report/pdf/' + first.format(
               'YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
     })
})
</script>