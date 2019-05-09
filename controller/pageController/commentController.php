<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class commentController extends core\mainController implements interfaces\pageInterface{

    private $postID;
    private $commentData;
    private $username;
    function __construct($input){
       
        parent::__construct("commentModel", "Comments", "comment" , $input);
       
       $this->postID = empty($input[0]) ? $this->emptyID() : $input[0] ;
       $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
  
        $this->output = array($this->getPost());
        $this->commentData = $this->getComment();
        
    }

    function getPost(){
        return $this->model->getSinglePost($this->postID,$this->username)[0];
           
        
    }

    function emptyID(){
        
    }
    
    
    function getComment(){
        return $this->model->getComments($this->postID,$this->username);
        
    }


    function loadPage(){
        $this->view->render($this->pageBody());
    }



   
    function pageBody(){
    
        print_r($this->output);
        ob_start();
            require "view/index/posts.php" ;  
            require "view/comment/comment.php";

        return  ob_get_clean();
}
    



}


?>
