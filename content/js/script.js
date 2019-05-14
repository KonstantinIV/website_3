/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function userDropdown() {
  document.getElementById("userDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.userDropdownButton') && !event.target.matches('.userIcon')) {
    var dropdowns = document.getElementsByClassName("userDropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}




function navDropdown() {
  document.getElementById("navDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.navDropdownButton')) {
    var dropdowns = document.getElementsByClassName("dropdown-contentNav");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}



/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function optionDropdown() {
  document.getElementById("sortDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.sortDropdownButton') && !event.target.matches('.sortIcon')) {
    var dropdowns = document.getElementsByClassName("sortDropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}



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


$(document).on('click', '.text_cont', function() {
  //$(".row").toggleClass('hoops');

  
  if(!$(this)[0].classList.contains("expand_text")){
    $(this).closest(".post_cont").toggleClass('expand_cont');
$(this).toggleClass('expand_text');
$(this).css("border","none");
$(this).css("cursor","auto");
  }

  //$(".post_cont").toggleClass('expand_cont');
 
});



$(document).on('click', '#log', function(){

  
  var username = $('#username').val();
  var password = $('#password').val();
  
  if(username == "" || password == "" ){
      console.log("Wrong input");
  }else {
    /*var data = {};
    data['username'] = username;
    data['password'] = password;  */
          $.ajax({
          url: "loginUser",
          method: "POST",
          data:{user : username , pass : password},
          success: function(data){

            var flag = JSON.parse(data).flag;
            if(flag){
              window.location.href = 'profile';
            }

            console.log(data);
            //window.location.replace("user.php");
            //window.location.href = 'profile';
              //window.location.assign('user.php');
          }
      });
  } 
  
  });
  
  $(document).on('click', '#reg', function(){
  
      //Check if empty
      var username  = $('#usernameReg').val();
      var password  = $('#password1').val();
      var email     = $('#email').val();
      var join_date = $('#join_date').val();
      var birthday  = $('#birthday').val();
      console.log("ks");
      
      if(username == "" || password == "" ){
          console.log("Wrong input");
      }else {
          $.ajax({
              url: "register",
              method: "POST",
              data:{user: username ,pass: password,email : email, join_date : join_date, birthday:birthday},
              success: function(data){
              var flag = JSON.parse(data).flag;
                if(flag){
                  window.location.href = 'profile';
                }
               console.log(data);
               
                //window.location.replace("user.php");
                //window.location.href = 'profile';
                  //window.location.assign('user.php');
              }
          });
      } 
      
      
      
      
      });







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
          if(!flag){
            var url = window.location.href.split('/');
            //console.log(url);
             $.ajax({
               async : false ,
               url: "../indexPage",
               method: "POST",
               data:{grab : last_grabbed, cat : url[4]},
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

              
                }
              }
          });




}



    $(document).on('click', '#likeButton', function(){
      vote($(this),"likes","post","like", "green" );
      //Check if empty
      /*var thisButton = $(this);
      var ID  = $(this).closest("div[data-id]").attr('data-id');
      var ss      = +$(this).closest("div[data-id]").find(".likes").text();
      var updateType;
      if(!thisButton[0].classList.contains("full")){
        //$(this).closest(".post_cont").toggleClass('expand_cont');
        updateType = true;  
        console.log("sss");    
      }else{
        updateType = false;
      }

      
      
      console.log(ID);
      //console.log("Wrong input");
     var url = window.location.href.split('/');
      console.log(url);
          $.ajax({
              url: "vote",
              method: "POST",
              data:{ ID : ID , action : "likes", type : "post", update : updateType},
              async:false,
              success: function(data){
                console.log("hg");
                console.log(data);
                flag = JSON.parse(data).message;
                if(flag){
                  
                  if(updateType){
                    thisButton.toggleClass("full");
                    thisButton.find(".likeImage").attr("src","content/img/greenFull.svg");
                    thisButton.closest("div[data-id]").find(".likes").text(ss + 1);
                  }else{
                    thisButton.removeClass("full");
                    thisButton.find(".likeImage").attr("src","content/img/greenEmpty.svg");
                    thisButton.closest("div[data-id]").find(".likes").text(ss - 1);
                  }

              
                }
                //window.location.replace("user.php");
                //window.location.href = '../profile';
                  //window.location.assign('user.php');
              }
          });*/
      
      
      
      
      
      });


      

    $(document).on('click', '#dislikeButton', function(){
      vote($(this),"dislikes","post","dislike", "red" );
     

        
      
      
      
      
      
      });



      

    $(document).on('click', '#clikeButton', function(){
      cvote($(this),"likes","comment","like", "green" );
      //Check if empty
     /* var ID  = $(this).closest("div[comment-id]").attr('comment-id');
      var ss      = +$(this).closest("div[comment-id]").find(".comment_likes").text();
      $(this).closest("div[comment-id]").find(".comment_likes").text(ss + 1);
      console.log(ID);
      //console.log("Wrong input");
     var url = window.location.href.split('/');
      console.log(url);
          $.ajax({
              url: "vote",
              method: "POST",
              data:{ ID : ID , action : "likes" , type : "comment"},
              success: function(data){
                console.log("hg");
                console.log(data);
                //window.location.replace("user.php");
                //window.location.href = '../profile';
                  //window.location.assign('user.php');
              }
          });
      
      */
      
      
      
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
  
                
                  }
                }
            });
  
  
  
  
  }
  
  


    $(document).on('click', '#cdislikeButton', function(){
      cvote($(this),"dislikes","comment","dislike", "red" );
      //Check if empty
      /*
      var ss      = +$(this).closest("div[comment-id]").find(".comment_dislikes").text();
      $(this).closest("div[comment-id]").find(".comment_dislikes").text(ss + 1);
      
      //console.log("Wrong input");
     var url = window.location.href.split('/');
      console.log(url);
          $.ajax({
              url: "vote",
              method: "POST",
              data:{ ID : ID , action : "dislikes", type : "comment"},
              success: function(data){
                console.log("hg");
                console.log(data);
               // $(this).closest("div[data-id]").find(".dislikes").text(ss + 22);
                console.log(ss);


                //ss.closest(".dislikes").val($(this).closest(".dislikes").value + 1) ;
                //window.location.replace("user.php");
                //window.location.href = '../profile';
                  //window.location.assign('user.php');
              }
          });
      */
      
      
      
      
      });