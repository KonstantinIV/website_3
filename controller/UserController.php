<?php
namespace src\controller;
use \src\interfaces ;
use \src\controller ;
use \src\model;

class UserController extends controller\MainController { 
    
   
  

    function get($arr)
    {       
        $userStats = array( 
            "joinDate" => "",
            "totalLikes"  => 0,
            "totalPosts"  => 0,
            "totalComments" => 0
        );
         $userStats["joinDate"] = $this->model->userJoinDate($arr['user']);
         $userStats["totalLikesReceived"] = $this->model->userTotalLikesReceived($arr['user']);
         $userStats["totalPosts"] = $this->model->userTotalPosts($arr['user']);
         $userStats["totalComments"] = $this->model->userTotalComments($arr['user']);
            return $userStats;

    }

    function put($arr){
        if($arr['change'] == "pass"){
            if($arr['password1'] !== $arr['password2'] ){
                return array( "flag" => false, "message" => "Passwords do not match"); 
            }
            if (!$this->model->passwordValidation($arr['password1']) || !$this->model->passwordValidation($arr['password2']) || !$this->model->passwordValidation($arr['oldPassword'])){
                return array( "flag" => false , "message" => "Non valid password"); 
            }
            if(!$this->model->userAuth($_SESSION['user'],$arr['oldPassword'])){
                return array( "flag" => false, "message" => "Wrong password"); 
            }
            
            
            return $this->model->replacePassword($_SESSION['user'],$this->model->encryptPass((string)$arr['password1']));
        }
        if(!$this->model->emailValidation( (string)$arr['email'])) {
            return array( "flag" => false, "message" => "Invalid email"); 
        }
        return $this->model->replaceEmail($_SESSION['user'],(string)$arr['email']);




    }

 
    function post($arr){

        if(!$arr['username'] && !$arr['password'] && !$arr['email']){
            return array( "flag" => false, "message" => "Empty field"); 
        }elseif (!$this->model->usernameExists((string)$arr['username']) == true) {
            return array( "flag" => false, "message" => "Username exists"); 
        } elseif(!$this->model->usernameValidation((string)$arr['username'])) {
            return array( "flag" => false, "message" => "Username contains invalid characters"); 
        }elseif(!$this->model->passwordValidation((string)$arr['password'])) {
            return array( "flag" => false, "message" => "Password is too short"); 
        }elseif(!$this->model->emailValidation( (string)$arr['email'])) {
            return array( "flag" => false, "message" => "Email is invalid"); 
        }

        $password = $this->model->encryptPass($arr['password']);
        if(!$this->model->userCreate($arr['username'], $password,  $arr['email'])){

            return array( "flag" => false, "message" => "Something went wrong"); 
        } 
        
        $this->startSession($arr['username']);
        return array( "flag" => true); 


        
    }

    function delete($arr){
         
    }
   
    
}



?>