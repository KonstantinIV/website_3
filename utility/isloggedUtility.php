<?php
namespace src\utility;
use \src\controller\interfaces ;

class isloggedUtility implements interfaces\utilityInterface{ 
    
   
    function __construct($inpu){
       
     
    }


    function runScript()
    {
        session_start();
            if(isset($_SESSION['user'])){
                    echo json_encode(array( "flag" => true)); 
            }else{
                    echo json_encode(array( "flag" => false)); 
            }
    }

    
}



?>