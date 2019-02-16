<?php 
session_start();
if(isset($_SESSION['user'])){
    echo "dumbass";
}
echo $_SESSION['user'];

//session_destroy();


?>