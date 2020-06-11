<?php
namespace src\controller;
use src\model;
use src\controller;
use \src\interfaces ;


class registerUController extends controller\mainLoginController implements interfaces\ControllerInterface{
    
 


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

      

        
    }



    
    function delete($arr){
         
    }
    function put($arr){
         
    }
    



    
}



?>