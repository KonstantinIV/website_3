

var offset = new Date().getTimezoneOffset()/60 * -1;
console.log(offset);


var today = new Date();

Date.prototype.stdTimezoneOffset = function() {
    var jan = new Date(this.getFullYear(), 0, 1);
    var jul = new Date(this.getFullYear(), 6, 1);
    return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
}

Date.prototype.dst = function() {
    return this.getTimezoneOffset() < this.stdTimezoneOffset();
}



if (today.dst()) {
  console.log(offset + 1);

}
console.log(offset);

//document.cookie = "date"+"=" + new Date();







var a = 0;
if(a != 0){
  location.reload();
}














$(document).ready(function() {
  var offset = new Date().getTimezoneOffset()/60 * -1;
  document.cookie = "timezoneOffset"+"=" + offset;
  

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
         url: window.location.href,
         method: "POST",
         data:{grab : last_grabbed, cat : url[4], sort : url[5], search: url[6], method: true},
         success: function(data){
           $('.pop_post_cont').append(JSON.parse(data).content);
          // $('.pop_post_cont').append("ssssssssssssssssssss");

           console.log(JSON.parse(data));
           //wconsole.log(JSON.parse(data));
          flag = JSON.parse(data).flag;
           last_grabbed = last_grabbed + 10;
         }
       });
     }
   