<?php

namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface{
    private $categoryName ;
    //private categoryName = "";
    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);
        $this->categoryName = empty($input[0]) ? "" : $input[0] ;
        
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
           
            return $this->model->getPopularPosts(0);
         
        }
        
    
    }

   

    



}


?>
