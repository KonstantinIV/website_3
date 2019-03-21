<?php
namespace src\controller;
class logOutController extends mainController{
    
    function __construct($param){
        parent::__construct("",$param);
        
        $session = new model\sessionModel();
        $session->destroySession();
    }

   



}


?>