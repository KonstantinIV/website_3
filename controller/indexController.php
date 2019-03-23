<?php

namespace src\controller;


class indexController extends mainController{

    

    
    function __construct($input){
        parent::__construct("postModel");
        $this->setPageDataVariables("Main", "index" , $input  );
        $this->setModelInputData();
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

    function indexBody(){
        
        
    }

    



}


?>
