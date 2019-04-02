<?php
namespace src\controller\core;
use src\model;
class mainController{

    protected $view;
    protected $model;
    protected $sessionModel;

    protected $loggedin;
    protected $input;
    protected $output;
 


    function __construct($modelName,$title, $body, $input){
        
        $this->view  = new viewController();
        $this->sessionModel = new model\sessionModel();

        if($modelName != ""){
            $modelName = '\\src\\model\\'.$modelName;
            $this->model = new $modelName;
           
        }

        $this->input =  $input;
        $this->view->pageData['metaData']['loggedIn'] =  isset($_SESSION['user']) ? true : false;
        $this->view->pageData['metaData']['title'] = $title;
        $this->view->pageData['metaData']['body']  = $body; 


        
        
        
    }























    function setPageDataVariables($title, $body,$input ){
        $this->pageData['metaData']['title'] = $title;
        $this->pageData['metaData']['body']  = $body; 
       
        $this->pageData['inputData'] =  $input;

    }

    function setModelInputData($key, $data){
        $this->model->inputData[$key]    = $data ;

    }

    function renderView(){
        $this->view->pageData = $this->pageData;

        $this->view->render()           ;
    }




}


?>
