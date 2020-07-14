<?php
namespace src\controller;
use \src\controller\interfaces ;
use \src\controller ;

class logoutController extends controller\MainController { 
    
   

    function get($arr)
    {
        session_start();
        $_SESSION = array();
        //unset($_COOKIE['PHPSESSID']); 
        session_destroy();

                return array( "flag" => true); 
            

    }

    function post($arr){
         
    }
    function delete($arr){
         
    }
    function put($arr){
         
    }

    
}



?>