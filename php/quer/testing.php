<?php
try{
    $p = array("d");
    echo $p[2];
}catch(Exception $e){
 echo $e;
 echo $e->getMessage();
 throw new Exception("Value must be 1 or below");
}



?>