

<div class="dash_stats">
<div class="user_profile">
    <div class="user_picture">
        <div class="picture"><img class="image" src="content/img/owl.PNG" alt="owl"></div>

    </div>
    <div class="username_cont">
        <div class="username"><?php echo $_SESSION['user']?></div>
        <div class="other_inf">joined <?php echo $this->pageData['outputData']['joinDate']?></div>

    </div>            
</div>

<div class="user_stats">
    <div class="total_user_post">
        <div class="exp">Total posts</div>
        <div class="val"><?php echo $this->pageData['outputData']['postCount']?></div>
    </div>
    <div class="total_user_comment">
        <div class="exp">Total comments received</div>
        <div class="val"><?php echo $this->pageData['outputData']['commentCount']?></div>
    </div>
    <div class="total_user_like">
        <div class="exp">Total likes received</div>
        <div class="val"><?php echo $this->pageData['outputData']['likeCount']?></div>
    </div>


</div>

</div>
