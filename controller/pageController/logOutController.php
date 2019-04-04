<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\model;
class logOutController extends core\mainController{
    
    function __construct($input){
        parent::__construct("", "LogOut", "edit" , $input);
        
        $session = new model\sessionModel();
        $session->destroySession();
    }

   



}


?>