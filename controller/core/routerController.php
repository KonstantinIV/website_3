<?php 
namespace src\controller\core;

class routerController{
    
    private $urlArr;
    private $directory = "\\src\\controller\\pageController\\";
    private $scriptType = "Controller";
  

   function __construct($url){

       $this->urlArr = explode("/" ,$url);
    }

    function validateUrl(){ 
           
         
        if(empty($this->urlArr)){
           
            return false;
            return "index";
            
        }else{
              
            foreach($this->urlArr as $value){
                
                if(!preg_match('/^[a-zA-Z0-9]+/', $value)){
                    
                    return false;
                    
                    return "index";
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
        if(file_exists(ROOT."controller/pageController/".$filename."Controller.php")){
            
            return true;
        }elseif(file_exists(ROOT."utility/".$filename."Utility.php")){
            $this->directory = "\\src\\utility\\";
            $this->scriptType = "Utility";
            return true;
        }
        print_r($this->urlArr);
        return false;
       
    }

    function setControllerPath(){
        return $this->directory.$this->urlArr[0].$this->scriptType;
       
    }


    function setParam(){
        if(empty($this->urlArr[1])){
            return "";
        }else{
            return array_slice($this->urlArr, 1);
        }
        
    }

    function getScriptType(){
        return $this->scriptType;
    }







}


?>


