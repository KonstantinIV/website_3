<?php
namespace src\controller;
class deleteController extends mainController{
  
    
    function __construct($param){
        parent::__construct("postModel",$param);
        $this->session = new sessionModel();
        $this->model->data['id'] = $param;
        $this->model->data['username'] = $_SESSION['user'];
        $this->model->deletePost();
        header('Location: ../profile');


        
    }

   



    



}


?>
