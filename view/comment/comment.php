<div class="comment_section">
<?php



foreach($this->commentData as $id => $array){
    $this->commentData[$id]['createdDateText'] = $this->helper->time_elapsed_string($array["createdDate"]);
    
}
//print_r($this->commentData);

$color = 0;
function rec2($id_pos,$space,$key) {
    global $color;
        if($color ==0){
                $color = 1;
        }else{
                $color = 0;  
        }
        $flag = 0;
        foreach($key as $id => $parent_id){
            if($parent_id['parent_id'] == $id_pos){
                if($id_pos == 0 ){
                    echo "<br>";
            }


                $flag = 1;
                $inte = 20*$space;
                if($color == 1){     
                    ?>
                        <div class="comment" comment-id = "<?php echo $id;  ?>" style="margin-left:<?php echo $inte ;?>px;background-color: #22143c;border: 3px solid #36274b;">
                    <?php
                }else{
                    ?>
                        <div class="comment" comment-id = "<?php echo $id;  ?>" style="margin-left:<?php echo $inte ;?>px;">
                    <?php    
                } 
                    ?>

                    <div class="comment_user">
                    <div class="user">
                        <a href="profile/<?php echo $parent_id['username'] ;?>"><?php echo $parent_id['username'] ;?></a>
                    </div>
                    &#9679
                    <div class="comment_date" date='<?php echo $parent_id['createdDate']; ?>'>
                        <?php echo $parent_id['createdDateText']; ?>
                    </div>
                     </div>
                   
                   
                   
                   
                    <div class="comment_text"><?php echo $parent_id['text'] ;?></div>
                            <div class="comment_buttons">
                            <?php  if($parent_id['livoted'] == 1){
                                echo  '<div class="comment_like_button full" id="clikeButton"><img class="likeImage" src="content/img/greenFull.svg"></div> ';
                                }elseif($parent_id['livoted'] == 0){
                                        echo ' <div class="comment_like_button " id="clikeButton"><img class="likeImage" src="content/img/greenEmpty.svg"></div>  ';
                                }else{
                                        echo ' <div class="comment_like_button " id="clikeButton"><img class="likeImage" src="content/img/greenEmpty.svg"></div>  ';
                                } ?>



                                    <div class="comment_di_li_cont">
                                            <div class="comment_likes"><?php echo $parent_id['likes'] ;?></div>
                                            <div class="">&#9679</div>
                                            <div class="comment_dislikes"><?php echo $parent_id['dislikes'] ;?></div>
                                    </div>        
                                    <?php  if($parent_id['divoted'] == 1){
                                                echo  '<div class="comment_dislike_button full" id="cdislikeButton"><img class="dislikeImage" src="content/img/redFull.svg"></div> ';
                                                }elseif($parent_id['divoted'] == 0){
                                                        echo ' <div class="comment_dislike_button" id="cdislikeButton"><img class="dislikeImage" src="content/img/redEmpty.svg"></div>';
                                                }else{
                                                        echo ' <div class="comment_dislike_button" id="cdislikeButton"><img class="dislikeImage" src="content/img/redEmpty.svg"></div>';
                                                } ?>
                                    
                                    <div class="comment_comment_button" id="replyComment">REPLY &#10095;</div>
                            </div>
                    </div>

                <?php

                rec2($id,$space+1,$key);
            }
        }
        
    
       
       
    
    }
    rec2(0,0,$this->commentData);









?>
</div>
