<?php 
class bootstrap {

    private $controller;
    private $router

    function autoload(){

    }




    function setControllerName($url){
        $this->router = new core\routerController($url);
        
        if($this->router->validateUrl()){
            
            $this->initController($this->router->setControllerName()) ;
            
        }else{
            $this->initDefault();
        }
        

    }

    function initController($controllerName){
        $this->controller = new $controllerName;
    }

    function loadContent(){

    }

    function initDefault(){
        $this->controller = new pageController\indexController("");
    }

   




}















?>