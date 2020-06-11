<?php
namespace src\controller;
use \src\controller\interfaces ;
use \src\controller ;

class isloggedController extends controller\MainController { 
    
   
  

    function get($arr)
    {       
            session_start();
            if(isset($_SESSION['user']) ){
                return array( "flag" => true , "username" => $_SESSION['user']); 
            }else{
                $_SESSION = array();
                //unset($_COOKIE['PHPSESSID']); 
                session_destroy();
                return array( "flag" => false); 
            }

    }
    function post($arr){
         
    }
    function delete($arr){
         
    }
    function put($arr){
         
    }

   

    
}



?>