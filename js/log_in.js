$(document).on('click', '.button', function(){

//Check if empty
var username = $('#username').val();
var password = $('#password').val();
console.log("Wrong input");

if(username == "" || password == "" ){
    console.log("Wrong input");
}else {
    $.ajax({
        url: "../php/log_in.php",
        method: "POST",
        data:{user: username ,pass: password},
        success: function(data){
          console.log(data);
          //window.location.replace("user.php");
          window.location.href = 'user.php';
            //window.location.assign('user.php');
        }
    });
} 




});