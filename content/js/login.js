function userNameVal(username){
    if( username.length > 24 || username.length < 3 || typeof username != 'string')  {
       
        return {flag : false, message : "Invalid length"};
    }
    var usernameReg = new RegExp('^[a-zA-Z0-9_-]{3,24}$');

    if(!usernameReg.test(username)){
        console.log(typeof username);
        return {flag : false, message : "Contains wrong characters"};
    }
    var flag;
    $.ajax({
        url: "registerU/userVal",
        async: false,
        method: "POST",
        data:{user : username },
        success: function(data){

          flag = Boolean(JSON.parse(data).flag);
          
        

          
        }
    });
     
    if(!flag){
        return {flag : false, message : "Username exists"};
    }


    return {flag : true, message : ""};
}

function emailVal(email){
    console.log("SS");
    var flag = true;
    var message = "";
    $.ajax({
        url: "registerU/emailVal",
        async: false,
        method: "POST",
        data:{email : email },
        success: function(data){
            
          flag = Boolean(JSON.parse(data).flag);
          message = JSON.parse(data).message;
          console.log(typeof(message));
          console.log(typeof(flag));
          
        

          
        }
    });
     
    if(!flag){
        return {flag : false, message : message};
    }


    return {flag : true, message : ""};
}

function passVal(password){
    if(  password.length < 8 || typeof password != 'string')  {
       
        return {flag : false, message : "Must be min. 8 char. long"};
    }
   

    return {flag : true, message : ""};

}

function inputBorder(arr,thisInput){

    if(arr['flag']){
        thisInput.closest(".inputMessageContainer").find(".inputMessage").text(arr['message'])
        thisInput.css("border", "1px solid green")
    }else{
        thisInput.closest(".inputMessageContainer").find(".inputMessage").text(arr['message'])
        thisInput.css("border", "1px solid #e2333d")
    }
}


$(document).ready(function(){
    //USERNAME
    $('#usernameReg').on('input', function() {
        inputBorder(userNameVal($(this).val()),$(this));
    });
    //EMAIL
    $('#emailReg').on('input', function() {
        inputBorder(emailVal($(this).val()),$(this));
    });
    $('#password1').on('input', function() {
        inputBorder(passVal($(this).val()),$(this));
    });

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
                window.location.href = 'profile/' + username;
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
        var thisInput = $(this);
        //Check if empty
        var username  = $('#usernameReg').val();
        var password  = $('#password1').val();
        var email     = $('#emailReg').val();
        var join_date = $('#join_date').val();
        var birthday  = $('#birthday').val();
        console.log("ks");
        
        if(username == "" || password == "" ){
            $('#regMessage').text("Empty fields");
        }else {
            $.ajax({
                url: "registerU",
                method: "POST",
                data:{user: username ,pass: password,email : email, join_date : join_date, birthday:birthday},
                success: function(data){
                var flag = JSON.parse(data).flag;
                var message = JSON.parse(data).message;
                  if(flag){
                    window.location.href = 'profile';
                  }
                  $('#regMessage').text(message);

                 console.log(data);
                 
                  //window.location.replace("user.php");
                  //window.location.href = 'profile';
                    //window.location.assign('user.php');
                }
            });
        } 
        
        
        
        
        });
  