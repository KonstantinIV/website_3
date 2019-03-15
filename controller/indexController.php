<?php
class indexController extends mainController{
    
    function __construct($param){
        parent::__construct("postModel",$param);
        
        $this->indexMetaContent();
        
    }

    function indexMetaContent(){
        $this->view->name      = "Main" ;
        $this->view->logged_in =  isset($_SESSION['user']) ? true : false; ;
        $this->view->body      = "index";
        $this->view->data      = $this->model->getPopularPosts();
        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
