


//document.cookie = "date"+"=" + new Date();








var a = 0;
if(a != 0){
  location.reload();
}











Date.prototype.stdTimezoneOffset = function () {
  var jan = new Date(this.getFullYear(), 0, 1);
  var jul = new Date(this.getFullYear(), 6, 1);
  return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
}

Date.prototype.isDstObserved = function () {
  return this.getTimezoneOffset() < this.stdTimezoneOffset();
}





$(document).ready(function() {
  console.log(document.title)
  var offset = new Date().getTimezoneOffset()/60 * -1;
  document.cookie = "timezoneOffset"+"=" + offset;


  var today = new Date();

  if (today.isDstObserved()) { 
    document.cookie = "timezoneDst"+"=" + 1;
  }else{
    document.cookie = "timezoneDst"+"=" + 0;

  }



  generatePost();



  
  

});






      var last_grabbed = 1;
      var flag         = false;
      $(window).scroll(function() {
        
        if ($(window).scrollTop() + $(window).height() > $('#mn_cont').height()-1){
          console.log("ssssssssssssssssssss");
          if(!flag){
           generatePost();
          }
           // alert("bottom!");
           
        }
     });


     function generatePost(){
      var url = window.location.href.split('/');
      //console.log(url);
       $.ajax({
         async : false ,
         url: "indexPage",
         method: "POST",
         data:{grab : last_grabbed, cat : url[4], sort : url[5], search: url[6], method: true,url : url.slice(3)},
         success: function(data){
           $('.pop_post_cont').append(JSON.parse(data).content);
          //$('.pop_post_cont').append("ssssssssssssssssssss");

           console.log(JSON.parse(data));
           console.log();
          flag = JSON.parse(data).flag;
           last_grabbed = last_grabbed + 10;
         }
       });
     }
   