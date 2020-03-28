<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

use \src\model;
class logOutController extends core\mainController implements interfaces\pageInterface{
    
    function __construct($input){
        parent::__construct("", "LogOut", "edit" , $input);
        
        $session = new model\sessionModel();
        $session->destroySession();
        session_unset();
    }
    
    
   






function loadPage(){
   $this->pageBody();
   }

function pageBody(){
    header('Location: /');
}
}

?>