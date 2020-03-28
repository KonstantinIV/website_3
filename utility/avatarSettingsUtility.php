<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;
use \src\utility ;

class avatarSettingsUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;
    private $fileSizeMax;
    private $image;
    private $imageExtension;

    function __construct($data){
        parent::__construct();

        $this->model = new model\profileModel();
        $this->image = isset($_FILES['image']) ? $_FILES['image'] : "" ; 
        $this->fileSizeMax = 15000000; //bytes
        $this->imageExtension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
       
        print_r($_FILES);
    
    }

    function runScript(){
        if(!isset($_SESSION['user'])){
            return false;
        }else if($this->checkFileExtension()){
            return false;
        }


        if($this->checkFileSize($this->image['size'])){
            $this->model->saveAvatar($this->image,$_SESSION['user'],$this->imageExtension);
            $this->view->renderUtilJSON(array( "flag" => true)); 
        }else{
            $this->view->renderUtilJSON(array(  "flag" => false, "message" => "File size is too big")); 
        }

        //$this->view->renderUtilJSON(array( "username" => $this->username, "commentID" => $id)); 
    }


    function checkFileSize($fileSize){
        if($this->fileSizeMax >= $fileSize){
            return true;
        }
        return false;
    }

    function checkFileExtension(){
        if($this->imageExtension == "png" || $this->imageExtension == "jpg"){
            return true;
        }
        return false;
    }

    

    


    

}



?>