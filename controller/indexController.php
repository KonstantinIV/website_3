<?php

namespace src\controller;

class indexController extends mainController implements pageIn
{

    

    
    function __construct($input){
        parent::__construct("postModel");
        $this->setPageDataVariables("Main", "index" , $input  );
        $this->setModelInputData("category", $this->pageData['inputData']);
        $this->indexGetContent(); 
        $this->renderView();
        
        print_r($this->pageData);
       
    }


    function indexGetContent(){
       if($this->pageData['inputData'] != ""){
            $this->pageData['metaData']['title']      =  $this->pageData['inputData'];
            $this->pageData['outputData'] = $this->model->getPopularPostsCategory();

        }else{
            
            $this->pageData['outputData'] = $this->model->getPopularPosts();
        }
        



      
        //$cache                            =  ($this->model->getPostCount()) / 20;
        //$this->view->data['pageData']['pageCount'] = ($cache < 10) ?  $cache : 10;




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

    



}


?>
