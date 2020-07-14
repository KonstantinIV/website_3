<?php
namespace src\controller;
use src\model;
use \src\controller ;
use \src\core;


class mainLoginController extends controller\MainController{
    protected $model;

    protected $view;
    protected $sessionModel;

    function __construct(){
        //parent::__construct();
        $this->model = new model\userModel();
        $this->view  = new core\viewController();

    }

    function startSession($username){
        $this->sessionModel = new model\sessionModel();

        $this->sessionModel->userSetVar($username);
    }
    
}



?>