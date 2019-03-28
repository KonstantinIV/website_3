<?php

namespace src\controller\pageController;
u/se \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface
{

    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);
         $this->getContent();
        
        print_r($this->pageData);
       
    }


    function pageBody(){
        

        
        ob_start();
                    require "view/index/posts.php"   ;
                $content = ob_get_clean();
                ob_start();
                     require "view/index/postContainer.php";
                     require "view/index/category.php";
                $content = ob_get_clean();
                    require "view/index/container.php";
        
        
    }


    function getContent(){
       if($this->inputData != ""){
            $this->pageData['metaData']['title']      =  $this->inputData;
            $this->pageData['outputData'] = $this->model->getPopularPostsCategory();

        }else{
            
            $this->pageData['outputData'] = $this->model->getPopularPosts();
        }
        
        //$cache                            =  ($this->model->getPostCount()) / 20;
        //$this->view->data['pageData']['pageCount'] = ($cache < 10) ?  $cache : 10;

    }

   

    



}


?>
