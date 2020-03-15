<?php
namespace src\utility;
use \src\controller\interfaces ;

use src\model;
use \src\utility ;

class loginUserUtility extends utility\mainLoginUtility implements interfaces\utilityInterface{


    function __construct($input){
        parent::__construct();
        
      
    }





    function runScript(){
        
  
       
        
    }
    function get($arr){
        if (!$this->model->usernameValidation((string)$arr['username'])) {
            return array( "flag" => false , "message" => "Invalid username"); 

        }elseif (!$this->model->passwordValidation($arr['password'])){
            return array( "flag" => false , "message" => "Invalid password"); 
        }elseif (!$this->model->userAuth((string)$arr['username'],$arr['password'])) {
            return array( "flag" => false , "message" => "Could not authenticate"); 
        }
        $this->startSession((string)$arr['username']);
        return array( "flag" => true , "user" => (string)$arr['username']); 


       
       
        
    }

    
   

    
}



?>