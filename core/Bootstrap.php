<?php 
namespace src\core;

use \src\interfaces;
use \src\model;
use \src\controller;
use \src\validation;

class Bootstrap {

    private $validReqMethods = ["GET","POST","DELETE","PUT"];
    private $authroziedMethods = ["POST","DELETE","PUT"];
    private $reqMethod ;
    private $queryParams;

    private $controller;
    private $view;
    private $router;
    private $userSession;

   function __construct(Router $router, UserSession $userSession, View $view, $reqMethod){
   
    $this->reqMethod = $reqMethod;
    $this->queryParams = $queryParams;

    $this->router = $router;
    $this->userSession = $userSession;
    $this->view  = $view;

   }

    function setController(){
       
        if($this->router->validateUrl()){
            $controllerPath = $this->router->setControllerPath();
            $params         = $this->router->setParam();
             $modelPath    =        "\\src\\model\\".$this->router->getModelName()."Model";     
             //echo $controllerPath;
             $model       = new $modelPath;
            $this->controller = new $controllerPath($model , $this->userSession, new validation\Validation());

        }


    }

    private function isInstanceOfController( $controller){
        if($controller instanceof controller\MainController){
            return true;
        }
        return false;
    }

    private function getQueryParams(){
        if($this->reqMethod == "GET"){
            return $_GET;
        }else{
            $queryParams = "";
            parse_str( file_get_contents("php://input"), $queryParams);
            return $queryParams;
        }

    }

 

    function loadContent(){
       
    if(!$this->isInstanceOfController($this->controller)){
       return false; 

    }
    if(!$this->validateReqMethod($this->reqMethod)){
        return false;
    }
    if(!$this->userSession->authorizedReqMethod($this->reqMethod)){
        return false;
    }

    
    
   
   if( $this->controller->{$this->reqMethod}( $this->getQueryParams() )){
        $this->view->returnJSON($this->controller->getResult() );
   }else{
        $this->view->returnJSON($this->controller->getErrorMessage() );
   }

    

 
   




}
private function validateReqMethod($method){
    foreach($this->validReqMethods as $validReqMethod){
        if($method === $validReqMethod){
            return true;
        }
    }
    return false;
}







}







?>
