<?php 
class routerController{
    private $url;
    private $controller;
    private $method;
    public $param;

   function __construct($url){
        $this->url = $url;
    }


    function parseUrl(){
        
        $urlArr = explode("/" ,$this->url);
        
        $this->controller = $urlArr[0];
        $this->param = "";

         if($this->controller == "profile"){
            $this->controller = "profileController";
        }else if($this->controller == "editUtil"){
            $this->controller = "editUtility";
        }else if($this->controller == "edit"){

            //$this->controller = "editController(".$this->method.")";
            $this->controller = "editController";
            $this->param = ( isset($urlArr[1])) ? $urlArr[1] : "";
        }else if($this->controller == "comment"){
            $this->controller = "commentController";
            $this->param = $urlArr[1];
        }else if($this->controller == "login"){
            $this->controller = "loginController";
        }else if($this->controller == "logout"){
            $this->controller = "logOutController";
        }else if($this->controller == "loginU" ){
            $this->controller = "loginUtility";
        }else if($this->controller == "nextPagePlease" ){
            $this->controller = "indexPageUtility";
        }else if($this->controller == "login" && $this->method == "register" ){
            loginController::register();
        }else if(!preg_match('/^[a-z]+/', $this->controller) || $this->controller == "" ||  !file_exists('controller/'.$this->controller.'Controller.php') || $this->controller == "index"){
            
            $this->param = $this->controller;
            $this->controller = "indexController";
        }
        
        //$this->method = $urlArr[1];
        //$this->params =  array_slice($urlArr, 2);
        
    }
    





    
    function retController(){
        return $this->controller;
    }
    function retMethod(){
        return $this->method;
    }
    function retParams(){
        return $this->params;
    }

}


?>


