<?php
namespace src\utility;
use src\model;


class mainLoginUtility {
    protected $model;

    function __construct(){
        $this->model = new model\loginModel();
    }

    function startSession($username){
        $session = new model\sessionModel();
        $session->userSetVar($username);
    }
    
}



?>