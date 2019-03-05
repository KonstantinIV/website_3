<?php 
session_start();
require_once "templates/head.php";
require_once "templates/navigation.php";

require_once 'library/profile.php';

?>
<div class="dash_cn">
<div class="dash_post_cn">

<?php
if($_GET['user'] == $_SESSION['user'] OR !$_GET['user']){
    $username = $_SESSION['user'];
}else{
    $username = $_GET['user'];
}

$pdo = new database();
$profile = new profile($pdo->retPdo());
$profile->setPosts($username);
//print_r($posts->posts);
foreach ($profile->posts as $value_ID){
echo  '<div class="dash_post">
    <div class="content">
        <div class="dash_post_title">'.$profile->getTitles($value_ID) .'</div>
        
        <div class="dash_post_score">
            <div class="green_score">'.$profile->getLikes($value_ID).'</div>
            <div class="score_bar">
                    <div class="green_bar"></div>
                    <div class="red_bar"></div>
            </div>
            <div class="red_score">'.$profile->getDislikes($value_ID).'</div>
            <div class="comments_score"><a href="comments.php?id='.$value_ID.'" >COMMENTS '.$profile->getComments($value_ID).'</a></div>
        </div>
    </div>';
    if(isset($_SESSION['user']) AND $_SESSION['adm'] == 1 AND $_GET['user'] == $_SESSION['user'] ){
    echo '
    <div class="settings">
        <div class="edit"><a href="edit_post.php?id='.$value_ID.'">Edit</a></div>
        <div class="visit"><a href="delete.php?id='.$value_ID.'">Delete</a></div>
    </div>';
    
    }
    echo '</div>';
}
?>
<a href="edit_post.php"><div class="dash_post">
                <div class="add_post_plus">&#10010;</div>
        </div></a>
        
        </div>
    


    <?php

        echo '<div class="dash_stats">
        <div class="user_profile">
            <div class="user_picture">
                <div class="picture"><img class="image" src="../img/owl.PNG" alt="owl"></div>

            </div>
            <div class="username_cont">
                <div class="username">'.$profile->retUsername().'</div>
                <div class="other_inf">joined '.$profile->get_join_date().'</div>

            </div>            
        </div>

        <div class="user_stats">
            <div class="total_user_post">
                <div class="exp">Total posts</div>
                <div class="val">'.$profile->get_total_posts().'</div>
            </div>
            <div class="total_user_comment">
                <div class="exp">Total comments received</div>
                <div class="val">'.$profile->get_total_comments().'</div>
            </div>
            <div class="total_user_like">
                <div class="exp">Total likes received</div>
                <div class="val">'.$profile->get_total_likes().'</div>
            </div>


        </div>

    </div>';
    ?>
</div>