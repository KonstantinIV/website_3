<?php
session_start();
$_SESSION['user'] = "sfdds";
if(isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<link rel="stylesheet" type="text/css" href="../css/mainStyle.css">
<link rel="stylesheet" type="text/css" href="../css/login.css">



<script type="text/javascript" src="http://livejs.com/live.js"></script>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/script.js"></script>




</head>
<body >
<header>
<div class="main_box">      
        <div class="logo">PREDs

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


require_once 'library/profile.php';

$pdo = new database();
$posts = new us_posts($pdo->retPdo());

$posts->setPosts($_SESSION['user']);
//echo $posts->posts;
print_r($posts->posts);
foreach ($posts->posts as $value_ID){


    echo  '<div class="dash_post">
    <div class="content">
        <div class="dash_post_title">'.$posts->getTitles($value_ID) .'</div>
        
        <div class="dash_post_score">
            <div class="green_score">'.$posts->getLikes($value_ID).'</div>
            <div class="score_bar">
                    <div class="green_bar"></div>
                    <div class="red_bar"></div>
            </div>
            <div class="red_score">'.$posts->getDislikes($value_ID).'</div>
            <div class="comments_score">COMMENTS '.$posts->getComments($value_ID).'</div>
        </div>
    </div>
    <div class="settings">
        <div class="edit">Edit</div>
        <div class="visit">Visit</div>

    </div>

</div>';


}



?>



        <div class="dash_post">

                <div class="add_post_plus">&#10010;</div>
            </div>

    </div>


    <?php

    $stats = new score($pdo->retPdo());
    $stats->setScores($_SESSION['user']);

        echo '<div class="dash_stats">
        <div class="user_profile">
            <div class="user_picture">
                <div class="picture"><img class="image" src="../img/owl.PNG" alt="owl"></div>

            </div>
            <div class="username_cont">
                <div class="username">'.$stats->retUsername().'</div>
                <div class="other_inf">joined '.$stats->retUserjoindate().'</div>

            </div>            
        </div>

        <div class="user_stats">
            <div class="total_user_post">
                <div class="exp">Total posts</div>
                <div class="val">'.$stats->retTotalposts().'</div>
            </div>
            <div class="total_user_comment">
                <div class="exp">Total comments received</div>
                <div class="val">'.$stats->retTotalcomments().'</div>
            </div>
            <div class="total_user_like">
                <div class="exp">Total likes received</div>
                <div class="val">'.$stats->retTotallikes().'</div>
            </div>
    
            <div class="total_public_comment">
                    <div class="exp">Total comments given</div>
                    <div class="val">131</div>    
            </div>
            <div class="total_public_like">
                    <div class="exp">Total likes given</div>
                    <div class="val">142</div>
            </div>

        </div>

    </div>';
    ?>
</div>