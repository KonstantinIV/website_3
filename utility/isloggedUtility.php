<?php
namespace src\utility;
use \src\controller\interfaces ;
use \src\utility ;

class isloggedUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
   
    function __construct($input){
        parent::__construct();

     
    }

    function get($arr)
    {
        session_start();
            if(isset($_SESSION['user'])){
                return array( "flag" => true); 
            }else{
                return array( "flag" => false); 
            }
    }

    function runScript()
    {
        session_start();
            if(isset($_SESSION['user'])){
                return array( "flag" => true); 
            }else{
                return array( "flag" => false); 
            }
    }

    
}



?>