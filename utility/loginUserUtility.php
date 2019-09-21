<?php
namespace src\utility;
use \src\controller\interfaces ;

use src\model;
use \src\utility ;

class loginUserUtility extends utility\mainLoginUtility implements interfaces\utilityInterface{
    private $password;
    

    function __construct($input){
        parent::__construct();
        $this->username = isset($_POST['user'])   ?  $_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  $_POST['pass']    : false  ;
   

      
        //print_r($this->model->inputData);
    }

    function runScript(){

        if($this->model->userAuth($this->username,$this->password)){
            $this->startSession($this->username);
            $this->view->renderUtilJSON(array( "flag" => true , "user" => $this->username)); 
        }else{
            
            $this->view->renderUtilJSON(array( "flag" => false)); 
        }
        
    }
    

    function getUserExists(){
        return $this->model->errorCode;
    }

   

    
}



?>