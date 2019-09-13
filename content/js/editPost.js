

// Check
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
  
  }
  
  
  
  
  
  
  
  
  
  
  
        $(document).on('click', '#editPost', function(){
    
          //Check if empty
          var postTitle  = $('#title').val();
          var postYear  = $('#year').val();
          var postMonth     = $('#month').val();
          var postDay = $('#day').val();
          var postText  = $('#text').val();
          var postCat  = $('#category').val();
  
  
         
  
          if(!ch_post(postTitle,postYear,postMonth,postDay,postText)){
            $("#editError").text("Somethign went wrong");
            return false;
          }
  
          //console.log("Wrong input");
          var url = window.location.href.split('/');
          console.log(url);
              $.ajax({
                  url: "editutility",
                  method: "POST",
                  data:{title: postTitle , year: postYear ,month : postMonth, day : postDay, text:postText,category:postCat, ID : url[4]},
                  success: function(data){
                    console.log("hg");
                    console.log(data);
                    if(JSON.parse(data).flag == false){
                      $("#editError").text(JSON.parse(data).message);
                      return false;
                    }
                    //window.location.replace("user.php");
                   // window.location.href = '../profile';
                      //window.location.assign('user.php');
                  }
              });
     
          });
  /////////////////
  
  
  
  
  
  
  
  