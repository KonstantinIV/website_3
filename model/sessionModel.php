<?php 
class sessionModel{

    function __construct(){
        session_start();
    }

    function userSetVar($username){
        
        $_SESSION['user'] = $username;
        $_SESSION['adm']  = 1;
    }



}

?>