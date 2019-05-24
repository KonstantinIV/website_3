<?php
namespace src\utility;
use \src\controller\interfaces ;

use src\model;

class loginUserUtility extends mainLoginUtility implements interfaces\utilityInterface{
    private $username;
    private $password;
    

    function __construct($input){
        parent::__construct();
        $this->username = isset($_POST['user'])   ?  $_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  $_POST['pass']    : false  ;
   

      
        //print_r($this->model->inputData);
    }

    function runScript(){
       // echo $this->method;
        



        if($this->model->userAuth($this->username,$this->password)){
            $this->startSession($this->username);
            echo json_encode(array( "flag" => true , "user" => $this->username)); 
        }else{
            
            echo json_encode(array( "flag" => false)); 
        }
        
    }
    

    function getUserExists(){
        return $this->model->errorCode;
    }

   

    
}



?>