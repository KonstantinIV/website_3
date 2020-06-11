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

        if($arr['postID']){
            $this->setResult( 
                $this->model->getPost(
                    $arr['postID'],
                    $this->userSession->getUsername()
                ));
                return true;
        }


        if($arr['profile'] == 1){
            $this->setResult( 
                $this->model->userPosts(
                    $this->userSession->getUsername(),
                    (int)$arr['limit']
                ));
                return true;
        }



    }




    function post($arr){
        
    if($this->validation->validatePost($arr)){
        return $this->model->createPost($arr['title'], $arr['text'],$this->username,$date,$arr['thread']);
    }else{
        $this->setErrorMessage(
            $this->validation->getErrorMessage()
        );
        return false;
    }
     

        

    }
    function put($arr){
        if($arr['text'] == "" ){
            return array("flag" => false, "message" => "Wrong text");
           
            return false;
        }elseif($arr['title'] == ""){
            return array("flag" => false, "message" => "Wrong title");
           
            return false;
        }elseif(!is_numeric($arr['day'])){
            return array("flag" => false, "message" => "Wrong day");
           
            return false;
        }elseif(!is_numeric($arr['month'])){
            return array("flag" => false, "message" => "Wrong month");
            
            return false;
        }elseif(!is_numeric($arr['year'])){
            return array("flag" => false, "message" => "Wrong year");
            
            return false;
        }elseif(!is_numeric($arr['thread']) || $arr['thread'] == 0 ){
            return array("flag" => false, "message" => "Wrong thread");
            
            return false;
        }
       
     $date = $arr['year']."-".$arr['month']."-".$arr['day'];
     $flag =  $this->model->editPost($arr['title'], $arr['text'],$arr['ID'],$arr['thread']);
     //print_r($_POST);
  
        return array("flag" => true, "message" => $flag ? "Something went wrong" : "Change successful" );
        


    }
    function delete($arr){
        
        if(!$_SESSION['user']){
            return  array("flag" => false, "message" => "Unathorized"); 
        }
        $result = $this->model->deletePost($arr['postID'],$_SESSION['user']);
        return array("flag" => $result); 
    }

   
    
}



?>