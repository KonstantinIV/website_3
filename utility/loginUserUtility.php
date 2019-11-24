<?php
namespace src\utility;
use \src\controller\interfaces ;

use src\model;
use \src\utility ;

class loginUserUtility extends utility\mainLoginUtility implements interfaces\utilityInterface{
    private $password;
    protected $username;

    function __construct($input){
        parent::__construct();
        
        $this->username = isset($_POST['user'])   ?  (string)$_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  (string)$_POST['pass']    : false  ;
        

      
        //print_r($this->model->inputData);
    }

    function runScript(){
        
        if($this->model->usernameValidation($this->username) && $this->model->passwordValidation($this->password)){
            
            if($this->model->userAuth($this->username,$this->password)){
                $this->startSession($this->username);
                $this->view->renderUtilJSON(array( "flag" => true , "user" => $this->username)); 
                
            }else{
                
                $this->view->renderUtilJSON(array( "flag" => false)); 
            }
        }else{
            $this->view->renderUtilJSON(array( "flag" => false)); 

        }

       
        
    }
    

    function getUserExists(){
        return $this->model->errorCode;
    }

   

    
}



?>