<?php
namespace src\utility;

use \src\model;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\utility ;
use \src\controller\helpers;


class indexPageUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
    private $model;
 

    function __construct($input){
        parent::__construct();
       $this->model = new model\postModel();
       $this->helper = new helpers\helpers();
    }


    function get($arr){
        $this->username = "555";
        $this->loggedIn = true;
        //return $arr;
        if($arr['sortType'] == "hot"){
            return $this->model->hotPosts((int)$arr['limit'],$this->loggedIn,$this->username,$arr['search'],$arr['thread'],$arr['status'],"");
        }else if($arr['sortType'] == "top"){
            return $this->model->topPosts((int)$arr['limit'],$this->loggedIn,$this->username,$arr['search'],$arr['thread'],$arr['status'],1,$arr['interval']);

        }else if($arr['sortType'] == "new"){
            return $this->model->newPosts((int)$arr['limit'],$this->loggedIn,$this->username,$arr['search'],$arr['thread'],$arr['status'],"");
        }








        return $arr;
        $result = "";
        if((int)$arr['ID']){
            $result = array($this->model->getSinglePost($arr['ID'],$this->username)[0]);

            return $result;
        }
        //print_r($arr);
        if($arr['sort'] == "hot"){
            $result =  $this->model->getHotPosts( (int)$arr['grab'],$this->loggedIn,$this->username,$arr['search'],$arr['cat'],$arr['voteType'],1);

        }elseif($arr['sort'] == "top") {
            $result =  $this->model->getTopPosts( (int)$arr['grab'],$this->loggedIn,$this->username,$arr['search'],$arr['cat'],$arr['voteType'],$arr['topType']);

        }elseif($arr['sort'] == "new") {
            $result =  $this->model->getNewPoststest( (int)$arr['grab'],$this->loggedIn,$this->username,$arr['search'],$arr['cat'],$arr['voteType'],$arr['topType']);

        }
        /*
        if($arr['cat'] != ""){
            $this->view->pageData['metaData']['title']      =  $arr['cat'];
            if($arr['sort'] == "new"){
                $result =  $this->model->getNewPostsCategory($arr['cat'], (int)$arr['grab'],$this->loggedIn,$this->username,$arr['search']);

            }else{
                $result = $this->model->getPopularPostsCategory($arr['cat'], (int)$arr['grab'],$this->loggedIn,$this->username,$arr['search']);

            }
        }else{
            if($arr['sort'] == "new"){
               // echo "ddd";
               $result = $this->model->getNewPosts((int)$arr['grab'],$this->loggedIn,$this->username,$arr['search']);
         
            }else{
                $result = $this->model->getPopularPosts((int)$arr['grab'],$this->loggedIn,$this->username,$arr['search']);

            }
           
        //   print_r($result);
            
        }*/
       return $result;
    }

/*
    function runScript(){
        $this->output =  array($this->model->getSinglePost($this->postID,$this->username)[0]);
        return $this->generatePosts());  

    }
    function generatePosts(){
        //echo json_encode(array("flag" => true));
        //echo sizeof($this->output);
        ob_start();
            require "view/index/posts.php";
        $html = ob_get_clean();

        return array( "content" => $html);

    }
    

*/


    
    function generatePosts($result){
        $this->output = $result;
        ob_start();
            
            require "view/index/posts.php";
        $html = ob_get_clean();
        $flag = (sizeof($result) < 10  ) ? true : false ; 
        return array("flag" => $flag, "content" => $html); 

    }

    function post($arr){
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
        }elseif(!is_numeric($arr['category']) || $arr['category'] == 0 ){
            return array("flag" => false, "message" => "Wrong category");
            
            return false;
        }
       
     $date = $arr['year']."-".$arr['month']."-".$arr['day'];

    $flag = $this->model->createPost($arr['title'], $arr['text'],$this->username,$date,$arr['category']);
             //print_r($_POST);
  
        return array("flag" => true, "message" => $flag );
        

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
        }elseif(!is_numeric($arr['category']) || $arr['category'] == 0 ){
            return array("flag" => false, "message" => "Wrong category");
            
            return false;
        }
       
     $date = $arr['year']."-".$arr['month']."-".$arr['day'];
     $flag =  $this->model->editPost($arr['title'], $arr['text'],$arr['ID'],$arr['category']);
     //print_r($_POST);
  
        return array("flag" => true, "message" => $flag ? "Something went wrong" : "Change successful" );
        


    }
    function delete(){
        
    }

    
    function runScript(){
        
    }
    
}



?>