<?php
namespace src\controller;

use \src\controller ;

class SessionController extends controller\MainController { 
    
   
  

    function get($arr){       
        $this->setResult(  
                array("isLoggedIn" => $this->userSession->isAuthenticated(),
                      "username"   => $this->userSession->getUsername()
                        )
        );
        return true;
    }
    function post($arr){
        if(!$this->model->userExists($arr['username'])){
            $this->setErrorMessage(
                "Wrong username or password"
            );
            $this->setHttpCode(
                401
            );
            return false;
        }
        if(!$this->model->checkPassword($arr['username'],$arr['password'])){
            $this->setErrorMessage(
                "Wrong username or password"
            );
            $this->setHttpCode(
                401
            );
            return false;
        }
        $this->userSession->setUsername($arr['username']);

        return true;
    }
    function delete($arr){
            $this->userSession->deleteSession();
            return true;
        }


    
    function put($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        $this->setHttpCode(
            405
        );
        return false;
    }

   

    
}



?>