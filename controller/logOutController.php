<?php
class logOutController extends mainController{
    
    function __construct($param){
        parent::__construct("",$param);
        
        $session = new sessionModel();
        $session->destroySession();
    }

   



}


?>