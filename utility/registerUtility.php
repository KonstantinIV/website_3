<?php
namespace src\utility;
use src\model;
use src\controller;
use \src\controller\interfaces ;

class registerUtility extends mainLoginUtility implements interfaces\utilityInterface{
    
    private $username;
    private $password;
    private $email   ;

    private $birthday;
    private $joinDate;



    function __construct($input){
        ///echo "ssssssssssssssdd";
        parent::__construct();
        $this->username = isset($_POST['user'])   ?  $_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  $_POST['pass']    : false  ;
        $this->email    =  isset($_POST['email']) ?  $_POST['email']    : false  ;
        

    }

    function runScript(){
        if($this->username && $this->password && $this->email){
            if($this->userCreate()){
                $this->startSession($this->username);

                echo json_encode(array( "flag" => true)); 

            }else{
                echo json_encode(array( "flag" => false)); 
            }
        }else{
            echo json_encode(array( "flag" => false)); 
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