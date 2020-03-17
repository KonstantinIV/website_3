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
       /* if(is_int($arr["ID"])  && $arr["voteType"] === "likes" || $arr["voteType"] === "dislikes" && $arr["postType"] === "comment" || $arr["postType"] === "post"){
            return true;
        }*/
        return true;
    }


    function post($arr){
      

        /* if(!$this->validateData($arr)){
            return false; 
         }
*/
         $this->username = "555";
        if($arr["postType"] ==  "comment"){

            if(!$this->model->voteExistsComment($this->username,$arr["ID"],$arr["voteType"])){
                $this->model->voteComment($arr["ID"], $this->username, $arr["voteType"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["voteType"];
                return true;
            }else {
                return false;
            }
        }elseif($arr["postType"] ==  "post"){
            if(!$this->model->voteExistsPost($this->username,$arr["ID"],$arr["voteType"])){
                $this->model->votePost($arr["ID"], $this->username, $arr["voteType"]);
                return true;
            }else{
    
                    return false;
                }
        }
        
        return false;



        
    }
    
    function delete($arr){

        

       /* if(!$this->validateData($arr)){
            return false; 
         }
*/$this->username = "555";
        if($arr["postType"] ==  "comment"){
            if($this->model->voteExistsComment($this->username,$arr["ID"],$arr["voteType"])){
                     
                $this->model->unvoteComment($arr["ID"], $this->username, $arr["voteType"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["voteType"];
                return true;
            }else {
                return false;
            }
        }elseif($arr["postType"] ==  "post"){

            if($this->model->voteExistsPost($this->username,$arr["ID"],$arr["voteType"])){

                $this->model->unvotePost($arr["ID"], $this->username, $arr["voteType"]);
                
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