<?php
namespace src\controller;;

use \src\controller\interfaces ;
use src\model;
use \src\controller; ;

class AvatarController extends controller\MainController {
    
    private $fileSizeMax = 15000000;
   // private  $image = (isset($_FILES['image']) ? $_FILES['image'] : "" ); 
   // private $imageExtension = pathinfo(  $this->image['name'], PATHINFO_EXTENSION     );


    function post($arr){

        if($this->validation->validateAvatarImage(
                $_FILES['image']['size'],
                pathinfo(  $_FILES['image']['name'], PATHINFO_EXTENSION) 
            )){

                $this->model->replaceAvatar(
                    $_FILES['image'],
                    $this->userSession->getUsername(),
                    $this->imageExtension
                );

                return true;
        }else{
            $this->setErrorMessage(
                $this->validation->getErrorMessage()
           );
            return false;
        }
        
          
        
 
    }

    function get($arr){
        $this->setResult( 
         $this->model->getAvatarPath($arr['username'])
        );
        return true;
       
        //return array("flag" => true, "avatarPath" => "")

    }


    function delete(){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }
    function put(){
        $this->setErrorMessage(
            $this->getErrorMessage(
                $code = 405
                )
        );
        return false;
    }

  

  

    

    


    

}



?>