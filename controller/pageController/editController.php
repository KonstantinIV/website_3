<?php
namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class editController extends core\mainController implements interfaces\pageInterface{


    private $postID;
    private $defaultEdit = array(
        "title" => "",
        "text" => "",
    ); 
    
    function __construct($input){
        parent::__construct("postModel", "Edit", "edit" , $input);

        $this->output      = !( $this->input) ? $this->defaultEdit : $this->model->getPost($_SESSION['user'], $input[0])[0];
        print_r($this->output);
        $this->output['releaseDate']      = $this->model->splitDate($this->output['releaseDate']);

  
    }



    function indexMetaContent(){
       
        

        $this->view->data      = ( $this->model->data['postID'] == "") ? $this->defaultEdit : $this->model->getPost()[0];
        print_r($this->view->data['releaseDate']);
        $this->view->render()           ;
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
