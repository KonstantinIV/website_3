<div class="comment_section">
<?php



//$key = $profile->getCommentid($id);



function rec2($id_pos,$space,$key,$color){
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
                        <div class="comment" style="margin-left:<?php echo $inte ;?>px;background-color: transparent;border: 3px solid #36274b;">
                    <?php
                }else{
                    ?>
                        <div class="comment" style="margin-left:<?php echo $inte ;?>px;">
                    <?php    
                } 
                    ?>

                    <div class="comment_user"><div class="user">User</div>&#9679<div class="comment_date">5 hours ago</div></div>
                    <div class="comment_text"><?php echo $parent_id['text'] ;?></div>
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
                    </div>

                <?php

                rec2($id,$space+1,$key,$color);
            }
        }
        
    
       
       
    
    }
    rec2(0,0,$this->output['commentData'],0);









?>
</div>
