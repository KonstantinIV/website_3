<?php 
namespace src\core;

class Router{
    
    private $urlArr = array();
    private $directory = "\\src\\controller\\";
    private $scriptType = "Controller";
  

   function __construct($url){

       $this->urlArr = explode("/" ,$url);
    }

    function validateUrl(){ 
           
         
        if(empty($this->urlArr)){
           
            return false;
            
            
        }else{
              
            foreach($this->urlArr as $value){
                
                if(!preg_match('/^[a-zA-Z0-9]+/', $value)){
                    
                    return false;
                    
                }
            }
        }

        
        if(!$this->checkFileExist($this->urlArr[0])){
            
            return false;
        }
        
        return true;    
    }


  

    function checkFileExist($filename){
        //print_r("                 saas".ROOT."controller/pageController/".$filename."Controller.php");
       if(file_exists(ROOT."controller/".$filename."Controller.php")){
            $this->directory = "\\src\\controller\\";
            $this->scriptType = "Controller";
            return true;
        }
        //print_r($this->urlArr);
        return false;
       
    }

    function setControllerPath(){
        return $this->directory.$this->urlArr[0].$this->scriptType;
       
    }


    function setParam(){
        if(empty($this->urlArr[0])){
            return "";
        }else{
            return array_slice($this->urlArr, 0);
        }
        
    }

    function getScriptType(){
        return $this->scriptType;
    }

    function getModelName(){
        return $this->urlArr[0];
    }






}


?>


