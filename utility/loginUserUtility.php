<?php
namespace src\utility;
use \src\controller\interfaces ;

use src\model;

class loginUserUtility extends mainLoginUtility implements interfaces\utilityInterface{


    function __construct($input){
        parent::__construct();
        $this->model->inputData = $_POST['dict'];
        $this->model->userAuth();
        $this->startSession();
        print_r($this->model->inputData);
    }

    function runScript(){
       
    }

    function getUserExists(){
        return $this->model->errorCode;
    }

    function startSession(){
        $session = new model\sessionModel();
        $session->userSetVar($this->model->inputData['username']);
    }

    
}



?>