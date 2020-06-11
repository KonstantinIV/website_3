<?php
namespace src\controller;

use \src\controller\interfaces ;
use src\model;
use \src\controller ;

class CommentController extends controller\MainController {
    
    private $text;
    private $ID;
    private $postID;


    function get($arr){
        return  $this->model->getComments($arr["postID"],$this->username);
        
       
    }
    function post($arr){
        if(!$this->username){
            return array( "flag" => false ,"message" => "not authorized"); 
        }
        $id = $this->model->postComment($arr['postID'], $arr['parentID'], $this->username, $arr['text']);
        if(!$id){
            return array( "flag" => false ,"message" => "something went wrong"); 
        }
        return array( "flag" => true , "commentID" => $id); 
    }
    function put($arr){
        $id = $this->model->editComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }
    function delete($arr){
        $id = $this->model->editComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }

 
  
    
    

}



?>