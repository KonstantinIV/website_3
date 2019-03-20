<?php
class likeUtility{
    private $model;
    private $session;


    function __construct($data){
        $this->model = new postModel();
        $this->session = new sessionModel();
        $this->model->data['id'] = (int)$_POST['postID'];
        $this->model->data['username'] = $_SESSION['user'];

        $this->model->likePost();
        

    }

   

    

       
    



    
}



?>