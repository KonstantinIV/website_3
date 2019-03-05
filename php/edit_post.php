<?php 
require_once "utilities/check_session.php";
require_once "templates/head.php";
require_once "templates/navigation.php";

require_once 'library/profile.php';
$id = $_GET['id'];
//echo $post_id;
$pdo = new database;
$editablePost = new profile($pdo->retPdo());




?>
<div class="textarea_ct">
        
                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" > <?php echo $editablePost->getTitle($id); ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                                <textarea class="textarea year" type="text" id="year" placeholder="yyyy" ></textarea>
                                <textarea class="textarea date" type="text" id="month" placeholder="mm" ></textarea>
                                <textarea class="textarea date" type="text" id="day" placeholder="dd" ></textarea>
                                <div class="dat_text">Insert the date of the release</div>
                        </div>
                </div>
                        

                <textarea class="textarea" type="text"          id="text"  ><?php echo $editablePost->getText($id); ?></textarea>
                <div class="button_ct"> 
                        <div class="add_post" id="add">POST</div>
                </div>


     

 
        
</div>






<!-- TESTING-->



      
<footer>

</footer>
	  
</body>

</html>