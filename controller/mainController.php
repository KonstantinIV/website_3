<?php
namespace src\controller;
use src\model;
class mainController{

    protected $view;
    protected $model;



    protected $sessionModel;
    protected $param;


    public $pageData = array( 
        "metaData" => array(
            "title" => "",
            "body" => "",
            "loggedIn" => false),
         "inputData" => "",
         "outputData" => ""
);

    function __construct($modelName){
        
        $this->view  = new viewController();
        $this->sessionModel = new model\sessionModel();
        
        if($modelName != ""){
            $modelName = '\\src\\model\\'.$modelName;
            $this->model = new $modelName;
           
        }
        
    }




    function setPageDataVariables($title, $body,$input ){
        $this->pageData['metaData']['title'] = $title;
        $this->pageData['metaData']['body']  = $body; 
        $this->pageData['metaData']['loggedIn'] =   isset($_SESSION['user']) ? true : false;
        $this->pageData['inputData'] =  $input;

    }

    function setModelInputData(){
        $this->model->inputData['categoryName']    = $this->pageData['inputData'];

    }

    function renderView(){
        $this->view->pageData = $this->pageData;

        $this->view->render()           ;
    }




}


?>
