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
        return array("flag" => $this->model->followingUser($_SESSION['user'],$arr['username']));
        
       
    }
    function post($arr){
        return array("flag" => $this->model->followUser($_SESSION['user'],$arr['username']));
    }
    function put($arr){
         
    }
    function delete($arr){
        return array("flag" => $this->model->unfollowUser($_SESSION['user'],$arr['username']));
    }


    


    

}



?>