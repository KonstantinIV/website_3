
(function() {
    $(document).on('click', '.commentReplyButton', function(){
  
      var parentComment = $(this).closest("div[comment-id]");
      var backColor = getBackColor(parentComment);
     
      var postID        = $(".post_cont").attr('data-id');
      var ID            = parentComment.attr('comment-id');
      var marginComment = parseInt(parentComment.css('margin-left'), 10)  + 20;
      var text =          $(this).closest(".commentReplyContainer").find(".replyTextarea").val();
  
      var commentDataArr   = sendCommentReply(postID,ID,text);
      var username         = JSON.parse(commentDataArr).username; 
      var commentID        = JSON.parse(commentDataArr).commentID;

      var commentHtml =  addCommenView(commentID,marginComment,backColor,username,text);

      parentComment.after('<br>');
      parentComment.after(commentHtml);
      parentComment.find(".commentReplyContainer").remove();
       });


    $(document).on('click', '#postReplyButton', function(){

        var backColor = "#22143c";

        var postID        = $(".post_cont").attr('data-id');
        var ID = 0;
        var marginComment = 0;
        var text = $(this).closest(".commentReplyContainer").find(".replyTextarea").val();

        var commentDataArr   = sendCommentReply(postID,ID,text);
        var username         = JSON.parse(commentDataArr).username; 
        var commentID        = JSON.parse(commentDataArr).commentID;
        
        var commentHtml = addCommenView(commentID,marginComment,backColor,username,text);
        $('.comment_section').prepend(commentHtml);

        });




  
    function getBackColor(parentComment){
      
      if(parentComment.css('background-color') == "rgb(34, 20, 60)"){
        return "#36274b";
      }else{
        return "#22143c";
      }
    }
  
    function sendCommentReply(postID,ID,text){
      return $.ajax({
        url: "commentutility",
        method: "POST",
        data:{ postID: postID, ID : ID, text : text},
        async:false
      }).responseText;
    }
  
    function addCommenView(commentID,marginComment,backColor,username,text){
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
        return commentHtml;
         // console.log( parentComment.length);
            
        
    }
  
  
  }());
  


  
(function() {
  
    $(document).on('click', '#replyComment', function(){
      if(JSON.parse(isLoggedIn()).flag ){
        showMessage();
      }else{
        showTextbox($(this));
      }
      });
  
  function isLoggedIn(){
   return $.ajax({
      url: "islogged",
      method: "GET",
      async:false}).responseText  ;
  }
  
  
  function showMessage(){
        
            $("#loginPopupCont").css("visibility", "visible");
       
  }
  
  function showTextbox(thisButton){
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
  
  
  }());
     


  