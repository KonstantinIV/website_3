<?php
class profileController extends mainController{
    
    function __construct($param){
        parent::__construct("profileModel",$param);
        
        $this->indexMetaContent();
        
    }

    function indexMetaContent(){
        $this->view->name      = "Profile" ;
        $this->view->logged_in =  isset($_SESSION['user']) ? true : false; ;
        $this->view->body      = "profile";
        $this->model->data['username']     = $_SESSION['user'];


        $this->view->data['posts']     = $this->model->getUserPosts();

        $this->view->data['postCount'] = $this->model->postCount();
        $this->view->data['likeCount'] = $this->model->likeCount();
        $this->view->data['commentCount'] = $this->model->commentCount();

        $this->view->data['joinDate'] = $this->model->getUserJoinDate();


        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
