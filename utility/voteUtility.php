<?php
namespace src\utility;

use \src\model;
use \src\controller\interfaces ;

class voteUtility implements interfaces\utilityInterface{
    private $model;
    private $session;

    private $username;
    private $ID;
    private $action;
    private $type;
    private $update;

    function __construct($data){
        $this->model = new model\postModel();
        $this->session = new model\sessionModel();

        $this->username = isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->ID   = isset($_POST['ID']) ? (int)$_POST['ID'] : false; 
        $this->action   =  isset($_POST['action']) ? $_POST['action'] : false; 
        $this->type   =  isset($_POST['type']) ? $_POST['type'] : false; 
        $this->update   =  isset($_POST['update']) ? $_POST['update'] : false; 
     //  echo $this->username;
        //$this->model->likePost((int)$_POST['ID'],$_SESSION['user']);
       // echo $this->update;
      // echo gettype($this->update). "\n";
    }


    function runScript(){
        $this->success($this->vote());
    }

    function vote(){
        if(is_int($this->ID)  && $this->username && $this->action === "likes" || $this->action === "dislikes" && $this->type === "comment" || $this->type === "post"){
           
                if($this->type ==  "comment"){
                    if($this->update == "true"){


                    if(!$this->model->voteExistsComment($this->username,$this->ID,$this->action)){
                        $this->model->voteComment($this->ID, $this->username, $this->action);
                        //echo $this->ID. " ". $this->username . " ". $this->action;
                        return true;
                    }else {
                        return false;
                    }
                }elseif($this->update == "false"){
                    if($this->model->voteExistsComment($this->username,$this->ID,$this->action)){
                     
                        $this->model->unvoteComment($this->ID, $this->username, $this->action);
                        //echo $this->ID. " ". $this->username . " ". $this->action;
                        return true;
                    }else {
                        return false;
                    }
                }


                }else if($this->type == "post"){
                    
                    if($this->update == "true"){
                        
                        if(!$this->model->voteExistsPost($this->username,$this->ID,$this->action)){

                            $this->model->votePost($this->ID, $this->username, $this->action);
                            
                            return true;
                        }else{
        
                                return false;
                            }

                    }elseif($this->update == "false"){
                       
                        if($this->model->voteExistsPost($this->username,$this->ID,$this->action)){
                            
                            $this->model->unvotePost($this->ID, $this->username, $this->action);
                            
                            return true;
                        }else{
        
                                return false;
                            }

                    }else{
                        return false;
                    }
                        
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