<?php

namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface{

    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);

        
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
        
       if($this->input != ""){
            $this->view->pageData['metaData']['title']      =  $this->input;
            return $this->model->getPopularPostsCategory($this->pageData['inputData']);
        }else{
           
            return $this->model->getPopularPosts();
          //  print_r($this->view->pageData);
        }
        
        
        //$cache                            =  ($this->model->getPostCount()) / 20;
        //$this->data['pageData']['pageCount'] = ($cache < 10) ?  $cache : 10;

    }

   

    



}


?>
