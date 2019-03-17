<?php
class indexPageUtility {
    
    private $model;
    private $view;

    function __construct($data){
       
       $this->model = new postModel();
       $this->model->data['categoryName'] = $_POST['cat'];
       $this->model->data['nextCount'] = (int)$_POST['grab'];
       //echo gettype($this->model->data['nextCount']), "\n";
       $this->view = new viewController;
       $this->view->body   = "indexUtil";
        if($this->model->data['categoryName'] != ""){
            $this->view->name      =  $this->model->data['categoryName'];
            $this->view->data['postData'] = $this->model->getPopularPostsCategoryNext();

        }else{
            $this->view->name      = "Main" ;
            $this->view->data['postData'] = $this->model->getPopularPostsSerial();
        }

    
        
    
       
       //print_r($this->model->getPopularPostsSerial());

       $this->view->conBody();         
    }

    function retData(){
        
    }



    

    
}



?>