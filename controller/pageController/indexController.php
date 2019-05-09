<?php

namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface{
    private $categoryName ;
    private $loggedIn;
    private $username;
    //private categoryName = "";
    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);
        $this->categoryName = empty($input[0]) ? "" : $input[0] ;
        $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
        $this->output =  $this->getContent();
        
        
        
    }


    function loadPage(){
     
            $this->view->render($this->pageBody());
        
       
    }


  
    function pageBody(){
     
        ob_start();
            require "view/index/container.php";
        return  ob_get_clean();
}



    function getContent(){
        
       if($this->categoryName != ""){
            $this->view->pageData['metaData']['title']      =  $this->categoryName;
            return $this->model->getPopularPostsCategory($this->categoryName, 0);
        }else{
           
            return $this->model->getPopularPosts(0,$this->loggedIn,$this->username);
         
        }
        
    
    }

   

    



}


?>
