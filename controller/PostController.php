<?php
namespace src\controller;

use \src\model;
use \src\core;
use \src\interfaces;
use \src\controller;




class PostController extends controller\MainController{ 
    
    

     function get($arr){
        
    
        if($arr['sortType'] == "hot"){

            $this->setResult(  
                $this->model->hotPosts(
                    (int)$arr['limit'],
                    $this->userSession->getUsername(),
                    $arr['search'],
                    $arr['thread'],
                    $arr['status'],
                    ""
                ));
            return true;


        }else if($arr['sortType'] == "top"){

            $this->setResult(  
                $this->model->topPosts(
                    (int)$arr['limit'],
                    $this->userSession->getUsername(),
                    $arr['search'],
                    $arr['thread'],
                    $arr['status'],
                    $topType = 1,
                    $arr['interval']
                ));
                return true;

        }else if($arr['sortType'] == "new"){
            $this->setResult(  
                $this->model->newPosts(
                    (int)$arr['limit'],
                    $this->userSession->getUsername(),
                    $arr['search'],
                    $arr['thread'],
                    $arr['status'],
                    ""
                ));
                return true;
        }
        //Single post
        if($arr['postID']){
            $this->setResult( 
                $this->model->getPost(
                    $this->userSession->getUsername(),
                    $arr['postID']
                    
                ));
                return true;
        }

        //Profile
        if($arr['profile'] == 1){
            $this->setResult( 
                $this->model->userPosts(
                    $this->userSession->getUsername(),
                    (int)$arr['limit']
                ));
                return true;
        }


        $this->setErrorMessage( 
            $this->getErrorMessage(
                $code = 422
                )
        );

        return false;



    }




    function post($arr){
        
    if($this->validation->validatePost($arr)){

       if( $this->model->createPost(
            $arr['title'], 
            $arr['text'],
            $this->userSession->getUsername(),
            $date,
            $arr['thread']
        )){
            return true;
        }else{
            $this->setErrorMessage(
                $code = 422
             );
            return false;
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
        if($this->model->deletePost($arr['postID'],$this->userSession->getUsername())){
            return true;
        }else{
            $this->setErrorMessage(
                $code = 422
             );
            return false;
        }
       
    }

   
    
}



?>