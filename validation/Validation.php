<?php
namespace src\validation;



 class Validation { 

    protected $errors = array( 
        1 => "Invalid title",
        2 => "Invalid text",
        3 => "Invalid date",
        4 => "Day of the release is already passed",
        
       

    );
    protected $errorMessage; 

    
    protected function validatePost($params){
        if(!$this->isValidPostTitleLength($params['title'])){
            $this->setErrorMessage(1);
            return false;
        }else if(!$this->isValidPostTextLength($params['text'])){
            $this->setErrorMessage(2);
            return false;
        }else if(!$this->isValidRealeaseDate($params['year'],$params['month'],$params['day'])){
            $this->setErrorMessage(3);
            return false;
        }else if(!$this->isRealeaseDatePast($params['year']."-".$params['month']."-".$params['day'])){
            $this->setErrorMessage(4);
            return false;
        }
        return true;
    }

    protected function isValidPostTextLength($text){
        if(strlen($title) > 18000){
            return false;
        }
        return true;
    }
  

    protected function isValidPostTitleLength($title){
        if(strlen($title) > 200){
            return false;
        }
        return true;
    }

    protected function isValidRealeaseDate($year,$month,$day){
        if(!checkdate($year,$month,$day)){
            return false;
        }
        return true;
    }
    protected function isRealeaseDatePast($date){
        if(gmdate("Y-m-d") > $date){
            return false;
        }
        return true;
    }

    protected function setErrorMesssage($errorCode){
       
        $this->errorMessage = $this->errors[$errorCode];
    }
    protected function getErrorMesssage(){
       
       return $this->errorMessage ;
    }
   
}


?>
