<?php
namespace src\controller;

use \src\controller\interfaces ;
use src\model;
use \src\controller ;

class CommentController extends controller\MainController {
    
    


    function get($arr){
        $this->setResult(  
            $this->model->getComments(
                $arr["postID"],
                $this->userSession->getUsername()
            )
        );
        return true;
       
        
       
    }
    function post($arr){
        if($this->validation->validateComment($arr)){

        
        $id = $this->model->postComment($arr['postID'], $arr['parentID'], $this->userSession->getUsername(), $arr['text']);

        if(!$id){
            $this->setErrorMessage(
                $this->getErrorMessage(
                    $code = 422
                    )
            );
            return false;
        }else{
            $this->setResult($id);
            return true; 
        }
        }else{
            $this->setErrorMessage(
                $this->validation->getErrorMessage()
           );
           return false;
        }
    }


    function put($arr){
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

 
  
    
    

}



?>