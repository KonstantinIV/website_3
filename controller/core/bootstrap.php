<?php 
namespace src\controller\core;
use \src\controller\pageController;
use \src\controller\interfaces;
class bootstrap {

    private $controller;
    private $router;
    private $url;

    private $reqMethod;

   function __construct(){
    $this->url    =    !(isset($_GET['url'])) ? "" : $_GET['url']; 
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
       $this->controller->{$this->reqMethod}($_GET);
    }

   /* function initDefault(){
        $this->controller = new pageController\indexController("");
    }*/

   




}







}







?>
