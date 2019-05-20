$(document).on('click', '.text_cont', function() {
  
    if(!$(this)[0].classList.contains("expand_text")){
      $(this).closest(".post_cont").toggleClass('expand_cont');
      $(this).toggleClass('expand_text');
      $(this).css("border","none");
      $(this).css("cursor","auto");
    }
  
  
  });


$(document).on('click', '.loginPopupContainer', function() {
  
      $(this).css("visibility","hidden");
    
  
  
  });


  
function vote(thisButton,action,type,prefix,imageName){
    var ID  = thisButton.closest("div[data-id]").attr('data-id');
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
                  var ss      = +thisButton.closest("div[data-id]").find("."+prefix+"s").text();
                  thisButton.closest("div[data-id]").find("."+prefix+"s").text(ss + 1);
                  
                }else{
                  thisButton.removeClass("full");
                  thisButton.find("."+prefix+"Image").attr("src","content/img/"+imageName+"Empty.svg");
                  var ss      = +thisButton.closest("div[data-id]").find("."+prefix+"s").text();
                  thisButton.closest("div[data-id]").find("."+prefix+"s").text(ss - 1);
                }

            
              }else{
                $(".loginPopupContainer").css("visibility", "visible");
              }
            }
        });




}



  $(document).on('click', '#likeButton', function(){
    vote($(this),"likes","post","like", "green" );
    
    });


    

  $(document).on('click', '#dislikeButton', function(){
    vote($(this),"dislikes","post","dislike", "red" );
    
    });



    




