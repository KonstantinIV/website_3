<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class profileController extends core\mainController implements interfaces\pageInterface{
    

    private $username;

    function __construct($input){
        
        $this->username = empty($input[0]) ? "" : $input[0];



        parent::__construct("profileModel", "Profile", "profile" , $input);
       
        //Chnage to if


        /*if( isset($_SESSION['user'])){
            
           
            $this->username = $_SESSION['user'];
        }*/
        
        if(!$this->model->userExists($this->username)){
            header('Location: /');

        }




         //$this->username     = $_SESSION['user'];

         //echo  $_SESSION['user'];
        $this->output['posts']     = $this->model->getUserPosts($this->username);
        $this->output['postCount'] = $this->model->postCount($this->username);
        $this->output['likeCount'] = $this->model->likeCount($this->username);
        $this->output['commentCount'] = $this->model->commentCount($this->username);
        $this->output['joinDate'] = $this->model->getUserJoinDate($this->username);
        //print_r($this->pageData);
        
        
        
    }




    function loadPage(){
        
        $this->view->render($this->pageBody());
    }



   
    function pageBody(){
        ob_start();
        
        require "view/profile/container.php";
    
        return  ob_get_clean();
}
    

    



}


?>
