<?php
session_start();
if(isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
<link rel="stylesheet" type="text/css" href="css/login.css">



<script type="text/javascript" src="http://livejs.com/live.js"></script>
<script src="js/jquery-3.3.1.js"></script>
<script src="js/script.js"></script>
<script src="js/post_get_post.js"></script>



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
                        <li class="row_child"><a href="main.html">Log out</a></li>
                <?php
                     }else{
                ?>
                        <li class="row_child"><a href="main.html">Log in</a></li>
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
<div class="dash_cn">



<div class="dash_post_cn">
    <?php


    ?>



            <div class="dash_post">
                    <div class="content">
                        <div class="dash_post_title"> Very long tittlelel ewer wlf s fslk sdsfk lj dskdsfjksdf skdf jsdf lksdjf </div>
                        
                        <div class="dash_post_score">
                            <div class="green_score">34</div>
                            <div class="score_bar">
                                    <div class="green_bar"></div>
                                    <div class="red_bar"></div>
                            </div>
                            <div class="red_score">65</div>
                            <div class="comments_score">COMMENTS 59</div>
                        </div>
                    </div>
                    <div class="settings">
                        <div class="edit">Edit</div>
                        <div class="visit">Visit</div>
        
                    </div>
        
                </div>





        <div class="dash_post">

                <div class="add_post_plus">&#10010;</div>
            </div>

    </div>
</div>