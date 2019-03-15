<?php
class editController extends mainController{
    private $postID;
    
    function __construct($param){
        parent::__construct("postModel",$param);
        $this->postID = $param;
        $this->indexMetaContent();
        
    }

    function indexMetaContent(){
        $this->view->name      = "Edit" ;
        $this->view->logged_in =  isset($_SESSION['user']) ? true : false; ;
        $this->view->body      = "edit";
        $this->model->data['postID']     = $this->postID;
        $this->model->data['username']     = $_SESSION['user'];


        $this->view->data      = $this->model->getPost()[0];
        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
