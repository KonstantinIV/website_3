
(function() {
  $(document).ready(function() {
    generateSinglePost();

  });

  function generateSinglePost(){
    var url = window.location.href.split('/');
    //console.log(url.slice(4));
     $.ajax({
       async : false ,
       url: "singlePost",
       method: "POST",
       data:{ cat : url[4], sort : url[5], search: url[6], method: true,url : url.slice(3)},
       success: function(data){
         $('.pop_post_cont').append(JSON.parse(data).content);
        // $('.pop_post_cont').append("ssssssssssssssssssss");
  
         console.log(JSON.parse(data));
         //wconsole.log(JSON.parse(data));
       }
     });
   }

}());
//var commentPost = 0;









      


        



