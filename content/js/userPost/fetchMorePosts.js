

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
    attachHoverStarVote()

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

function attachHoverStarVote(){
  $( ".starVoteWallImage" ).hover(
    function() {
      $( this ).append( ' <div class="starVoteTextBox">Locked until realease date</div>' );
    }, function() {
      $( this ).find( ".starVoteTextBox" ).last().remove();

    }
  );

  $( ".starVote" ).hover(
    function() {
        for (var i = 0; i <= $( this ).index(); i++) {
          $(this).closest('.starVoteBar').children('.starVote').eq(i).addClass("starVoteGreenHover");
           // $( ".starVote" ).eq(i).addClass("starVoteGreen");
          }
        switch($( this ).index()) {
            case 0:
                $( this ).append( ' <div class="starVoteTextBox">Most of it was wrong</div>' );
              break;
            case 1:
                $( this ).append( ' <div class="starVoteTextBox">Some  of it was true</div>' );                   
                 break;
              case 2:
                $( this ).append( ' <div class="starVoteTextBox">Half of it was true</div>' );                    
                break;
              case 3:
                $( this ).append( ' <div class="starVoteTextBox">More than half of it was true</div>' );
                break;
                case 4:
                    $( this ).append( ' <div class="starVoteTextBox">Most of it was true</div>' );                        
                    break;
         
          }
    }, function() {
        for (var i = 0; i <= $( this ).index(); i++) {
          $(this).closest('.starVoteBar').children('.starVote').eq(i).removeClass("starVoteGreenHover");

          }

      $( this ).find( ".starVoteTextBox" ).last().remove();
    }
  );
}
  }());




