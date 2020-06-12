<?php
namespace src\controller;

use \src\controller ;

class SessionController extends controller\MainController { 
    
   
  

    function get($arr){       
        $this->setResult(  
                $this->userSession->isAuthenticated()
        );
        return true;
    }
    function post($arr){
        if (!$this->model->usernameValidation((string)$arr['username'])) {
            return array( "flag" => false , "message" => "Invalid username or password"); 

        }elseif (!$this->model->passwordValidation($arr['password'])){
            return array( "flag" => false , "message" => "Invalid username or password"); 
        }elseif (!$this->model->userAuth((string)$arr['username'],$arr['password'])) {
            return array( "flag" => false , "message" => "Could not authenticate"); 
        }
        $this->startSession((string)$arr['username']);
        return array( "flag" => true , "user" => (string)$arr['username']); 




        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }
    function delete($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }
    function put($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }

   

    
}



?>