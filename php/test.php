<?php

/*
foreach($i = 0; $i < 3; $i++){
        if($id[i] = $parent_id[i] ){
            if($id[$i] == $parent_id[$id_pos] && $i == 0){
            echo "stop";
        }else
        }
    }*/



function rec($id_pos,$space){
    $id        = array(1   , 2, 3,4,5,65,7,8,9,10);
    $parent_id = array(NULL, 1, 2,3,3,3,3,1,1,1);

    /* echo result */
    for($i = 0; $i <= $space; $i++){
        echo "*";
    }
    echo $id[$id_pos];
    echo "<br>";
    /***************/


    /*core*/
    for($i = 0; $i < 10; $i++){
        if($parent_id[$i] == $id[$id_pos]){
            rec($i,$space+1);
        }
    }
   

}
rec(0,0);




?>
