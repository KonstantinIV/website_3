<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;

class commentutilityUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $username;
    private $ID;
    private $postID;


    function __construct($data){

        $this->model = new model\commentModel();
session_start();
        $this->username = $_SESSION['user'];
        $this->text =  isset($_POST['text']) ? $_POST['text'] : "" ; 
        $this->ID =   isset($_POST['ID']) ? (int)$_POST['ID'] : "" ; 
        $this->postID          =    isset($_POST['postID']) ? (int)$_POST['postID'] : "" ; 
      //  print_r($_POST);
       // print_r($this->username."sasda");
    }

    function runScript(){
        $this->editcomment();
    }

    function editcomment(){
        $id = $this->model->editComment($this->postID, $this->ID, $this->username, $this->text);
        echo json_encode(array( "username" => $this->username, "commentID" => $id)); 
    }


    

}



?>