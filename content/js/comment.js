

    $(document).on('click', '#clikeButton', function(){
        cvote($(this),"likes","comment","like", "green" );
        
        
        });
        
      $(document).on('click', '#cdislikeButton', function(){
        cvote($(this),"dislikes","comment","dislike", "red" );
        
    
        });
    
    
        
    
    
    
        function cvote(thisButton,action,type,prefix,imageName){
          var ID  = thisButton.closest("div[comment-id]").attr('comment-id');
          
    
          
    
          var updateType;
          if(!thisButton[0].classList.contains("full")){
            updateType = true;  
          }else{
            updateType = false;
          }
    
          var url = window.location.href.split('/');
              $.ajax({
                  url: "vote",
                  method: "POST",
                  data:{ ID : ID , action : action, type : type, update : updateType},
                  async:false,
                  success: function(data){
                   
                    console.log(data);
                    flag = JSON.parse(data).message;
                    if(flag){
                      
                      if(updateType){
    
                        thisButton.toggleClass("full");
                        thisButton.find("."+prefix+"Image").attr("src","content/img/"+imageName+"Full.svg");
                        var ss      = +thisButton.closest("div[comment-id]").find(".comment_"+prefix+"s").text();
                        thisButton.closest("div[comment-id]").find(".comment_"+prefix+"s").text(ss + 1);
                      }else{
                        thisButton.removeClass("full");
                        thisButton.find("."+prefix+"Image").attr("src","content/img/"+imageName+"Empty.svg");
                        var ss      = +thisButton.closest("div[comment-id]").find(".comment_"+prefix+"s").text();
                        thisButton.closest("div[comment-id]").find(".comment_"+prefix+"s").text(ss - 1);
                      }
    
                  
                    }else{
                        $(".loginPopupContainer").css("visibility", "visible");
                      }
                  }
              });
    
    
    
    
    }


    $(document).on('click', '#replyComment', function(){
        var thisButton = $(this);

        $.ajax({
          url: "islogged",
          method: "GET",
          async:false,
          success: function(data){
            var flag = Boolean(JSON.parse(data).flag);
        console.log(data);
            if(flag == false){
                $(".loginPopupContainer").css("visibility", "visible");
            }else{
              if(thisButton.hasClass("replyDrop")){
                thisButton.removeClass("replyDrop");
                thisButton.closest(".comment").find(".commentReplyContainer").remove();
              }else{
        
                thisButton.toggleClass("replyDrop");
                var replyTextarea = `
                <div class="commentReplyContainer">
                    <div class="replyText">
                        <textarea class="replyTextarea"> </textarea>
                    </div>
                    <div class="commentReplyButton">
                          Reply
                    </div>
                </div>
                `;
                thisButton.closest(".comment").append(replyTextarea);
                
                
                
              }
            }
        }})  ;

      
      
       // $(this).closest(".comment").append(large);
        });









        $(document).on('click', '.commentReplyButton', function(){

          var parentComment = $(this).closest("div[comment-id]");
          

          var marginComment = parseInt(parentComment.css('margin-left'), 10)  + 20;
          var backColor     ;
          if(parentComment.css('background-color') == "rgb(34, 20, 60)"){
            backColor = "#36274b";
          }else{
            backColor = "#22143c";
          }
         


          var ID = parentComment.attr('comment-id');
          var text = $(this).closest(".commentReplyContainer").find(".replyTextarea").val();

         // console.log(ID + text + parentComment.css('background-color'));
          
          $.ajax({
            url: "commentReply",
            method: "POST",
            data:{ ID : ID, text : text},
            async:false,
            success: function(data){
              //username = JSON.parse(data).username;


              var commentHtml =`
              <div class="comment" comment-id = "`+ID+`" style="margin-left: `+marginComment+`; background-color:`+backColor+`;">
              <div class="comment_user"><div class="user">`+ID+`</div>&#9679<div class="comment_date">5 hours ago</div></div>
              <div class="comment_text">`+text+`</div>
                      <div class="comment_buttons">
                       <div class="comment_like_button " id="clikeButton"><img class="likeImage" src="content/img/greenEmpty.svg"></div>  
                              <div class="comment_di_li_cont">
                                      <div class="comment_likes">0</div>
                                      <div class="">&#9679</div>
                                      <div class="comment_dislikes">0</div>
                              </div>        
                      <div class="comment_dislike_button" id="cdislikeButton"><img class="dislikeImage" src="content/img/redEmpty.svg"></div> 
                        <div class="comment_comment_button" id="replyComment">REPLY &#10095;</div>
                      </div>
  </div>
              `;
              if(true){

              }else{

              }
              console.log( parentComment.length);
              if( parentComment.length === 1){
              //  console.log(asdsadsad);
                parentComment.after('<br>');
                parentComment.after(commentHtml);
                parentComment.find(".commentReplyContainer").remove();
              }else{
                //console.log('asdsadsad');
                $('.comment_section').prepend(commentHtml);
              }
              
              //console.log(data);
            
            }
          
          })  });



          
        $(document).on('click', '#replyComment', function(){
        
         
        });



