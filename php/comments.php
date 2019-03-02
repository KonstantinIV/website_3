<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

 
<link rel="stylesheet" type="text/css" href="../css/comments.css">



<script type="text/javascript" src="http://livejs.com/live.js"></script>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/script.js"></script>



</head>
<body >

    
<header>
<div class="main_box">      
        <div class="logo">PRED

        </div>
        


        
        <ul class="row">        
                <li class="row_child"><a href="main.html">Post</a></li>
                <li class="row_child"><a href="main.html">Search</a></li>
                <li class="row_child"><a href="user.html">Log in</a></li>
        </ul>
        <div class="nav_button_ct"> 
        <div class="nav_button"> <img src="img/icons8-menu.svg" alt="icon">
        </div>
        </div>

</div>    
</header>


  

<div class="main_cont">
                <div class="pop_post_cont">
                                <div class="post_cont">
                                                <div class="post_header">Title</div> 
                                                <div class="post_user">Username</div> 
                                                <div class="column_2">
                                                        <div class="text_cont">
                                                                <p class="post_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                                
                        
                                                        </div>
                                                        <div class="date_cont">
                                                                <div class="post_date_1">Post date: <br><span class="date_f">2019-01-15 01:26:26</span></div>
                                                                <br>
                                                                <div class="post_date_2">Rs date:<br><span class="date_f">2019-01-15 </span> </div>
                                                               <br> 
                                                                <div class="post_date_3">Database Rs date:<br><span class="date_f">2019-01-15 </span></div>
                                                                <br>
                                                        </div>
                        
                                                </div>
                                                <div class="post_buttons">
                                                        <div class="like_button">LI</div>
                                                        <div class="di_li_cont">
                                                                <div class="likes">44</div>
                                                                <div class="">&#9679</div>
                                                                <div class="dislikes">22</div>
                                                        </div>        
                                                        <div class="dislike_button">DI</div>
                                                        <div class="comment_button">COMMENTS &#10095;</div>
                                                </div>
                                </div>
                        </div>

        <div class="right_cont">
                
                <div class="smaller_cont">
                <h3 class="cat_head">Categories</h3>
                        <ul class="list_category">
                                <li><a class="" href="" >Books</a></li>
                                <li><a class="" href="" >TV show</a></li>
                                <li><a class="" href="" >Anime/Manga</a></li>
                                <li><a class="" href="" >Movies</a></li>
                                <li><a class="" href="" >Events</a></li>
                                <li><a class="" href="" >Gaming</a></li>
                                <li><a class="" href="" >Sport</a></li>
                        </ul>

                </div>
               

        </div>



</div>






<div class="comment_section">
<?php

require_once 'library/profile.php';
session_start();
$_SESSION['user'] = "sfdds";
$pdo = new database();
$posts = new us_posts($pdo->retPdo());
$posts->setPosts($_SESSION['user']);
print_r($posts->getCommentid(2));
$key = $posts->getCommentid(2);



function rec2($id_pos,$space,$key,$color){
        //$key       = array(1 => NULL, 2 => 1, 3 => 2, 4 => 3, 5 => 3, 65 => 3 , 7 => 3, 8 => 1 , 9 => 1 , 10 => 1);
        /* echo result */
        //print_r($key);
        /*for($i = 0; $i <= $space; $i++){
            echo "*";
        }*/
        //echo $id_pos;
        $inte = 20*$space;
        echo '<div class="comment" style="margin-left:'.$inte.'px;';
        if($color == 1){
                echo 'background-color: transparent;border: 3px solid #36274b;">';
        }else{
                echo '">';
        }
        echo '        
        <div class="comment_user"><div class="user">User</div>&#9679<div class="comment_date">5 hours ago</div></div>
        <div class="comment_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </div>
        
                <div class="comment_buttons">
                        <div class="comment_like_button">LI</div>
                        <div class="comment_di_li_cont">
                                <div class="comment_likes">44</div>
                                <div class="">&#9679</div>
                                <div class="comment_dislikes">22</div>
                        </div>        
                        <div class="comment_dislike_button">DI</div>
                        <div class="comment_comment_button">REPLY &#10095;</div>
                </div>

      

    </div>';

        
        //echo "<br>";
        /***************/
    
    
        /*core*/
        if($color ==0){
                $color = 1;
        }else{
                $color = 0;  
        }
        $flag = 0;
        foreach($key as $id => $parent_id){
            if($parent_id == $id_pos){
                $flag = 1;
                rec2($id,$space+1,$key,$color);
            }
        }
        if($flag == 0 ){
                echo "<br>";
        }
    
       
       
    
    }
    rec2(0,0,$key,0);









?>



    
    
</div>



<!-- TESTING-->



      
<footer>

</footer>
	  
</body>

</html>