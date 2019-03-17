<?php
class indexController extends mainController{
    
    function __construct($param){
        parent::__construct("postModel",$param);
        
        $this->indexMetaContent();
        
    }

    function indexMetaContent(){
        
        $this->view->logged_in =  isset($_SESSION['user']) ? true : false; 
        $this->model->data['categoryName']     = $this->param;
        $this->view->body      = "index";
       if($this->model->data['categoryName'] != ""){
            $this->view->name      =  $this->model->data['categoryName'];
            $this->view->data['postData'] = $this->model->getPopularPostsCategory();

        }else{
            $this->view->name      = "Main" ;
            $this->view->data['postData'] = $this->model->getPopularPosts();
        }
        



      
        //$cache                            =  ($this->model->getPostCount()) / 20;
        //$this->view->data['pageData']['pageCount'] = ($cache < 10) ?  $cache : 10;




        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
