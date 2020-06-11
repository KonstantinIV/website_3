<?php 
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;  
 
class loginController extends core\mainController implements interfaces\pageInterface{


    function __construct($input){
       parent::__construct("","Login", "login" , $input);
       
    }





   

function loadPage(){
        
    $this->view->render($this->pageBody());
}



function pageBody(){
        
    
    ob_start();
        require "view/login/container.php";
    return  ob_get_clean();
}
}
    
?>