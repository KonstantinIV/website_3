<?php
namespace src\utility;
use \src\model;
class dislikeUtility{
    private $model;
    private $session;


    function __construct($data){
        $this->model = new model\postModel();
        $this->session = new model\sessionModel();
       // $this->model->data['id'] = ;
//        $this->model->data['username'] = ;

        $this->model->dislikePost((int)$_POST['postID'],$_SESSION['user']);
        

    }

   

    

       
    



    
}



?>