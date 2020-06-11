<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class settingsController extends core\mainController implements interfaces\pageInterface{
    

    private $username;

    function __construct($input){
        
        


        parent::__construct("profileModel", "Settings", "settings" , $input);
        //$this->username = $_SESSION['user'];
        //Chnage to if
        $this->username = empty($input[1]) ? $_SESSION['user'] : $input[1];


        /*if( isset($_SESSION['user'])){
            
           
            
        }*/
        
        /*if(!$this->model->userExists($this->username)){
            header('Location: /');

        }*/




         //$this->username     = $_SESSION['user'];

         //echo  $_SESSION['user'];
       
        //print_r($this->pageData);
        
        
        
    }




    function loadPage(){
        
        $this->view->render($this->pageBody());
    }



   
    function pageBody(){
        ob_start();
        
        require "view/settings/settings.php";
    
        return  ob_get_clean();
}
    

    



}


?>
