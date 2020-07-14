<?php
namespace src\controller;

use \src\model;
use \src\controller ;
use \src\interfaces ;

class VoteController extends controller\MainController {
    


  

    function post($arr){
      

        if($arr["postType"] ==  "comment"){

            if(!$this->model->voteExistsComment($this->userSession->getUsername(),$arr["ID"],$arr["voteType"])){
                $this->model->voteComment($arr["ID"], $this->userSession->getUsername(), $arr["voteType"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["voteType"];
                $this->setHttpCode(
                    200
                );
                return true;
            }else {
                $this->setErrorMessage(
                    $this->getErrorMessage(
                        "Vote exists"
                        )
                );
                $this->setHttpCode(
                    422
                );
                return false;
            }
        }elseif($arr["postType"] ==  "post"){
            if(!$this->model->voteExistsPost($this->userSession->getUsername(),$arr["ID"],$arr["voteType"])){
                $this->model->votePost($arr["ID"], $this->userSession->getUsername(), $arr["voteType"]);
                $this->setHttpCode(
                    200
                );
                return true;
            }else{
    
                $this->setErrorMessage( "Vote exists"
                    
                );
                $this->setHttpCode(
                    422
                );
                return false;
                }
        }
        
        $this->setErrorMessage(
            "Invalid type"
        );
        $this->setHttpCode(
            422
        );
        return false;
        


        
    }
    
    function delete($arr){



        if($arr["postType"] ==  "comment"){
            if($this->model->voteExistsComment($this->userSession->getUsername(),$arr["ID"],$arr["voteType"])){
                     
                $this->model->unvoteComment($arr["ID"], $this->userSession->getUsername(), $arr["voteType"]);
                //echo $arr["ID"]. " ". $this->username . " ". $arr["voteType"];
                $this->setHttpCode(
                    200
                );
                return true;
            }else {
                $this->setErrorMessage(
                    "Vote does not exists"
                );
                return false;
            }
        }elseif($arr["postType"] ==  "post"){

            if($this->model->voteExistsPost($this->userSession->getUsername(),$arr["ID"],$arr["voteType"])){

                $this->model->unvotePost($arr["ID"], $this->userSession->getUsername(), $arr["voteType"]);
                $this->setHttpCode(
                    200
                );
                return true;
            }else{
    
                $this->setErrorMessage(
                   "Vote does not exists"
                );
                return false;
                }
        }
        $this->setErrorMessage(
            "Invalid type"
        );
        $this->setHttpCode(
            422
        );
        return false;



       
    }
    


    


    function get($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }
   

    function put($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }

       
       
    



    
}



?>