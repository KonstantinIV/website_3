(function() {
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

    function inputBorder(arr,thisInput){
        if(arr['flag']){
            thisInput.closest(".inputMessageContainer").find(".inputMessage").text(arr['message'])
            thisInput.css("border", "1px solid green")
        }else{
            thisInput.closest(".inputMessageContainer").find(".inputMessage").text(arr['message'])
            thisInput.css("border", "1px solid #e2333d")
        }
    }
    function validateUsernameLength(username){
        if( username.length > 24 || username.length < 3 || typeof username != 'string')  {
            return false;
        }
        return true;
    }
    function regexUsername(username){
        var usernameReg = new RegExp('^[a-zA-Z0-9_-]{3,24}$');
        if(!usernameReg.test(username)){
            return false;
        }
        return true;
    }
    function usernameExists(username){
        return $.ajax({
            url: "registerU/userVal",
            async: false,
            method: "POST",
            data:{user : username }
        }).responseText;
    }

    function userNameVal(username){
        if(!validateUsernameLenght()){
            return {flag : false, message : "Invalid length"};
        }else if(!regexUsername(username)){
            return {flag : false, message : "Contains wrong characters"};
        }else if(!Boolean(JSON.parse(usernameExists(username)).flag)){
            return {flag : false, message : "Username exists"};
        }
        return {flag : true, message : ""};
    }

    function emailExists(email){
        return $.ajax({
            url: "registerU/emailVal",
            async: false,
            method: "POST",
            data:{email : email }
        }).responseText;
    }

    function emailVal(email){
        console.log("SS");
        var flag = true;
        var message = "";

        data = emailExists(email);
        flag = Boolean(JSON.parse(data).flag);
        message = JSON.parse(data).message;
 
        if(!flag){
            return {flag : false, message : message};
        }
        return {flag : true, message : ""};
    }

    function validatePassword(password){
        if(  password.length < 8 || typeof password != 'string')  {
           return false;
        }
        return true;
    }

    function passVal(password){
        if(!validatePassword(password)){
            return {flag : false, message : "Must be min. 8 char. long"};

        }
       
    
        return {flag : true, message : ""};
    
    }



  }());