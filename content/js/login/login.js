
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
        }else if(!(JSON.parse(register(username,password,email,join_date,birthday)).flag)){
            
              if(flag){
                window.location.href = 'profile';
              }
              var message = JSON.parse(data).message;
              $('#regMessage').text(message);
        }
    });   


      function logIn(){
        var username = $('#username').val();
        var password = $('#password').val();
        
            if(validateUser(username,password) ){
                console.log("Wrong input");
            }else if(!(JSON.parse(loginUser(username,password)).flag)) {
                console.log("Login failed");
            }
           
        } 

  
      function validateUser(username,password){
        if(username == "" || password == "" ){
            return false;
        }
      }


      function loginUser(username,password){
       return $.ajax({
            url: "loginUser",
            method: "POST",
            async:false,
            data:{user : username , pass : password}
        }).responseText;
      }

      function register(username,password,email,join_date,birthday){
            return $.ajax({
                url: "registerU",
                method: "POST",
                async:false,
                data:{user: username ,pass: password,email : email, join_date : join_date, birthday:birthday}
            }).responseText;
      }


  }());

  