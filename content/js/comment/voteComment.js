
 /*var voteModule = { 


    init : function(){
     
      $(document).on('click', '#clikeButton', function(){
        voteModule.cvote($(this),"likes","comment","like", "green")});

      $(document).on('click', '#cdislikeButton',function(){
        voteModule.cvote($(this),"dislikes","comment","dislike", "red")});
    },
 
    
  
  cvote : function(button,voteType,postType,action,color){
      var filled = this.checkVote(button);
      var ID     = button.closest("div[comment-id]").attr('comment-id');
      var data   = this.sendvote(ID,voteType,postType,filled);
      this.updateVisualVote(JSON.parse(data).message,filled,button,action,color) ;
    
  },

  checkVote: function(button){
    if(!button[0].classList.contains("full")){
      return true; 
    }else{
      return false;
    }     

  },

  sendvote:function(ID,voteType,postType,filled){
   return  $.ajax({
      url: "vote",
      method: "POST",
      data:{ ID : ID , action : voteType, type : postType, update : filled},
      async:false,
  }).responseText;
  
},

  updateVisualVote:function(flag,updateType,button,prefix,imageName){
                    if(flag){
                      if(updateType){
                        this.setImage(button,prefix,"content/img/"+imageName+"Full.svg",true,1);
                    
                      }else{
                        this.setImage(button,prefix,"content/img/"+imageName+"Empty.svg",false,-1);

                      }
                    }else{
                        $("#loginPopupCont").css("visibility", "visible");
                      }
  },

  setImage: function(button,prefix,imageName,isSet,score){
    if(isSet){
      button.toggleClass("full");
    }else{
      button.removeClass("full");
    }
    button.find("."+prefix+"Image").attr("src",imageName);
    var ss      = +button.closest("div[comment-id]").find(".comment_"+prefix+"s").text();
    button.closest("div[comment-id]").find(".comment_"+prefix+"s").text(ss + score);

  }


};
voteModule.init();*/