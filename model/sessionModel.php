<?php 
namespace src\model;
class sessionModel{

    function __construct(){
        session_start();
    }

    function userSetVar($username){
        session_start();
        $_SESSION['user'] = $username;
        $_SESSION['adm']  = 1;
    }

    function destroySession(){
        
        $_SESSION = array();
        $_COOKIE  = array();
        session_destroy();
        //header('Location: /');
        
    }





}

?>