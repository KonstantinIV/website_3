$(document).on('click', '.nav_button', function() {
    //$(".row").toggleClass('hoops');
    $(".row").toggleClass('row_appear');
  });

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


$(document).on('click', '.expand_post', function() {
  //$(".row").toggleClass('hoops');

  $(".post_text").toggleClass('expand_text');
  $(".post_cont").toggleClass('expand_cont');

});



$(document).on('click', '#log', function(){

  
  var username = $('#username').val();
  var password = $('#password').val();
  
  if(username == "" || password == "" ){
      console.log("Wrong input");
  }else {
    var data = {};
    data['username'] = username;
    data['password'] = password;  
          $.ajax({
          url: "loginU",
          method: "POST",
          data:{dict : data},
          success: function(data){
            console.log(data);
            //window.location.replace("user.php");
            window.location.href = 'profile';
              //window.location.assign('user.php');
          }
      });
  } 
  
  });
  
  $(document).on('click', '#reg', function(){
  
      //Check if empty
      var username  = $('#username').val();
      var password  = $('#password').val();
      var email     = $('#email').val();
      var join_date = $('#join_date').val();
      var birthday  = $('#birthday').val();
      //console.log("Wrong input");
      
      if(username == "" || password == "" ){
          console.log("Wrong input");
      }else {
          $.ajax({
              url: "register_util.php",
              method: "POST",
              data:{user: username ,pass: password,email : email, join_date : join_date, birthday:birthday},
              success: function(data){
               
                //window.location.replace("user.php");
                window.location.href = '/php/profile.php';
                  //window.location.assign('user.php');
              }
          });
      } 
      
      
      
      
      });

      var last_grabbed = 10;
      $(window).scroll(function() {
        
        if ($(window).scrollTop() + $(window).height() > $('#mn_cont').height()-1){
           // alert("bottom!");
           var url = window.location.href.split('/');
           console.log(url);
            $.ajax({
              url: "nextPagePlease",
              method: "POST",
              data:{grab : last_grabbed, cat : url[3]},
              success: function(data){

                $('.pop_post_cont').append(data);
                console.log("hg");
                last_grabbed = last_grabbed + 10;
              }
            });
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