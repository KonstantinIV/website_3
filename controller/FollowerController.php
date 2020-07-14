<?php
namespace src\controller;

use \src\controller\interfaces ;
use \src\model;
use \src\controller ;

class FollowerController extends controller\MainController{
  
    private $text;
    private $ID;
    private $postID;


  
    function get($arr){
        $this->setResult( 
            $this->model->followingUser(
                $this->userSession->getUsername(),
                $arr['username']
            )
        );

       return true;
    }
    function post($arr){

        $this->setResult( 
            $this->model->followUser(
                $this->userSession->getUsername(),
                $arr['username']
            )
        );
        return true;
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
         $this->setResult( 
            $this->model->unfollowUser(
                $this->userSession->getUsername(),
                $arr['username']
            )
        );
        return true;
    }
    }


    


    

}



?>