
(function() {
  if(document.title == 'Comments') {
    generateSinglePost();
}
  function generateSinglePost(){
    var url = window.location.href.split('/');
    //console.log(url.slice(4));

     $.ajax({
       async : false ,
       url: "indexPage",
       method: "GET",
       data:{  ID:url[4], method: true,urlArr : url.slice(3)},
       success: function(data){
         $('.pop_post_cont').append(JSON.parse(data).content);
        // $('.pop_post_cont').append("ssssssssssssssssssss");
  
         console.log(JSON.parse(data));
         //wconsole.log(JSON.parse(data));
       }
     });
   }

   $( ".comment_date" ).hover(function() {
    var date = $(this).attr('date');
    $(this).append(' <div class="box">   '  +date+'   </div>');
   
  },
  function() {
  $(".box" ).remove();  
    
  });



}());
//var commentPost = 0;









      


        



