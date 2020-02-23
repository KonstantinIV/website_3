
 var voteModule = { 


    init : function(){
     //comment
    $(document).on('click', '#clikeButton', function(){
        voteModule.vote(
            $(this),
            $(this).closest("div[comment-id]").attr('comment-id'),
            "div[comment-id]",
            "likes",
            "comment",
            "like",
            "green",
            ".comment_likes")});

    $(document).on('click', '#cdislikeButton',function(){
        voteModule.vote(
            $(this),
            $(this).closest("div[comment-id]").attr('comment-id'),
            "div[comment-id]",
            "dislikes",
            "comment",
            "dislike",
            "red",
            ".comment_dislikes")});



     //post   
    $(document).on('click', '#likeButton', function(){
        voteModule.vote(
            $(this),
            $(this).closest("div[data-id]").attr('data-id'),
            "div[data-id]",
            "likes",
            "post",
            "like",
            "green",
            ".likes" )});
        
    $(document).on('click', '#dislikeButton', function(){
        voteModule.vote(
            $(this),
            $(this).closest("div[data-id]").attr('data-id'),
            "div[data-id]",
            "dislikes",
            "post",
            "dislike",
            "red",
            ".dislikes" )});


    },
 
    
  
  vote : function(button,ID,attribute,voteType,postType,action,color,cssClass){

      var filled = this.checkVote(button);
      var data   = this.sendvote(ID,voteType,postType,filled);
      console.log(JSON.parse(data));
      this.updateVisualVote(JSON.parse(data),filled,button,action,color,attribute,cssClass) ;
    
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
      method: (filled) ?   "POST" :"DELETE" ,
      data:{ ID : ID , action : voteType, type : postType, update : filled},
      async:false,
  }).responseText;
  
},

  updateVisualVote:function(flag,updateType,button,prefix,imageName,attribute,cssClass){

                    if(flag){
                      if(updateType){
                        this.setImage(button,prefix,"content/img/"+imageName+"Full.svg",true,1,attribute,cssClass);
                    
                      }else{
                        this.setImage(button,prefix,"content/img/"+imageName+"Empty.svg",false,-1,attribute,cssClass);

                      }
                    }else{
                        console.log("asdsad");
                        $("#loginPopupCont").css("visibility", "visible");
                      }
  },

  setImage: function(button,prefix,imageName,isSet,score,attribute,cssClass){

    if(isSet){
      button.toggleClass("full");
    }else{
      button.removeClass("full");
    }
    button.find("."+prefix+"Image").attr("src",imageName);
    var ss      = +button.closest(attribute).find(cssClass).text();
    button.closest(attribute).find(cssClass).text(ss + score);

  }


};
voteModule.init();