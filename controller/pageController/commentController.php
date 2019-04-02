<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class commentController extends core\mainController implements interfaces\pageInterface{

    private $postID;
    
    function __construct($input){
        echo "Ssssssssssssssss";
        parent::__construct("commentModel", "Comments", "comment" , $input);
       // print_r($this->input . "<br>sssssssssssssssssssssssssssssssssssssssssss"); 
       $this->postID = $this->input[0];
    
        $this->output['postData'] = $this->getPost();
        $this->output['commentData'] = $this->getComment();
    }

    function getPost(){
        return $this->model->getSinglePost($this->postID)[0];
           
        
    }
    
    
    function getComment(){
        return $this->model->getCommentid($this->postID);
        
    }


    function loadPage(){
        
        $this->view->render($this->pageBody());
    }



   
    function pageBody(){
        print_r($this->output);
        ob_start();
            require "view/comment/post.php" ;  
            require "view/comment/comment.php";

        return  ob_get_clean();
}
    



}


?>
