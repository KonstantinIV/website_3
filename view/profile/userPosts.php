<div class="dash_post_cn">
<?php foreach($this->output['posts'] as $arr){?>

<div class="dash_post">
    <div class="content">
            <div class="dash_post_title"><?php echo $arr['title']?></div>
            <div class="dash_post_score">
                <div class="green_score"><?php echo $arr['likes'];  ?></div>
                <div class="score_bar">
                        <div class="green_bar"></div>
                        <div class="red_bar"></div>
                </div>
                <div class="red_score"><?php echo $arr['dislikes'];  ?></div>
                <div class="comments_score"><a href="comment/<?php echo $arr['postID'];  ?>" ><?php echo $arr['comments'];  ?></a></div>
            </div>
    </div>


    <?php if(isset($_SESSION['user']) && $_SESSION['user'] == $this->username){?>
    <div class="settings">
        <div class="edit"><a href="edit/<?php echo $arr['postID'];  ?>">Edit</a></div>
        <div class="visit"><a href="delete/<?php echo $arr['postID'];  ?>">Delete</a></div>
    </div>
    <?php }?>
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