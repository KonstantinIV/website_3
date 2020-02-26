<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;
use \src\utility ;

class commentutilityUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $ID;
    private $postID;


    function __construct($data){
        parent::__construct();

        $this->model = new model\commentModel();


       
    }
    function get($arr){
        $id = $this->model->editComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }
    function post($arr){
        $id = $this->model->postComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }
    function put($arr){
        $id = $this->model->editComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }
    function delete($arr){
        $id = $this->model->editComment($arr['postID'], $arr['commentParentID'], $this->username, $arr['text']);
        return array( "username" => $this->username, "commentID" => $id); 
    }

 
function runScript(){
    
}
    


    

}



?>