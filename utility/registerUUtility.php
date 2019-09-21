<?php
namespace src\utility;
use src\model;
use src\controller;
use \src\controller\interfaces ;
use \src\utility ;

class registerUUtility extends mainLoginUtility implements interfaces\utilityInterface{
    
    private $username;
    private $password;
    private $email   ;

    private $birthday;
    private $joinDate;
    private $method;


    function __construct($input){
        parent::__construct();
        $this->method   = empty($input[1])   ?  false  : $input[1]  ;

        $this->username = isset($_POST['user'])   ?  $_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  $_POST['pass']    : false  ;
        $this->email    =  isset($_POST['email']) ?  $_POST['email']    : false  ;
        

    }

    function runScript(){
        if($this->method == 'userVal'){
            $flag = $this->model->usernameVerification($this->username);
            $this->view->renderUtilJSON(array( "flag" => (bool)$flag)); 
            

            return false;
        }elseif($this->method == 'emailVal'){
            if(!$this->model->emailValidation($this->email)){
                $this->view->renderUtilJSON(array( "flag" => (bool)false, "message" => "Non valid email"));
                

            }elseif(!$this->model->emailVerification($this->email)){
                $this->view->renderUtilJSON(array( "flag" => (bool)false, "message" => "Email exists"));

              
            }else{
                $this->view->renderUtilJSON(array( "flag" => true, "message" => "true"));

              
            }
            
            
            return false;
        }






        if($this->username && $this->password && $this->email){
            if($this->userCreate()){
                $this->startSession($this->username);

                $this->view->renderUtilJSON(array( "flag" => true)); 

            }else{
                $this->view->renderUtilJSON(array( "flag" => false, "message" => "Failed to create user")); 
            }
        }else{
            $this->view->renderUtilJSON(array( "flag" => false,"message" => "One of fields are invalid")); 
        }
        
    }

    function userCreate(){


        if($this->model->usernameVerification($this->username) == true){
           
            if($this->model->usernameValidation($this->username) && $this->model->passwordValidation($this->password) && $this->model->emailValidation($this->email) ){
                
                if($this->model->userCreate($this->username, $this->password, $this->email) == true){
                   
                    return true;
                } 
            }   
        }
        return false;
            
        

       
    }


    

       
    



    
}



?>