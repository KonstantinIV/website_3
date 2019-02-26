<?php
session_start();
if(!isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: log_in.php');
}



?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<link rel="stylesheet" type="text/css" href="../css/mainStyle.css">
<link rel="stylesheet" type="text/css" href="../css/login.css"> 
<link rel="stylesheet" type="text/css" href="../css/edit_post.css">


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
                        <li class="row_child"><a href="logout.php">Log out</a></li>
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
  
<?php
require_once 'library/profile.php';
$post_id = $_GET['id'];
//echo $post_id;
$pdo = new database;
$editablePost = new us_posts($pdo->retPdo());




?>
<div class="textarea_ct">
        
                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" > <?php echo $editablePost->getTitle($post_id); ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                                <textarea class="textarea year" type="text" id="year" placeholder="yyyy" ></textarea>
                                <textarea class="textarea date" type="text" id="month" placeholder="mm" ></textarea>
                                <textarea class="textarea date" type="text" id="day" placeholder="dd" ></textarea>
                                <div class="dat_text">Insert the date of the release</div>
                        </div>
                </div>
                        

                <textarea class="textarea" type="text"          id="text"  ><?php echo $editablePost->getText($post_id); ?></textarea>
                <div class="button_ct"> 
                        <div class="add_post" id="add">POST</div>
                </div>


     

 
        
</div>






<!-- TESTING-->



      
<footer>

</footer>
	  
</body>

</html>