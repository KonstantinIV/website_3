<?php
class indexPageUtility {
    
    private $model;
    private $view;

    function __construct($data){
       
       $this->model = new postModel();
       $this->model->inputData['categoryName'] = $_POST['cat'];
       $this->model->inputData['nextCount'] = (int)$_POST['grab'];
       //echo gettype($this->model->data['nextCount']), "\n";
       $this->view = new viewController;
       $this->view->pageData['metaData']['body']   = "indexUtil";
        if($this->model->inputData['categoryName'] != ""){
            $this->view->pageData['metaData']['title']      =  $this->model->inputData['categoryName'];
            $this->view->pageData['outputData'] = $this->model->getPopularPostsCategoryNext();

        }else{
            $this->view->pageData['metaData']['title']     = "Main" ;
            $this->view->pageData['outputData'] = $this->model->getPopularPostsSerial();
        }

    
        
    
       
       //print_r($this->model->getPopularPostsSerial());

       $this->view->conBody();         
    }

    function retData(){
        
    }



    

    
}



?>