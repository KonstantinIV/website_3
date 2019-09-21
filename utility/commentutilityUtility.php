<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;
use \src\utility ;

class commentutilityUtility extends utility\mainUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $ID;
    private $postID;


    function __construct($data){
        parent::__construct();

        $this->model = new model\commentModel();


        $this->text =  isset($_POST['text']) ? $_POST['text'] : "" ; 
        $this->ID =   isset($_POST['ID']) ? (int)$_POST['ID'] : "" ; 
        $this->postID          =    isset($_POST['postID']) ? (int)$_POST['postID'] : "" ; 
    
    }

    function runScript(){
        $id = $this->model->editComment($this->postID, $this->ID, $this->username, $this->text);
        $this->view->renderUtilJSON(array( "username" => $this->username, "commentID" => $id)); 
    }

    

    


    

}



?>