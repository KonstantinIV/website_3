<?php
namespace src\utility;
use \src\controller\interfaces ;
use \src\utility ;

class isloggedUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
   
    function __construct($input){
        parent::__construct();

     
    }


    function runScript()
    {
        session_start();
            if(isset($_SESSION['user'])){
                $this->view->renderUtilJSON(array( "flag" => true)); 
            }else{
                $this->view->renderUtilJSON(array( "flag" => false)); 
            }
    }

    
}



?>