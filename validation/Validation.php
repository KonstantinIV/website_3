<?php
namespace src\validation;



 class Validation { 

    protected $validationErrors = array( 
        1 => "Invalid title",
        2 => "Invalid text",
        3 => "Invalid date",
        4 => "Day of the release is already passed",
        5 => "Wrong file size",
        6 => "Invalid image extension",
        7 => "Invalid comment char size",
       

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

    



    protected function validateAvatarPicture($imageSize, $imageExtension){
        if(!$this->checkImageFileSize($imageSize)){
            $this->setErrorMessage(5);
            return false;
        }else if(!$this->checkImageFileExtension($imageExtension)){
            $this->setErrorMessage(6);
            return false;
        }
        return true;
    }
    protected function validateComment($params){
        if(!$this->isValidPostCommentLength($params['text'])){
            $this->setErrorMessage(7);
            return false;
        }
        return true;
    }

//Avatar

protected function checkImageFileSize($imageSize){
    if(15000000 >= $imageSize){
        return true;
    }
    return false;
}
protected   function checkImageFileExtension($imageExtension){
    if($imageExtension == "png" || $imageExtension == "jpg"|| $imageExtension == "png"|| $imageExtension == "jpeg"){
        return true;
    }
    return false;
}



//Post
    protected function isValidPostTextLength($text){
        if(strlen($text) > 18000){
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
       
        $this->errorMessage = $this->validationErrors[$errorCode];
    }
    protected function getErrorMesssage(){
       
       return $this->errorMessage ;
    }


    //Comment
    protected function isValidCommentTextLength($text){
        if(strlen($text) > 9000){
            return false;
        }
        return true;
    }
   
}


?>
