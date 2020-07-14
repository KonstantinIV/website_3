<?php
namespace src\utility;
use \src\controller\interfaces ;
use \src\utility ;
use \src\model;

class userUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
   
    function __construct($input){
        parent::__construct();
        $this->model = new model\userModel();
     
    }

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

    function runScript()
    {
       
    }

    
}



?>