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
    $id        = array( 2,1, 3,4,5,65,7,8,9,10);
    $parent_id = array( 1, NULL, 2,3,3,3,3,1,1,1);

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







echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


function rec2($id_pos,$space){
    $key       = array(1 => NULL, 2 => 1, 3 => 2, 4 => 3, 5 => 3, 65 => 3 , 7 => 3, 8 => 1 , 9 => 1 , 10 => 1,11 => NULL);
    /* echo result */
    for($i = 0; $i <= $space; $i++){
        echo "*";
    }
    echo $id_pos;
    echo "<br>";
    /***************/


    /*core*/
    foreach($key as $id => $parent_id){
        if($parent_id == $id_pos){
            rec2($id,$space+1);
        }
    }


   

}
rec2(NULL,-1);
?>
