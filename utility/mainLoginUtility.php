<?php
namespace src\utility;
use src\model;
use src\controller;


class mainLoginUtility {
    protected $model;

    function __construct(){
        $this->model = new model\loginModel();
    }
    
}



?>