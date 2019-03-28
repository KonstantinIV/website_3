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
            $this->initController() ;
            $controllerPath = $this->router->setControllerPath();
            $this->controller = new $controllerPath($this->router->setParams());

        }else{
            $this->controller = new pageController\indexController("");
        }

        
        

    }

   

    function loadContent(){
      $this->controller->loadBody() ;
    }

   /* function initDefault(){
        $this->controller = new pageController\indexController("");
    }*/

   




}















?>