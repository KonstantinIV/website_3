<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;

class commentutilityUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $username;
    private $commentParentID;
    private $postID;


    function __construct($data){

        $this->model = new model\commentModel();

        $this->username = $_SESSION['user'];
        $this->text =  isset($_comment['text']) ? $_comment['text'] : "" ; 
        $this->commentParentID =   isset($_comment['commentParentID']) ? (int)$_comment['commentParentID'] : "" ; 
        $this->postID          =    isset($_comment['postID']) ? (int)$_comment['postID'] : "" ; 
        //print_r($_comment);
    }

    function runScript(){
        $this->editcomment();
    }

    function editcomment(){
        $this->model->editComment($this->postID, $this->commentParentID, $this->username, $this->text);
         
    }


    

}



?>