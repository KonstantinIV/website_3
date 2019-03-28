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
 


    public $pageData = array( 
        "metaData" => array(
            "title" => "",
            "body" => "",
            "loggedIn" => false),
         "inputData" => "",
         "outputData" => ""
);

    function __construct($modelName,$title, $body, $input){
        
        $this->view  = new viewController();
        $this->sessionModel = new model\sessionModel();

        if($modelName != ""){
            $modelName = '\\src\\model\\'.$modelName;
            $this->model = new $modelName;
           
        }

        
        $this->loggedin =  isset($_SESSION['user']) ? true : false;
        $this->pageData['metaData']['title'] = $title;
        $this->pageData['metaData']['body']  = $body; 
        $this->input =  $input;
        
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
