<?php

/*
foreach($i = 0; $i < 3; $i++){
        if($id[i] = $parent_id[i] ){
            if($id[$i] == $parent_id[$id_pos] && $i == 0){
            echo "stop";
        }else
        }
    }*/



function rec($id_pos){
    $id        = array(1, 2, 3,4,5,6,7,8);
    $parent_id = array(NULL, 1, 2,3,3,3,3,1);
    echo $id[$id_pos];
    for($i = 0; $i < 7; $i++){
        if($parent_id[$i] == $id[$id_pos]){
            rec($i);
        }
    
        
    }

}
echo rec(0);




?>
