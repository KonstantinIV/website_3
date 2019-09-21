<?php
namespace src\utility;
use src\model;
use \src\utility ;


class mainLoginUtility extends utility\mainUtility{
    protected $model;

    function __construct(){
        parent::__construct();
        $this->model = new model\loginModel();
    }

    function startSession($username){
        $this->sessionModel->userSetVar($username);
    }
    
}



?>