<?php
namespace src\utility;

use \src\model;
use \src\utility ;
use \src\controller\interfaces ;

class voteUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;

    private $ID;
    private $action;
    private $type;
    private $update;

    function __construct($data){
        parent::__construct();
        $this->model = new model\postModel();

        $this->ID   = isset($_POST['ID']) ? (int)$_POST['ID'] : false; 
        $this->action   =  isset($_POST['action']) ? $_POST['action'] : false; 
        $this->type   =  isset($_POST['type']) ? $_POST['type'] : false; 
        $this->update   =  isset($_POST['update']) ? $_POST['update'] : false; 
     
    }


    function runScript(){
        $this->success($this->vote());
    }

    function vote(){
        if(!$this->username){
            return false;
        }

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

    function success($bool){
        if($bool){
            $this->view->renderUtilJSON(array("message" => true));

        }else{
            $this->view->renderUtilJSON(array("message" => true));

        }

    }

   

    

       
    



    
}



?>