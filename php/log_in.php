<?php 
session_start();
//$_SESSION['user'] = "sfdds";
if(isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" type="text/css" href="../css/login.css">
<script type="text/javascript" src="http://livejs.com/live.js"></script>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/log_in.js"></script>




</head>
<body >

    
<header>
<div class="main_box">      
        <div class="logo">PRED

        </div>
        


        
        <ul class="row">        
        <li class="row_child"><a href="main.html">Post</a></li>
                <li class="row_child"><a href="main.html">Search</a></li>
                <?php
                    if(isset($_SESSION['user']) ) {
                ?>        
                        <li class="row_child"><a href="logout.php">Log out</a></li>
                <?php
                     }else{
                ?>
                        <li class="row_child"><a href="log_in.php">Log in</a></li>
                <?php        
                     }
                ?>
        </ul>
        <div class="nav_button_ct"> 
        <div class="nav_button"> <img src="img/icons8-menu.svg" alt="icon">
        </div>
        </div>

</div>    
</header>
  

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