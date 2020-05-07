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

    function runScript()
    {
       
    }

    
}



?>