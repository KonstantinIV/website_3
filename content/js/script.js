


  $(document).on('click', '#add', function() {
    //$(".row").toggleClass('hoops');

    var year  = $("#year").val();
    var month = $("#month").val();
    var day = $("#day").val();
    var datet = year+month+day;
    console.log(datet);

    if (ch_post()){
      $.ajax({
        url: "../php/post_pd.php",
        method: "POST",
        data:{title: $("#title").val() ,date: datet,text: $("#text").val()},
        success: function(data){
          console.log(data);
        }
      });
    }
    
});

// Check
function ch_post(){

  var title = $("#title").val();
  var text  = $("#text").val();

  var year  = $("#year").val();
  var month = $("#month").val();
  var day = $("#day").val();
  if(title == null || title == "" , text == null || text == ""){
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
                  //window.location.replace("user.php");
                  window.location.href = '../profile';
                    //window.location.assign('user.php');
                }
            });
   
        });

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
               url: "../indexPage",
               method: "POST",
               data:{grab : last_grabbed, cat : url[4], sort : url[5]},
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
      /*
      $('#flux').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            alert('end reached');
        }






$.ajax({
              url: "nextPagePlease",
              method: "POST",
              data:{grab : last_grabbed},
              success: function(data){

                $('.main_cont').append(data);
                console.log(data);
                last_grabbed += 10;
              }
            });





    })*/
