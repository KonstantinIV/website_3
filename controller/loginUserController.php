<?php
namespace src\controller;
use \src\controller\interfaces ;

use src\model;
use \src\controller ;

class loginUserController extends controller\MainController {


   





    function get($arr){
        if (!$this->model->usernameValidation((string)$arr['username'])) {
            return array( "flag" => false , "message" => "Invalid username or password"); 

        }elseif (!$this->model->passwordValidation($arr['password'])){
            return array( "flag" => false , "message" => "Invalid username or password"); 
        }elseif (!$this->model->userAuth((string)$arr['username'],$arr['password'])) {
            return array( "flag" => false , "message" => "Could not authenticate"); 
        }
        $this->startSession((string)$arr['username']);
        return array( "flag" => true , "user" => (string)$arr['username']); 


       
       
        
    }

    function post($arr){
         
    }
    function delete($arr){
         
    }
    function put($arr){
         
    }
    
   

    
}



?>