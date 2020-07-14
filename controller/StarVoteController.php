<?php
namespace src\controller;

use \src\model;
use \src\controller ;
use \src\interfaces ;

class StarVoteController extends controller\MainController {
    
    

  


    function post($arr){

        if(!$this->validation->validateStarVote($arr)){
            $this->setErrorMessage(
                $this->validation->getErrorMessage()
           );
           $this->setHttpCode(
            422
            );
            return false;
        }


        if(!$this->model->checkStarVoteDate($arr["ID"])){
            $this->setErrorMessage(
               "Release date is not passed yet"
            );
            $this->setHttpCode(
                422
                );
                return false;
            return array("flag" => false, "voted" => true, "message" => "Error");

        }



        if($this->model->checkStarVoteExists($arr["ID"],$this->userSession->getUsername())){
           if( !$this->model->replaceStarVote($arr["ID"],$arr["points"], $this->userSession->getUsername())){

                $this->setErrorMessage(
                    $this->getErrorMessage(
                        $code = 422
                        )
                );
                $this->setHttpCode(
                    422
                    );
                return false;
                return array("flag" => false, "voted" => true, "message" => "Error");

            }
            return true;  
            
        }else{
            if(!$this->model->starVote($arr["ID"],$arr['points'], $this->userSession->getUsername())){
                $this->setErrorMessage(
                    $this->getErrorMessage(
                        $code = 422
                        )
                );
                $this->setHttpCode(
                    422
                    );
                return false;
                return array("flag" => false, "voted" => true, "message" => "Error");        
            }

        }

            return true;
        return array("flag" =>  true, "voted" => false);        


        
    }
    
    function delete($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        $this->setHttpCode(
            405
            );
        return false;
        

       


       
    }
    


    


    function get($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        $this->setHttpCode(
            405
            );
        return false;
    }
 

       
       
   
    function put($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        $this->setHttpCode(
            405
            );
        return false;
    }



    
}



?>