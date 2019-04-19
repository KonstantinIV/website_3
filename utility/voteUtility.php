<?php
namespace src\utility;

use \src\model;
use \src\controller\interfaces ;

class voteUtility implements interfaces\utilityInterface{
    private $model;
    private $session;

    private $username;
    private $postID;
    private $action;


    function __construct($data){
        $this->model = new model\postModel();
        $this->session = new model\sessionModel();

        $this->username = isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->postID   = isset($_POST['postID']) ? (int)$_POST['postID'] : false; 
        $this->action   =  isset($_POST['action']) ? $_POST['action'] : false; 
     //  echo $this->username;
        //$this->model->likePost((int)$_POST['postID'],$_SESSION['user']);
      

    }


    function runScript(){
        $this->success($this->vote());
    }

    function vote(){
        if(is_int($this->postID)  && $this->username && $this->action === "likes" || $this->action === "dislikes"){
            if(!$this->model->voteExists($this->username,$this->postID,$this->action)){
                $this->model->votePost($this->postID, $this->username, $this->action);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
       

    }

    function success($message){
        if($message){
            echo json_encode(array("message" => true));
        }else{
            echo json_encode(array("message" => false));
        }

    }

   

    

       
    



    
}



?>