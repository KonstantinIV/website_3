<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;
use \src\utility ;

class notificationsUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;
    private $fileSizeMax;
    private $image;
    private $imageExtension;

    function __construct($data){
        parent::__construct();

        $this->model = new model\userModel();
    
    
    }

    function post($arr){
        return false;
    }

    function get($arr){
     
         $this->model->getNotifications($_SESSION['user']);
    }

    function runScript(){
      
    }


   

    

    


    

}



?>