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


        
    }



   function loadPage(){
    $this->model->deletePost($this->postID,$this->username);
    $this->pageBody();
 
        
   
}
function pageBody(){
    header('Location: ../profile');

}


}


?>
