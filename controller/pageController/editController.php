<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class editController extends core\mainController implements interfaces\pageInterface{


    private $postID ;
    private $defaultEdit = array(
        "title" => "",
        "text" => "",
    ); 


    
    function __construct($input){
        parent::__construct("postModel", "Edit", "edit" , $input);
        $this->postID = empty($input[1]) ? "" : $input[1] ;
        
        $this->output      = !( $this->input) ? $this->defaultEdit : $this->model->getPost($_SESSION['user'], $this->postID)[0];
        
        $this->output['releaseDate']      = $this->model->splitDate($this->output['releaseDate']);
       // print_r($this->output['releaseDate']);
        
    }



 

   
    function loadPage(){
        
        $this->view->render($this->pageBody());
    }



   
    function pageBody(){
        ob_start();
        
        require "view/edit/edit.php";
    
        return  ob_get_clean();
}
    

    



}


?>
