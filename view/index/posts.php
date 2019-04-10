

<?php   foreach($this->output as $arr){ echo $arr['ID'];?>
        
    <div class="post_cont" data-id = "<?php echo $arr['ID'];  ?>">
                    <div class="post_header"><?php echo $arr['title'];  ?></div> 
                    <div class="post_user"><?php echo $arr['username'];  ?></div> 
                    <div class="column_2">
                            <div class="text_cont">
                                    <p class="post_text"><?php echo $arr['text'];  ?></p>
                                    <div class="expand_post"><div>&#10225;</div></div>

                            </div>
                            <div class="date_cont">
                                    <div class="post_date_1">Post date: <br><span class="date_f"><?php echo $arr['createdDate'];  ?></span></div>
                                    <br>
                                    <div class="post_date_2">Rs date:<br><span class="date_f"><?php echo $arr['releaseDate'];  ?> </span> </div>
                                    <br> 
                                    <div class="post_date_3">Database Rs date:<br><span class="date_f">2019-01-15 </span></div>
                                    <br>
                            </div>

                    </div>
                    <div class="post_buttons">
                            <div class="like_button" id="likeButton">LI</div>
                            <div class="di_li_cont">
                                    <div class="likes"><?php echo $arr['likes'];  ?></div>
                                    <div class="">&#9679</div>
                                    <div class="dislikes" ><?php echo $arr['dislikes'];  ?></div>
                            </div>        
                            <div class="dislike_button" id="dislikeButton">DI</div>
                            <a href="comment/<?php echo $arr['ID'];  ?>" ><div class="comment_button">COMMENTS &#10095;</div></a>
                    </div>
    </div>
<?php }   ?>
























