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
        8 => "Invalid point integer",
        9 => "Empty field",
        10 => "Invalid username",
        11 => "Invalid password",
        12 => "Invalid email"

    );
    protected $errorMessage; 

    
    public function validatePost($params){
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


    
    


//Avatar
    public function validateAvatarPicture($imageSize, $imageExtension){
        if(!$this->checkImageFileSize($imageSize)){
            $this->setErrorMessage(5);
            return false;
        }else if(!$this->checkImageFileExtension($imageExtension)){
            $this->setErrorMessage(6);
            return false;
        }
        return true;
    }
    //Comment
    public function validateComment($params){
        if(!$this->isValidPostCommentLength($params['text'])){
            $this->setErrorMessage(7);
            return false;
        }
        return true;
    }
    //Starvote
    public function validateStarVote($params){
        if(!$this->checkPointRange($params['points'])){
            $this->setErrorMessage(8);
            return false;
        }
        return true;
    }

//User
    public function validateUser($params){
        if(
            $this->checkEmptyField($params['username']) || 
            $this->checkEmptyField($params['password']) || 
            $this->checkEmptyField($params['email']) 
          ) {
            $this->setErrorMessage(9);
            return false;
        }elseif($this->isValidUsername($params['username'])){
            $this->setErrorMessage(10);
            return false;
        }elseif($this->isValidPassword($params['password'])){
            $this->setErrorMessage(11);
            return false;
        }elseif($this->isValidEmail($params['email'])){
            $this->setErrorMessage(12);
            return false;
        }







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
    protected function isValidPostCommentLength($text){
        if(strlen($text) > 9000){
            return false;
        }
        return true;
    }

    //StarVote
    protected function checkPointRange($points){
        if($points > 5 || $points < 0){
            return false;
        }
        return true;
    }


    //User
    protected function checkEmptyField($field){
        if(!$field){
            return false;
        }
        return true;
    }
    protected function isValidUsername($username){
        if( strlen($username) > 24 || strlen($username) < 3 || !is_string($username))  {
            return false;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$username)){

            return false;
        }

        return true;
    }

    protected function isValidPassword($password){
        if(strlen($password) < 8 || !is_string($password ))  {

            return false;
          }
          return true;
    }
    protected function isValidEmail($email){
        if(!preg_match("/^.+@.+$/",$email ) || !is_string($email))  {
            return false;
        }
        return true;
    }

   
}


?>
