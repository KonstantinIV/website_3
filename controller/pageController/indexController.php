<?php

namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface{
    private $categoryName ;
    private $loggedIn;
    private $username;
    private $sort;
  
    //private categoryName = "";
    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);
        $this->categoryName = empty($input[1]) ? "" : $input[1] ;
        $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
        $this->sort         = isset($input[2]) ? $input[2] : false;
       
        if( !empty($input[1]) ){
            $this->view->pageData['metaData']['sortLinkPopular'] = "/".$input[0] . "/". $input[1]."/popular";
            $this->view->pageData['metaData']['sortLinkNew'] = "/".$input[0] . "/". $input[1]."/new";
          // 
        }
       // echo $input[0];
        if($input[0] == "new" ){
            $this->sort         = $input[0];
       
        }
       
        $this->output =  $this->getContent();
        
        //echo "ssssssssssssssssssssssssssssssssssss@@";

        
    }


    function loadPage(){
     
            $this->view->render($this->pageBody());
        
       
    }

    function sortLink($input){
        if($this->sort === "popular"){
            $this->sortLinkPopular = $_GET['url'];
            $this->sortLinkNew = $input[0] . "/". $input[1]."new";
        }else{
            $this->sortLinkPopular = $_GET['url'] ."/popular";
        }
       
    }


  
    function pageBody(){
     
        ob_start();
            require "view/index/container.php";
        return  ob_get_clean();
}



    function getContent(){
        
       if($this->categoryName != ""){
            $this->view->pageData['metaData']['title']      =  $this->categoryName;
            if($this->sort == "new"){
                return $this->model->getNewPostsCategory($this->categoryName, 0,$this->loggedIn,$this->username);

            }
            return $this->model->getPopularPostsCategory($this->categoryName, 0,$this->loggedIn,$this->username);
        }else{
            if($this->sort == "new"){
               // echo "ddd";
                return $this->model->getNewPosts(0,$this->loggedIn,$this->username);
         
            }
           // echo $this->sort."ssssssssssssss";
            return $this->model->getPopularPosts(0,$this->loggedIn,$this->username);
         
        }
        
    
    }

   

    



}


?>
