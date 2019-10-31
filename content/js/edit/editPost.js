
(function() {
  function validatePostTitle(postTitle){
    if(postTitle == null || postTitle == "" ){
      return false;
    }
      return true;
  }

  function validatePostText(postText){
    if(postText == null || postText == ""){
      return false;
    }
      return true;
  }

  function validateDate(year,month,day){
    
    if(year == null || year == "" ){
      return false;
    }else if(year == null || year == "" || month == null || month == "" && day == null || day == ""){
      return false;
    }else if(year == null || year == "" && month == null || month == ""){
      
      return false;
    }
      return true;
  }

  function validateCategory(category){

    if( category == 0){
      return false;
    }
   

    return true;
  }


  function sendPost(postTitle,postYear,postMonth,postDay,postText,postCat,postID){
   return $.ajax({
      url: "editutility",
      method: "POST",
      async:false,
      data:{title: postTitle , year: postYear ,month : postMonth, day : postDay, text:postText,category:postCat, postID : postID}
      
  }).responseText;
  }

  /*
  function ch_post(postTitle,postYear,postMonth,postDay,postText, postCat){

    var title = postTitle;
    var text  = postText;
    var year  = postYear;
    var month = postMonth;
    var day = postDay;
    var cat = postCat;
  
    if(title == null || title == "" || text == null || text == "" || cat == 0){
      return false;
    }else if(year == null || year == "" ){
      return false;
    }else if(year == null || year == "" || month == null || month == "" && day == null || day == ""){
      return false;
    }else if(year == null || year == "" && month == null || month == ""){
      return false;
    }else{
      return true;
    }
  
  }*/
  
  

  
        $(document).on('click', '#editPost', function(){
    
          //Check if empty
          var postTitle  = $('#title').val();
          var postYear  = $('#year').val();
          var postMonth     = $('#month').val();
          var postDay = $('#day').val();
          var postText  = $('#text').val();
          var postCat  = $('#category').val();
          var postID = window.location.href.split('/')[4];


          if(!validatePostText(postText)){
            $("#editError").text("Invalid characters in text");

            return false;

          }else if(!validateCategory(postCat)){
            $("#editError").text("Invalid category");

            return false;

          }else if( !validateDate(postYear,postMonth,postDay)){
            $("#editError").text("Invalid date");

            return false;

          }else if( !validatePostTitle(postTitle) ){
            $("#editError").text("Invalid title");

            return false;
          }

          var data = sendPost(postTitle,postYear,postMonth,postDay,postText,postCat,postID);
          console.log(data);

          if(JSON.parse(data).flag == false){
            $("#editError").text(JSON.parse(data).message);
            return false;
          }
         
  
          /*if(!ch_post(postTitle,postYear,postMonth,postDay,postText)){
            $("#editError").text("Somethign went wrong");
            return false;
          }*/
  
     
          });
}());


  /////////////////
  
  
  
  
  
  
  
  