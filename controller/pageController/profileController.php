<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class profileController extends core\mainController implements interfaces\pageInterface{
    
    function __construct($input){





        parent::__construct("profileModel", "Profile", "profile" , $input);
       
        //Chnage to if
         $this->input     = $_SESSION['user'];

         
        $this->output['posts']     = $this->model->getUserPosts();
        $this->output['postCount'] = $this->model->postCount();
        $this->output['likeCount'] = $this->model->likeCount();
        $this->output['commentCount'] = $this->model->commentCount();
        $this->output['joinDate'] = $this->model->getUserJoinDate();
        print_r($this->pageData);
        
        
        
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
