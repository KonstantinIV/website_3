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
        parent::__construct();
        $this->username = isset($_POST['user'])   ?  $_POST['user']  : false  ;
        $this->password =  isset($_POST['pass'])  ?  $_POST['pass']    : false  ;
        $this->email    =  isset($_POST['email']) ?  $_POST['email']    : false  ;
        

    }

    function runScript(){
        if($this->username && $this->password && $this->email){
            $this->userCreate();
        }else{

        }
        
    }

    function userCreate(){


        
        if($this->model->userExists() == true){
            if($this->model->userValidate() == true){
                if($this->model->userCreate() == true){
                    return true;
                } 
            }   
        }
        return $this->model->errorCode;
            
        

       
    }


    

       
    



    
}



?>