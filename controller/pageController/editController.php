<?php
namespace src\pageController\controller;
class editController extends mainController implements pageInterface{
    private $postID;
    private $defaultEdit = array(
        "title" => "",
        "text" => "",
    ); 
    
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


        $this->view->data      = ( $this->model->data['postID'] == "") ? $this->defaultEdit : $this->model->getPost()[0];
        $this->view->data['releaseDate'] = $this->model->splitDate($this->view->data['releaseDate']);
        print_r($this->view->data['releaseDate']);
        $this->view->render()           ;
    }

    function indexBody(){
        
        
    }

    



}


?>
