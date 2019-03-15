<?php
class loginUtility extends mainLoginUtility{


    function __construct($data){
        parent::__construct();
        $this->model->data = $_POST['dict'];
        $this->model->userAuth();
        $this->startSession();
        
    }

    function getUserExists(){
        return $this->model->errorCode;
    }

    function startSession(){
        $session = new sessionModel();
        $session->userSetVar($this->model->data['username']);
    }

    
}



?>