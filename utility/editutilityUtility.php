<?php
namespace src\utility;

use \src\controller\interfaces ;
use src\model;
use \src\utility ;

class editutilityUtility extends utility\mainUtility implements interfaces\utilityInterface{
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
        parent::__construct();

        $this->model = new model\postModel();
        $this->text =  isset($_POST['text']) ? $_POST['text'] : "" ; 
        $this->postID =   isset($_POST['postID']) ? (int)$_POST['postID'] : "" ; 
        $this->title = isset($_POST['title']) ? $_POST['title'] : "" ; 
        $this->category = isset($_POST['category']) ? $_POST['category'] : "" ; 

        $this->day = isset($_POST['day']) ? $_POST['day'] : "" ; 
        $this->month = isset($_POST['month']) ? $_POST['month'] : "" ; 
        $this->year = isset($_POST['year']) ? $_POST['year'] : "" ; 

        
    }

    function runScript(){
        $this->editPost();
    }

    function editPost(){
        if($this->text == "" ){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong text"));
           
            return false;
        }elseif($this->title == ""){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong title"));
           
            return false;
        }elseif(!is_numeric($this->day)){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong day"));
           
            return false;
        }elseif(!is_numeric($this->month)){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong month"));
            
            return false;
        }elseif(!is_numeric($this->year)){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong year"));
            
            return false;
        }elseif(!is_numeric($this->category) || $this->category == 0 ){
            $this->view->renderUtilJSON(array("flag" => false, "message" => "Wrong category"));
            
            return false;
        }
       
     $this->date = $this->year."-".$this->month."-".$this->day;
        


     
        if($this->postID){
           // print_r($_POST);
            $flag = $this->model->editPost($this->title, $this->text, $this->postID,$this->category);

        }else{

             $this->model->createPost($this->title, $this->text,$this->username,$this->date,$this->category);

        }
        $this->view->renderUtilJSON(array("flag" => $flag, "message" => "Posted" ));
        return false;
        

       
    }


    

}



?>