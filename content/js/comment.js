
$(document).ready(function() {
  
  

  //generateSinglePost();



  
  

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
                        $("#loginPopupCont").css("visibility", "visible");
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
                $("#loginPopupCont").css("visibility", "visible");
            }else{
              if(thisButton.hasClass("replyDrop")){
                thisButton.removeClass("replyDrop");
                thisButton.closest(".comment").find(".commentReplyContainer").remove();
              }else{
        
                thisButton.toggleClass("replyDrop");
                var replyTextarea =`
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
          var backColor     ;
          if(parentComment.css('background-color') == "rgb(34, 20, 60)"){
            backColor = "#36274b";
          }else{
            backColor = "#22143c";
          }
         

          var postID        = $(".post_cont").attr('data-id');
          var ID            = parentComment.attr('comment-id');
          var marginComment = parseInt(parentComment.css('margin-left'), 10)  + 20;
          var text = $(this).closest(".commentReplyContainer").find(".replyTextarea").val();

   
          $.ajax({
            url: "commentutility",
            method: "POST",
            data:{ postID: postID, ID : ID, text : text},
            async:false,
            success: function(data){
              username = JSON.parse(data).username;
              commentID = JSON.parse(data).commentID;

              var commentHtml =`
              <div class="comment" comment-id = "`+commentID+`" style="margin-left: `+marginComment+`px; background-color:`+backColor+`;">
              <div class="comment_user"><div class="user">`+username+`</div>&#9679<div class="comment_date">5 hours ago</div></div>
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
            
              console.log( parentComment.length);
      
                parentComment.after('<br>');
                parentComment.after(commentHtml);
                parentComment.find(".commentReplyContainer").remove();
            
              
              console.log(data);
            
            }
          
          })  });





        $(document).on('click', '#postReplyButton', function(){

          var ID = 0;
          var marginComment = 0;
          var postID        = $(".post_cont").attr('data-id');
          var text = $(this).closest(".commentReplyContainer").find(".replyTextarea").val();
          var backColor = "#22143c";
          var parentComment = $(this).closest("div[comment-id]");

          $.ajax({
            url: "commentutility",
            method: "POST",
            data:{ postID: postID, ID : ID, text : text},
            async:false,
            success: function(data){
              username = JSON.parse(data).username;
              commentID = JSON.parse(data).commentID;


              var commentHtml =`
              <div class="comment" comment-id = "`+commentID+`" style="margin-left: `+marginComment+`; background-color:`+backColor+`;">
              <div class="comment_user"><div class="user">`+username+`</div>&#9679<div class="comment_date">5 hours ago</div></div>
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
  <br>
              `;
              
             
               // console.log('asdsadsad');
               
                $('.comment_section').prepend(commentHtml);
               // $('.comment_section').after('<br>');
               // parentComment.after('<br>');
              
              
              console.log(data);
            
            }
          
          })  });



        



