<?php
namespace src\controller;
use src\model;
class mainController{

    protected $view;
    protected $model;
    protected $sessionModel;
    protected $param;

    function __construct($modelName,$param){
        $this->param  = $param;
        $this->view  = new viewController();
        if($modelName != ""){
            $modelName = '\\src\\model\\'.$modelName;
            
            $this->model = new $modelName;
            //$this->model = new model\postModel();
        }
        $this->sessionModel = new model\sessionModel();
        
    }

    
}


?>
