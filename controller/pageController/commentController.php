<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\controller\helpers;

class commentController extends core\mainController implements interfaces\pageInterface{

    private $postID;
    private $commentData;
    private $username;
    public $helper;
    function __construct($input){
       
        parent::__construct("commentModel", "Comments", "comment" , $input);

       $this->postID = empty($input[1]) ? $this->emptyID() : $input[1] ;
       $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
  
        $this->commentData = $this->getComment();
        
    }

    

    function getComment(){
        return $this->model->getComments($this->postID,$this->username);
        
    }


    function loadPage(){
      
            $this->view->render($this->pageBody());
        
      
    }
   


   
    function pageBody(){
        $this->helper = new helpers\helpers();

       // print_r($this->output);
        ob_start();
            require "view/comment/container.php" ;  
            if($this->username){
                require "view/comment/postReply.php";
            }
            require "view/comment/comment.php";

        return  ob_get_clean();
}
    



}


?>
