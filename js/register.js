$(document).on('click', '.button', function(){

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
            url: "../php/library/register.php",
            method: "POST",
            data:{user: username ,pass: password,email : email, join_date : join_date, birthday:birthday},
            success: function(data){
              console.log(data);
              //window.location.replace("user.php");
              window.location.href = '/php/profile.php';
                //window.location.assign('user.php');
            }
        });
    } 
    
    
    
    
    });