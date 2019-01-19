$(document).on('click', '.submit', function(){

//Check if empty
var username = $('#username').val();
var password = $('#password').val();

if(username == "" || password == "" ){
    console.log("Wrong input");
}else {
    $.ajax({
        url: "../php/log_in.php",
        method: "GET",
        data:{user: username ,pass: password},
        success: function(data){
          console.log(data);
        }
    });
} 




});