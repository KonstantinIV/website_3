

<div class="dash_stats">
<div class="user_profile">
    <div class="user_picture">
        <div class="picture"><img class="image" src="content/img/owl.PNG" alt="owl"></div>

    </div>
    <div class="username_cont">
        <div class="username"><?php echo $this->username ;?></div>
        <div class="other_inf">joined <?php echo $this->output['joinDate']?></div>

    </div>            
</div>

<div class="user_stats">
    <div class="total_user_post">
        <div class="exp">Total posts</div>
        <div class="val"><?php echo $this->output['postCount']?></div>
    </div>
    <div class="total_user_comment">
        <div class="exp">Total comments</div>
        <div class="val"><?php echo $this->output['commentCount']?></div>
    </div>
    <div class="total_user_like">
        <div class="exp">Total likes</div>
        <div class="val"><?php echo $this->output['likeCount']?></div>
    </div>


    


</div>


</div>
