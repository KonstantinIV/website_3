<?php
namespace src\controller;

use \src\model;
use \src\controller ;
use \src\interfaces ;

class StarVoteController extends controller\MainController {
    
    

  

    function validateData($arr){
        if($arr["points"] > 5 || $arr["points"] < 0){
            return false;
        }elseif($this->username){
            return false;
        }else{
            return true;
        }
      
    }


    function post($arr){
       
      //print_r($arr);
        if($this->validateData($arr)){
            return array("flag" => false, "voted" => true,"message" => "username");
        }
        if(!$this->model->checkStarVoteDate($arr["ID"])){
            return array("flag" => false, "voted" => true, "message" => "Error");

        }
        if($this->model->checkStarVoteExists($arr["ID"],$this->username)){
           if( !$this->model->replaceStarVote($arr["ID"],$arr["points"],$this->username)){
            return array("flag" => false, "voted" => true, "message" => "Error");

            }
            return array("flag" =>  true, "voted" => true);  
            
        }else{
            if(!$this->model->starVote($arr["ID"],$arr['points'],$this->username)){
                return array("flag" => false, "voted" => true, "message" => "Error");        
            }

        }

        
        return array("flag" =>  true, "voted" => false);        


        
    }
    
    function delete($arr){

        

       


       
    }
    


    


    function get(){

    }
 

       
       
   
    function put($arr){
         
    }



    
}



?>