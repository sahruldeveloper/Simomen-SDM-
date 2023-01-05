// start left sidebar js
     $(document).on('click', '#sidebar li', function(){
          $(this).addClass('active').siblings().removeClass('active')      
     });
// end left sidebar js

// start left menu sidebar dp toggle
     $('.sub-menu ul').hide();
     $('.sub-menu ul').click(function() {
          $(this).parrent(".sub-menu").children("ul").slideToggle("100");
          $(this).find('.right').toggleClass("fa-caret-up fa-caret-down");
     });
// end  left menu sidebar dp toggle

// sidebar toggle
     $(document).ready(function() {
          $("#toogleSidebar").click(function() {
               $(".left-menu").toggleClass("hide");
               $(".content-wrapper").toggleClass("hide");
          });
     });
// end sidebar toggle

// data table
$(document).ready( function () {
     $('#example').DataTable();
 } );
// end data table
