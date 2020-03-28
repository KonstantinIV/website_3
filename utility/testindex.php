<?php
namespace src\utility;

use \src\model;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\utility ;
use \src\controller\helpers;


class testindexUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
    private $model;
 

    function __construct($input){
        parent::__construct();
       $this->model = new model\postModel();
       $this->helper = new helpers\helpers();
    }


    function get($arr){
      
       return "test";
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