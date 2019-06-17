<div class="dash_post_cn">
<?php foreach($this->output['posts'] as $arr){ ?>

<div class="dash_post">
    <div class="content">
            <div class="dash_post_title"><?php echo $arr['title']?></div>
            <div class="dash_post_score">
                <div class="green_score"><?php echo $arr['likes'];  ?></div>
                <div class="userPostsDot">&#9679</div>


                <!--
                <div class="score_bar">
                        <div class="green_bar"></div>
                        <div class="red_bar"></div>
                </div>
                -->
                <div class="red_score"><?php echo $arr['dislikes'];  ?></div>
                
            </div>




            <div class="settings">
                <div class="comments_score dashPostButton"><a href="comment/<?php echo $arr['postID'];  ?>" ><div class="buttonContainerProfile"><div class="buttonContainerProfileText"><?php echo $arr['comments']." Comments";  ?></div> </div></a></div>
                <?php if(isset($_SESSION['user']) && $_SESSION['user'] == $this->username){?>
 
                    <div class="dashPostButton edit"><a href="edit/<?php echo $arr['postID'];  ?>"><div class="buttonContainerProfile"><div class="buttonContainerProfileText">Edit</div> </div></a></div>
                    <div class="dashPostButton visit"><a href="delete/<?php echo $arr['postID'];  ?>"><div class="buttonContainerProfile"><div class="buttonContainerProfileText">Delete</div> </div></a></div>
                <?php }?>
            </div>


            
        </div>


  
</div>
    <?php }?>
    
    
 
    <?php if(isset($_SESSION['user']) && $_SESSION['user'] == $this->username){?>
<a href="edit">
    <div class="dash_post">
        <div class="add_post_plus">&#10010;</div>
    </div>
</a>
    <?php }?>


</div>