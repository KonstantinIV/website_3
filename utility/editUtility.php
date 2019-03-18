<?php
class editUtility{
    private $model;


    function __construct($data){
        $this->model = new postModel();
        $this->model->data['text'] = $_POST['text'];
        $this->model->data['id'] = (int)$_POST['postID'];
       
        $this->editPost();
        

    }

    function editPost(){
        $this->model->editPost();
         
        

       
    }


    

       
    



    
}



?>