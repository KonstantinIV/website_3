<?php
use \src\controller\interfaces ;

class editUtility implements interfaces\utilityInterface{
    private $model;


    function __construct($data){
        $this->model = new postModel();
        $this->model->data['text'] = $_POST['text'];
        $this->model->data['id'] = (int)$_POST['postID'];
       
       
        

    }

    function runScript(){
        $this->editPost();
    }

    function editPost(){
        $this->model->editPost();
         
        

       
    }


    

       
    



    
}



?>