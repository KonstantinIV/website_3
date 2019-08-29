

// Check
function ch_post(postTitle,postYear,postMonth,postDay,postText){

  var title = postTitle;
  var text  = postText;
  var year  = postYear;
  var month = postMonth;
  var day = postDay;



  if(title == null || title == "" || text == null || text == ""){
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
                data:{title: postTitle , year: postYear ,month : postMonth, day : postDay, text:postText, ID : url[4]},
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










      var last_grabbed = 10;
      var flag         = false;
      $(window).scroll(function() {
        
        if ($(window).scrollTop() + $(window).height() > $('#mn_cont').height()-1){
          console.log("ssssssssssssssssssss");
          if(!flag){
            var url = window.location.href.split('/');
            //console.log(url);
             $.ajax({
               async : false ,
               url: window.location.href,
               method: "POST",
               data:{grab : last_grabbed, cat : url[4], sort : url[5], search: url[6], method: true},
               success: function(data){
                 $('.pop_post_cont').append(JSON.parse(data).content);

                 console.log(JSON.parse(data));
                 //wconsole.log(JSON.parse(data));
                flag = JSON.parse(data).flag;
                 last_grabbed = last_grabbed + 10;
               }
             });
          }
           // alert("bottom!");
           
        }
     });
   