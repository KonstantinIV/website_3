<?php
namespace src\controller;
use \src\interfaces ;
use \src\controller ;
use \src\model;

class UserController extends controller\MainController { 
    
   
  

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
         $this->setResult( 
            $userStats
        );
        return true;

    }

    function put($arr){
        if($arr['change'] == "pass"){

            if($arr['password1'] !== $arr['password2'] ){
                $this->setErrorMessage(
                   "Passwords do not match"
                );
                return false;
            }
            if (!$this->model->passwordValidation($arr['password1']) ){
                $this->setErrorMessage(
                    "Non valid password"
                 );
                 return false;
            }
            if(!$this->model->userAuth($this->userSession->getUsername(),$arr['oldPassword'])){
                $this->setErrorMessage(
                    "Wrong password"
                 );
                 return false;
            }
            
            
            if( !$this->model->replacePassword($this->userSession->getUsername(),$this->model->encryptPass((string)$arr['password1']))){
                $this->setErrorMessage(
                    "Something went wrong"
                 );
                return false;
            }


            return true;

        }
        if($arr['change'] == "email"){
            if(!$this->model->emailValidation( (string)$arr['email'])) {
                $this->setErrorMessage(
                    "Invalid email"
                 );
                return false;
                
            }
            if( !$this->model->replaceEmail($this->userSession->getUsername(),(string)$arr['email'])){
                $this->setErrorMessage(
                    "Could not replace email"
                 );
                return false;
            }
            return true;
        }
        
        $this->setErrorMessage(
            "Invalid"
         );
        return false;
        



    }

 
    function post($arr){
        if($this->validation->validateUser($arr)){
            $this->setErrorMessage(
                $this->validation->getErrorMessage()
           );
           return false;
        }
        
           
        if (!$this->model->usernameExists((string)$arr['username']) == true) {
            $this->setErrorMessage(
                "Username exists"
             );
            return false;
        } elseif (!$this->model->emailExists((string)$arr['email']) == true) {
            $this->setErrorMessage(
                "Email exists"
             );
            return false; 
        } 
        

        $password = $this->model->encryptPass($arr['password']);

        if(!$this->model->userCreate($arr['username'], $password,  $arr['email'])){

            $this->setErrorMessage(
                "Something went wrong"
             );
            return false;  
        } 
        
        
        return true;


        
    }

    function delete($arr){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }
   
    
}



?>