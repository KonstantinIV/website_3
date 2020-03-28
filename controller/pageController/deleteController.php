<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class deleteController extends core\mainController implements interfaces\pageInterface{
    private $postID;
    private $username;
    
    function __construct($input){
        parent::__construct("postModel","","",$input);
        if(!isset($_SESSION['user'])){
            header('Location: /');
        }
        $this->postID = empty($input[1]) ? "" : $input[1] ;
        $this->username = $_SESSION['user'];
        //print_r($input);

        
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
