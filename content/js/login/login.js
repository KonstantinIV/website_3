
(function() {
    $("#password").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            console.log("ssss");
            $("#log").click();
        }
    });

    $(document).on('click', '#log', function(){

        logIn();
      
      });   

      $(document).on('click', '#reg', function(){
        var username  = $('#usernameReg').val();
        var password  = $('#password1').val();
        var email     = $('#emailReg').val();
        var join_date = $('#join_date').val();
        var birthday  = $('#birthday').val();

        if(!validateUser(username,password) ){
            $('#regMessage').text("Empty fields");
            return false;
        }
        var data = register(username,password,email,join_date,birthday);
        if((JSON.parse(data).flag)){
       
                window.location.href = 'profile';
              
              
        }else{
            var message = JSON.parse(data).message;
            $('#regMessage').text(message);
        }
    });   


      function logIn(){
        var username = $('#username').val();
        var password = $('#password').val();
        
            if(!validateUser(username,password) ){

                $(".loginError").text("Username or Password incorrect")
                $('#username').css("border", "1px solid red")
                $('#password').css("border", "1px solid red")
                return false;
            }
            
            var result = JSON.parse(loginUser(username,password));

            if(!result.flag) {

                $(".loginError").text(result.message)
                $('#username').css("border", "1px solid red")
                $('#password').css("border", "1px solid red")

                return false;
                
            }else{
                window.location.href = 'profile';

            }
           
        } 

  
      function validateUser(username,password){
        if(username == "" || password == "" ){
            return false;
        }else{
            return true;

        }
      }


      function loginUser(username,password){
       return $.ajax({
            url: "loginUser",
            method: "GET",
            async:false,
            data:{username : username , password : password}
        }).responseText;
      }

      function register(username,password,email,join_date,birthday){
            return $.ajax({
                url: "registerU",
                method: "POST",
                async:false,
                data:{username: username ,password: password,email : email, join_date : join_date, birthday:birthday}
            }).responseText;
      }


  }());

  