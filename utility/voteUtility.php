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

    }


    function validateData($arr){

        if(!$this->username){

            return false;
        }
       /* if(is_int($arr["ID"])  && $arr["action"] === "likes" || $arr["action"] === "dislikes" && $arr["type"] === "comment" || $arr["type"] === "post"){
            return true;
        }*/
        return true;
    }


    function post($arr){
      

        if(!$this->validateData($arr)){
           return false; 
        }
        if($arr["type"] ==  "comment"){

            if(!$this->model->voteExistsComment($this->username,$arr["ID"],$arr["action"])){
                $this->model->voteComment($arr["ID"], $this->username, $arr["action"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["action"];
                return true;
            }else {
                return false;
            }
        }elseif($arr["type"] ==  "post"){
            if(!$this->model->voteExistsPost($this->username,$arr["ID"],$arr["action"])){
                $this->model->votePost($arr["ID"], $this->username, $arr["action"]);
                return true;
            }else{
    
                    return false;
                }
        }
        
        return false;



        
    }
    
    function delete($arr){

        

        if(!$this->validateData($arr)){
            return false; 
         }

        if($arr["type"] ==  "comment"){
            if($this->model->voteExistsComment($this->username,$arr["ID"],$arr["action"])){
                     
                $this->model->unvoteComment($arr["ID"], $this->username, $arr["action"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["action"];
                return true;
            }else {
                return false;
            }
        }elseif($arr["type"] ==  "post"){

            if($this->model->voteExistsPost($this->username,$arr["ID"],$arr["action"])){

                $this->model->unvotePost($arr["ID"], $this->username, $arr["action"]);
                
                return true;
            }else{
    
                    return false;
                }
        }
       return false;



       
    }
    


    


    function get(){

    }
   

    function runScript(){
        
    }

       
       
    



    
}



?>