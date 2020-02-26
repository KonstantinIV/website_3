<?php
namespace src\utility;

use \src\model;
use \src\utility ;
use \src\controller\interfaces ;

class starVoteUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;

    

    function __construct($data){
        parent::__construct();
        $this->model = new model\postModel();

    }


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
            return false;
        }
        if($this->model->checkStarVoteExists($arr["ID"],$this->username)){
            return false;
        }

        if(!$this->model->starVote($arr["ID"],$arr['points'],$this->username)){
            return false;
        }
        return true;

        
    }
    
    function delete($arr){

        

       


       
    }
    


    


    function get(){

    }
   

    function runScript(){
        
    }

       
       
    



    
}



?>