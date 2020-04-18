<?php
namespace src\utility;
use src\model;
use src\controller;
use \src\controller\interfaces ;
use \src\utility ;

class registerUUtility extends utility\mainLoginUtility implements interfaces\utilityInterface{
    
 


    function __construct($input){
        parent::__construct();
   

    }

    function get($arr){
        if($arr['method'] == 'userVal'){
            $flag = $this->model->usernameExists((string)$arr['username']);
            return array( "flag" => (bool)$flag); 
            

        }elseif($arr['method'] == 'emailVal'){
            if(!$this->model->emailValidation($arr['email'])){
                return array( "flag" => (bool)false, "message" => "Non valid email");
                

            }elseif(!$this->model->emailVerification($arr['email'])){
                return array( "flag" => (bool)false, "message" => "Email exists");

              
            }else{
                return array( "flag" => true, "message" => "true");

              
            }
            
            
        }

      
    }









    function post($arr){

        if(!$arr['username'] && !$arr['password'] && !$arr['email']){
            return array( "flag" => false, "message" => "Empty field"); 
        }elseif (!$this->model->usernameExists((string)$arr['username']) == true) {
            return array( "flag" => false, "message" => "Username exists"); 
        } elseif(!$this->model->usernameValidation((string)$arr['username'])) {
            return array( "flag" => false, "message" => "Username contains invalid characters"); 
        }elseif(!$this->model->passwordValidation((string)$arr['password'])) {
            return array( "flag" => false, "message" => "Password is too short"); 
        }elseif(!$this->model->emailValidation( (string)$arr['email'])) {
            return array( "flag" => false, "message" => "Email is invalid"); 
        }

        $password = $this->model->encryptPass($arr['password']);
        if(!$this->model->userCreate($arr['username'], $password,  $arr['email'])){

            return array( "flag" => false, "message" => "Something went wrong"); 
        } 
        
        $this->startSession($arr['username']);
        return array( "flag" => true); 


        
    }



    function runScript(){

    }

       
    



    
}



?>