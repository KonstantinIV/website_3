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
        //$this->sessionModel = new model\sessionModel();
        $this->view  = new viewController();
       

        if($modelName != ""){
            $modelName = '\\src\\model\\'.$modelName;
            $this->model = new $modelName;
           
        }
        //echo $_SESSION['user'] ."dsfdgfedsgdffgd";
        $this->input =  $input;
        $this->view->pageData['metaData']['loggedIn'] =  isset($_SESSION['user']) ? true : false;
        $this->view->pageData['metaData']['title'] = $title;
        $this->view->pageData['metaData']['body']  = $body; 

       $this->view->pageData['metaData']['sortLinkPopular'] = "/hot/";
       $this->view->pageData['metaData']['sortLinkNew'] = "/new/";
        

        
        
        
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

    function ajaxCall(){
        
    }




}


?>
