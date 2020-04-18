<?php
namespace src\utility;
use src\model;
use \src\utility ;
use \src\controller\core;


class mainLoginUtility extends utility\mainUtility{
    protected $model;

    protected $view;
    protected $sessionModel;

    function __construct(){
        //parent::__construct();
        $this->model = new model\loginModel();
        $this->view  = new core\viewController();

    }

    function startSession($username){
        $this->sessionModel = new model\sessionModel();

        $this->sessionModel->userSetVar($username);
    }
    
}



?>