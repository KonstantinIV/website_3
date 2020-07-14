<?php
namespace src\controller;
use \src\interfaces ;
use \src\controller ;
use \src\model;

class ThreadController extends controller\MainController { 
    
  

    function get($arr){       

        $this->setResult( 
            $this->model->getThreads(
                $this->userSession->getUsername()
                )
        );
        return true;
    }
    function post($arr){
       if(
           $this->model->postThread(
               $this->userSession->getUsername(),
               $arr['threadTitle'],
               $arr['threadDescription']
            )
        ){
            return true;
        }
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 422
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