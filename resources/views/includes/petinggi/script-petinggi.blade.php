<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
            //   getDataPegawaiPagePetinggi(page);
              getDataDosenPagePetinggi(page);
           
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '#page_pegawai_petinggi_links a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getDataPegawaiPagePetinggi(page);
        
           
        });
  
    });

    $(document).ready(function()
    {
        $(document).on('click', '#page_dosen_petinggi_links a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getDataDosenPagePetinggi(page);
        
           
        });
  
    });

    
  
    function getDataPegawaiPagePetinggi(page){
        $.ajax(
        {
            url: 'halaman-petinggi/data-pegawai?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#page_data_pegawai_petinggi").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }

    function getDataDosenPagePetinggi(page){
        $.ajax(
        {
            url: 'halaman-petinggi/data-dosen?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#page_data_dosen_petinggi").empty().html(data);
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
      read_data_dosen_section_petinggi()

      $('#search_dosen_section_petinggi').keyup(function() {
        var strcari = $('#search_dosen_section_petinggi').val();
        if(strcari != "") {
            $.ajax({
                type:"get",
                url: "{{ url('petinggi/halaman-petinggi/data-dosen') }}",
                data: "search=" + strcari,
                success: function(data) {
                    $("#page_data_dosen_petinggi").html(data);
                }
            });
        }else {
            read_data_dosen_section_petinggi()
        }
      });
    });

    $(document).ready(function (){
      read_data_pegawai_section_petinggi()

      $('#search_pegawai_section_petinggi').keyup(function() {
        var strcari = $('#search_pegawai_section_petinggi').val();
        if(strcari != "") {
            $.ajax({
                type:"get",
                url: "{{ url('petinggi/halaman-petinggi/data-pegawai') }}",
                data: "search=" + strcari,
                success: function(data) {
                    $("#page_data_pegawai_petinggi").html(data);
                }
            });
        }else {
            read_data_pegawai_section_petinggi()
        }
      });
    });

    function read_data_dosen_section_petinggi() {
        $.get("{{ url('petinggi/halaman-petinggi/data-dosen') }}", {}, function(data, status){
            $("#page_data_dosen_petinggi").html(data);
        });
    }

    function read_data_pegawai_section_petinggi() {
        $.get("{{ url('petinggi/halaman-petinggi/data-pegawai') }}", {}, function(data, status){
            $("#page_data_pegawai_petinggi").html(data);
        });
    }



     //Filter Dosen
     let start = moment().startOf('years')
        let end = moment().endOf('years')


        //INISIASI DATERANGEPICKER
        $('#date_dosen').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
          $('#page_data_dosen_petinggi').attr('href', 'petinggi/halaman-dosen-petinggi' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
          
        }) 
     //Filter Dosen 
</script>





<script>
    //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
    $(document).ready(function() {
        let start = moment().startOf('years')
        let end = moment().endOf('years')

        //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
        $('#exportpdfdosenFromPetinggi').attr('href', '/admin/dosen-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //INISIASI DATERANGEPICKER
        $('#date_pegawai').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
            //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
            $('#exportpdfdosenFromPetinggi').attr('href', '/admin/dosen-report/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
</script>

