<?php
namespace src\controller;;

use \src\controller\interfaces ;
use src\model;
use \src\controller; ;

class AvatarController extends controller\MainController {
    
    private $fileSizeMax;
    private $image;
    private $imageExtension;

    function __construct(core\Model $model){
        parent::__construct($model);

        
        $this->image = isset($_FILES['image']) ? $_FILES['image'] : "" ; 
        $this->fileSizeMax = 15000000; //bytes
       
        $this->imageExtension = pathinfo(  $this->image['name'], PATHINFO_EXTENSION     );
        //print_r($_FILES);
    
    }

    function post($arr){
        
        if(!isset($_SESSION['user'])){
            return array(  "flag" => false);
        }else if(!$this->checkImageFileExtension($this->imageExtension )){
            return array(  "flag" => false, "message" => "Wrong extension");
        }


        if($this->checkFileSize($_FILES['image']['size'])){
            $this->model->replaceAvatar($_FILES['image'],$_SESSION['user'],$this->imageExtension);
           //return $arr;
            return array( "flag" => true); 
        }else{
            return array(  "flag" => false, "message" => "File size is too big"); 
        }

        //$this->view->renderUtilJSON(array( "username" => $this->username, "commentID" => $id)); 
    }

    function get($arr){
        
        return $this->model->getAvatarPath($arr['username']);
        //return array("flag" => true, "avatarPath" => "")

    }


    function delete(){

    }
    function put(){

    }

    function checkFileSize($fileSize){
        if($this->fileSizeMax >= $fileSize){
            return true;
        }
        return false;
    }

    function checkImageFileExtension($imageExtension){
        if($imageExtension == "png" || $imageExtension == "jpg"|| $imageExtension == "png"|| $imageExtension == "jpeg"){
            return true;
        }
        return false;
    }

    

    


    

}



?>