

(function() {
  
    var last_grabbed =0;
    var flag         = false;
    var endOfContent = false;
    $(window).scroll(function() {
      
      if ($(window).scrollTop() + $(window).height() > $('#mn_cont').height()-1){
        if(!flag){
         generatePost();
        }
       
        
       
         // alert("bottom!");
         
      }
   });
   
   
   function generatePost(){
    

    var url = window.location.href.split('/');
    var category = false;
    var sortType = false;
    var searchText = false;
    var data ;

    if(url[4] == "search"){

      if(""){

      }else{

      }
      data = getPost(last_grabbed,url[3],"",url[5],url);
    }else if(url[5] == "search"){
      data = getPost(last_grabbed,url[3],url[4],url[6],url);
    }else{
      data = getPost(last_grabbed,url[3],url[4],url[5],url);

    }

    addPost(JSON.parse(data).content );

    flag = JSON.parse(data).flag;
    last_grabbed = last_grabbed + 10;
    console.log(url);

    if(endOfContent== false && flag == true){
      addPost(`
        <div class="post_cont">
          <div class="finalResult">
            No more resuslts
          </div>
        </div>`);
        
      endOfContent = true;
    }
    attachHoverDate();


   }
  
   
   function getPost(lastFetch,sortType,category,searchText,url){
    return $.ajax({
      async : false ,
      url: "indexPage",
      method: "GET",
     
      data:{grab : lastFetch, cat : category, sort : sortType, search: searchText, method: true,urlArr : url.slice(3)}
    }).responseText;
   }

   function addPost(content){
    
    $('.pop_post_cont').append(content);
   }

   if(document.title == 'Main') {

    
    generatePost();
    
}

function attachHoverDate(){
$( ".createdDate" ).hover(function() {
  var date = $(this).attr('date');
  $(this).append(' <div class="box">   '  +new Date(date)+'   </div>');
 
},
function() {
$(".box" ).remove();  
  
});    

$( ".releaseDate" ).hover(function() {
var date = $(this).attr('date');
$(this).append(' <div class="box">   '  +new Date(date)+'   </div>');

},
function() {
$(".box" ).remove();  

}); 
}
  }());




