<?php 
require_once "utilities/check_session2.php";
require_once "templates/head.php";
require_once "templates/navigation.php";
?>

<body >
<div class="cont">

    
    <div class="login_cont">
        <div class="sign">Sign in</div>
        <div class="username">
            
            <input class="username_in" type="text" id="username" name="user" placeholder="Username" required>
        </div>
        <div class="password">
           
            <input class="password_in" type="text" id="password" name="pass" placeholder="Password" required>
        </div>
        <div class="button_cont">
            <div class="button">SIGN IN</div>
        </div>
    </div>
   

    <div class="login_cont">
            <div class="sign">Sign up</div>
            <div class="username">
                <input class="username_in" type="text" id="username" name="user" placeholder="Username" required>
            </div>
            <div class="username">
                    <input class="username_in" type="text" id="email" name="email" placeholder="Email" required>
                </div>



            <div class="password">
                <input class="password_in" type="text" id="password1" name="pass1" placeholder="Password" required>
            </div>
            <div class="password">
                    <input class="password_in" type="text" id="password2" name="pass2" placeholder="Password" required>
            </div>
            <div class="password">
                    <input class="password_in" type="text" id="birthday" name="pass2" placeholder="Password" required>
            </div>

            <div class="button_cont">
                <div class="button">LOG IN</div>
            </div>
        </div>

</div>





<!-- TESTING-->



      
<footer>

</footer>
	  
</body>

</html>