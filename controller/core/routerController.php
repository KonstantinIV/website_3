<?php 
namespace src\controller\core;

class routerController{
    
    private $urlArr;
    private $directory;
    private $controller;
    //private $ajaxRequest = false;
    
    public $param = "";


   function __construct($url){
        $this->url = $url;

        $this->directory = false;
       

    }

    function validateUrl(){
        //print_r($_GET['url']);
        //if($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            print_r($_GET['url']);
        
        //}
        if(empty($this->url)){
            return false;
            return "index";
            
        }else{
            $this->urlArr = explode("/" ,$this->url);
            foreach($this->urlArr as $value){
                if(!preg_match('/^[a-zA-Z0-9]+/', $value)){
                    return false;
                    return "index";
                }
            }

            
            return true
            return $urlArr;
        }
    }


    function setControllerName(){
        $filename    = $this->urlArr[0];

        if($this->checkFileExist()){

        }


       
        if(file_exists(__DIR__."/controller/pageController/".$filename."Controller.php")){
            echo "ttt";
            $this->controller = "controller\\pageController\\".$filename."Controller";
            $this->param = $this->urlArr[1];
        }else if(file_exists("utility/".$filename."Utility.php")){
            echo"ssssssssssssssss";
            $this->controller = "utility\\".$filename."Utility";
           
        }else if($filename == "cat"){
            $this->controller = "controller\\indexController";
            $this->param = $this->urlArr[1];
        }else{
            echo "ttt";
            $this->controller = "controller\\pageController\\indexController";
            //$this->param = $this->urlArr[0];
        }
    }

    function checkFileExist($filename){
        if(file_exists(__DIR__."/controller/pageController/".$filename."Controller.php")){
            return true;
        }elseif(file_exists(__DIR__."/utility/pageController/".$filename."Controller.php"))){
            return true;
        }
       
    }





    function setParam(){
        /*if(empty($this->param)){
            $this->param = array_slice($this->urlArr, 1);
        }else{
            $this->param = "";
        }*/
        
    }





    
    function getControllerName(){
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


