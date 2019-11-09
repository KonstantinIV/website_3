

<?php 
  foreach($this->output as $arr){/* echo $arr['ID'];*/?>
        
    <div class="post_cont" data-id = "<?php echo $arr['ID'];  ?>">
                    <div class="post_header"><?php echo $arr['title'];  ?></div> 
                    <div class="post_user">By 
                        <a href="profile/<?php echo $arr['username'];  ?>"><?php echo $arr['username'];  ?></a>
                        <span class="usernameDot" >&nbsp;&nbsp;&nbsp;  </span>
                         <span class="createdDate" date='<?php echo $arr['createdDate']  ; ?>'> 
                          <?php echo $this->helper->time_elapsed_string($arr['createdDate'])  ; ?> </span>
                    </div> 
                    <div class="column_2">
                            <div class="text_cont">
                                    <p class="post_text"><?php echo $arr['text'];  ?>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                  

                            </div>
                            
                            <div class="date_cont">
                                    
                                    <div class="post_date_2"><span class="releaseDate" date='<?php echo $arr['releaseDate']  ; ?>'><?php         echo $this->helper->time_elapsed_string($arr['releaseDate'])  ;?> </span> </div>
                                    
                                    
                            </div>

                    </div>
                    <!--<div class="expand_post"><div>Expand</div></div>-->
                    <div class="post_buttons">

                        <?php  if($arr['livoted'] == 1){
                                echo  '<div class="like_button full" id="likeButton"><img class="likeImage" src="content/img/greenFull.svg" alt="arrow"></div> ';
                                }elseif($arr['livoted'] == 0){
                                        echo ' <div class="like_button" id="likeButton"><img class="likeImage" src="content/img/greenEmpty.svg" alt="arrow"></div> ';
                                }else{
                                        echo ' <div class="like_button" id="likeButton"><img class="likeImage" src="content/img/greenEmpty.svg" alt="arrow"></div> ';
                                } ?>
                           
                           
                           
                           
                           
                           
                            <div class="di_li_cont">
                                    <div class="likes"><?php echo $arr['likes'];  ?></div>
                                    <div class="">&#9679</div>
                                    <div class="dislikes" ><?php echo $arr['dislikes'];  ?></div>
                            </div>

                            <?php  if($arr['divoted'] == 1){
                                echo  '<div class="dislike_button full" id="dislikeButton"><img class="dislikeImage" src="content/img/redFull.svg" alt="arrow"></div> ';
                                }elseif($arr['divoted'] == 0){
                                        echo ' <div class="dislike_button" id="dislikeButton"><img class="dislikeImage" src="content/img/redEmpty.svg" alt="arrow"></div>';
                                }else{
                                        echo ' <div class="dislike_button" id="dislikeButton"><img class="dislikeImage" src="content/img/redEmpty.svg" alt="arrow"></div> ';
                                } ?>

                            
                            <a class="commentLinkButton" href="comment/<?php echo $arr['ID'];  ?>" ><div class="comment_button">COMMENTS</div></a>
                    </div>
    </div>
<?php }   ?>
























