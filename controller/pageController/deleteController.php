<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class deleteController extends core\mainController implements interfaces\pageInterface{
    private $postID;
    private $username;
    
    function __construct($input){
        parent::__construct("postModel","","",$input);
        $this->postID = empty($input[0]) ? "" : $input[0] ;
        $this->username = $_SESSION['user'];


        $this->model->deletePost($this->postID,$this->username);
        
    }

   function loadPage(){
    header('Location: ../profile');
   }



    



}


?>
