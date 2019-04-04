<?php 
namespace src\controller\core;
use \src\controller\pageController;
class bootstrap {

    private $controller;
    private $router;

   function __construct(){
    $this->router = new routerController($_GET['url']);
        
   }




    function initController(){
       
        if($this->router->validateUrl()){
           // print_r($this->urlArr);
                        $controllerPath = $this->router->setControllerPath();
                        $params         = $this->router->setParam();
                        
            $this->controller = new $controllerPath($params);
            
        }else{
            
            $this->controller = new pageController\indexController("");
        }

        
        

    }

   

    function loadContent(){
        //print_r($this->controller->view->pageData);
    if($this->router->getScriptType() == "Controller"){
        $this->controller->loadPage() ;
    }
     
    }

   /* function initDefault(){
        $this->controller = new pageController\indexController("");
    }*/

   




}















?>