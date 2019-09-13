<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;

class editutilityUtility implements interfaces\utilityInterface{
    private $model;
    private $text;
    private $title;
    private $postID;
    private $category;

    private $day;
    private $month;
    private $year;
    private $date;

    function __construct($data){
        $this->model = new model\postModel();
        $this->text =  isset($_POST['text']) ? $_POST['text'] : "" ; 
        $this->postID =   isset($_POST['postID']) ? (int)$_POST['postID'] : "" ; 
        $this->title = isset($_POST['title']) ? $_POST['title'] : "" ; 
        $this->category = isset($_POST['category']) ? $_POST['category'] : "" ; 

        $this->day = isset($_POST['day']) ? $_POST['day'] : "" ; 
        $this->month = isset($_POST['month']) ? $_POST['month'] : "" ; 
        $this->year = isset($_POST['year']) ? $_POST['year'] : "" ; 

        

        session_start();
        $this->user = $_SESSION['user'];
        //print_r($_POST);
    }

    function runScript(){
        $this->editPost();
    }

    function editPost(){
        if($this->text == "" ){
            $content = array("flag" => false, "message" => "Wrong text");
            echo json_encode($content); 
            return false;
        }elseif($this->title == ""){
            $content = array("flag" => false, "message" => "Wrong title");
            echo json_encode($content); 
            return false;
        }elseif(!is_numeric($this->day)){
            $content = array("flag" => false, "message" => "Wrong day");
            echo json_encode($content); 
            return false;
        }elseif(!is_numeric($this->month)){
            $content = array("flag" => false, "message" => "Wrong month");
            echo json_encode($content); 
            return false;
        }elseif(!is_numeric($this->year)){
            $content = array("flag" => false, "message" => "Wrong year");
            echo json_encode($content); 
            return false;
        }elseif(!is_numeric($this->category) || $this->category == 0 ){
            $content = array("flag" => false, "message" => "Wrong category");
            echo json_encode($content); 
            return false;
        }
       
     $this->date = $this->year."-".$this->month."-".$this->day;
        



        if($this->postID){
            $this->model->editPost($this->title, $this->text, $this->postID,$this->user,$this->category);

        }else{
            $this->model->createPost($this->title, $this->text,$this->user,$this->date,$this->category);

        }
        $content = array("flag" => true, "message" => "Posted" );
        echo json_encode($content); 
        return false;
        

       
    }


    

}



?>