<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;

class editutilityUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $title;
    private $postID;

    function __construct($data){
        $this->model = new model\postModel();
        $this->text =  isset($_POST['text']) ? $_POST['text'] : "" ; 
        $this->postID =   isset($_POST['postID']) ? (int)$_POST['postID'] : "" ; 
        $this->title = isset($_POST['title']) ? $_POST['title'] : "" ; 
        //print_r($_POST);
    }

    function runScript(){
        $this->editPost();
    }

    function editPost(){
        $this->model->editPost($this->title, $this->text, $this->postID);
         
        

       
    }


    

}



?>