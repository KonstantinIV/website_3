<?php 
namespace src\controller\core;
use \src\controller\pageController;
use \src\controller\interfaces;
class bootstrap {

    private $controller;
    private $view;
    private $router;
    private $url;
    private $reqMethod = false;

   function __construct(){
    $this->url    =    !(isset($_GET['url'])) ? "" : $_GET['url']; 
   // print_r($_GET['url']);
    $this->reqMethod =  $_SERVER['REQUEST_METHOD'];
    $this->router = new routerController($this->url);
        
   }

    function initController(){
       
        if($this->router->validateUrl()){
            $controllerPath = $this->router->setControllerPath();
            $params         = $this->router->setParam();
                        
            $this->controller = new $controllerPath($params);

        }else{
            
            $this->controller = new pageController\indexController($this->router->setParam());

        }

        
        

    }

   

    function loadContent(){
        //print_r($this->controller->view->pageData);
    if($this->controller instanceof interfaces\pageInterface){
        $this->controller->loadPage();
    }elseif($this->controller instanceof interfaces\utilityInterface){
       //$this->controller->runScript();
       $arr = "";
       if($this->reqMethod == "GET"){
        $arr = $_GET;
       }elseif ($this->reqMethod == "POST") {
        $arr = $_POST;
       }elseif ($this->reqMethod == "DELETE") {
        parse_str(file_get_contents('php://input'), $arr);
       }elseif ($this->reqMethod == "PUT") {
        parse_str(file_get_contents('php://input'), $arr);
       }
       //print_r(${'$_'.$this->reqMethod} );

       $result = $this->controller->{$this->reqMethod}($arr );

       $this->view  = new viewController();
      
       $this->view->renderUtilJSON($result ); 

    }

   /* function initDefault(){
        $this->controller = new pageController\indexController("");
    }*/

   




}







}







?>
