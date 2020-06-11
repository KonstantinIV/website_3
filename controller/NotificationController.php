<?php
namespace src\controller;

use \src\interfaces ;
use src\model;
use \src\controller ;

class NotificationController extends controller\MainController {
    
    private $text;
    private $ID;
    private $postID;


    
    function get($arr){
        
        $result =  $this->model->userFollowMessages($_SESSION['user']);
        $this->model->readUserFollowMessages($_SESSION['user']);
        return $result;
    }
    function post($arr){
       // return array("flag" => $this->model->followUser($_SESSION['user'],$arr['username']));
    }
    function put($arr){
         
    }
    function delete($arr){
    //    return array("flag" => $this->model->unfollowUser($_SESSION['user'],$arr['username']));
    }

 



    

}



?>