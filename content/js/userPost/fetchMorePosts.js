

(function() {
  
    var last_grabbed = 1;
    var flag         = false;
    $(window).scroll(function() {
      
      if ($(window).scrollTop() + $(window).height() > $('#mn_cont').height()-1){
        console.log("ssssssssssssssssssss");
        if(!flag){
         generatePost(last_grabbed);
        }
         // alert("bottom!");
         
      }
   });
   
  
   function generatePost(){
    var url = window.location.href.split('/');
    var data = getPost(last_grabbed,url[4],url[5],url[6],url);
    addPost(JSON.parse(data).content);
    flag = JSON.parse(data).flag;
    last_grabbed = last_grabbed + 10;

   }
  
   
   function getPost(lastFetch,category,sortType,searchText,url){
    return $.ajax({
      async : false ,
      url: "indexPage",
      method: "POST",
      data:{grab : lastFetch, cat : category, sort : sortType, search: searchText, method: true,url : url.slice(3)}
    }).responseText;
   }

   function addPost(content){
    $('.pop_post_cont').append(content);
   }
   generatePost();

  }());




