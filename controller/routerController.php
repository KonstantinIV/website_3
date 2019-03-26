<?php 
namespace src\controller;

class routerController{
    private $url;
    private $urlArr;
    private $controller;
    public $param = "";

   function __construct(){
        $this->urlArr = $this->parseUrl();
        $this->setControllerName();
        $this->setParam();

    }

    function parseUrl(){
        //print_r($_GET['url']);
        //if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->url = $_GET['url'];
            print_r($_GET['url']);
        
        //}
        if($this->url == "" ){
            return "index";
        }else{
            $urlArr = explode("/" ,$this->url);
            foreach($urlArr as $value){
                if(!preg_match('/^[a-zA-Z0-9]+/', $value)){
                    return "index";
                }
            }
            return $urlArr;
        }
    }


    function setControllerName(){
        $filename    = $this->urlArr[0];
       
        if(file_exists("controller/".$filename."Controller.php") || empty($this->urlArr)){
            echo "ttt";
            $this->controller = "controller\\".$filename."Controller";
            $this->param = $this->urlArr[1];
        }else if(file_exists("utility/".$filename."Utility.php")){
            echo"ssssssssssssssss";
            $this->controller = "utility\\".$filename."Utility";
           
        }else if($filename == "cat"){
            $this->controller = "controller\\indexController";
            $this->param = $this->urlArr[1];
        }else{
            echo "ttt";
            $this->controller = "controller\\indexController";
            //$this->param = $this->urlArr[0];
        }
    }

    function setParam(){
        /*if(empty($this->param)){
            $this->param = array_slice($this->urlArr, 1);
        }else{
            $this->param = "";
        }*/
        
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


