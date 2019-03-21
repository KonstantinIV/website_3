<?php
namespace src\controller;

class commentController extends mainController{
    private $postID;
    
    function __construct($param){
        parent::__construct("commentModel",$param);
        $this->postID = $param;
        $this->indexMetaContent();
        
    }

    function indexMetaContent(){
        $this->view->name      = "Comment" ;
        $this->view->logged_in =  isset($_SESSION['user']) ? true : false; 
        $this->view->body      = "comment";
        $this->model->data['postID']     = $this->postID;
        $this->view->data['postData']      = $this->model->getSinglePost()[0];

        $this->view->data['commentData']      = $this->model->getCommentid();
        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
