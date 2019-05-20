

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
        var large = `
        <div class="commentReplyContainer">
            <div class="replyText">

            </div>
            </div class="commentReplyButton">

            </div>
        </div>
        `;
        
        console.log(large);
     
        
        
        });