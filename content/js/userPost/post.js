(function() {
  $(document).on('click', '.text_cont', function() {
  
    if(!$(this)[0].classList.contains("expand_text")){
      $(this).closest(".post_cont").toggleClass('expand_cont');
      $(this).toggleClass('expand_text');
      $(this).css("border","none");
      $(this).css("cursor","auto");
    }
  });

  $(document).on('click', '.loginPopupContainer', function() {

    $(this).css("visibility","hidden");
  });


  $(document).on('click', '.deletePopupContainer', function() {

    $(this).css("visibility","hidden");
  });

  $( ".createdDate" ).hover(function() {
    var date = $(this).attr('date');
    $(this).append(' <div class="box">   '  +date+'   </div>');
   
  },
  function() {
  $(".box" ).remove();  
    
});    

$( ".releaseDate" ).hover(function() {
  var date = $(this).attr('date');
  $(this).append(' <div class="box">   '  +date+'   </div>');
 
},
function() {
$(".box" ).remove();  
  
});  



}());


  



    




