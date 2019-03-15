<?php
class mainController{

    protected $view;
    protected $model;
    protected $sessionModel;
    protected $param;

    function __construct($modelName,$param){
        $this->param  = $param;
        $this->view  = new viewController();
        if($modelName != ""){
            $this->model = new $modelName;

        }
        $this->sessionModel = new sessionModel();
        
    }

    
}


?>
