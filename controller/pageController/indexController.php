<?php

namespace src\controller\pageController;
use \src\controller\core;
use \src\controller\interfaces ;

class indexController extends core\mainController implements interfaces\pageInterface{
    private $categoryName ;
    private $loggedIn;
    private $username;
    private $sort;
    private $nextCount;

    //private categoryName = "";
    

    
    function __construct($input){
        parent::__construct("postModel", "Main", "index", $input);
        $this->nextCount = isset($_POST['grab']) ? (int)$_POST['grab'] : 0 ;

        if($input[0] == "new" || $input[0] =="popular"){
            if($input[1] == "cat"){
                echo "sdadsada";

                $this->view->pageData['metaData']['sortLinkPopular'] = "/popular"."/".$input[1] . "/". $input[2]."/";
                $this->view->pageData['metaData']['sortLinkNew'] = "/new"."/".$input[1] . "/". $input[2]."/";
                $this->searchInput  = isset($input[4]) ? $input[4] : false;
                $this->sort         = isset($input[0]) ? $input[0] : false;
                $this->categoryName = empty($input[2]) ? "" : $input[2] ;

            }else{
                $this->sort         = isset($input[0]) ? $input[0] : false;
                $this->searchInput  = isset($input[2]) ? $input[2] : false;
            }
           

        }else{
            
            if($input[0] == "cat" ){
                $this->view->pageData['metaData']['sortLinkPopular'] = "/popular"."/".$input[0] . "/". $input[1]."/";
                $this->view->pageData['metaData']['sortLinkNew'] = "/new"."/".$input[0] . "/". $input[1]."/";
                $this->searchInput  = isset($input[3]) ? $input[3] : false;
                $this->categoryName = empty($input[1]) ? "" : $input[1] ;
            }else{
                
                $this->searchInput  = isset($input[1]) ? $input[1] : false;

            }
            
            $this->sort         = "popular";

        }


        $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
       
    
      
       
        $this->output =  $this->getContent();
        
        //echo "ssssssssssssssssssssssssssssssssssss@@";

        
    }

    function setVariables(){

    }


    function loadPage(){
        if($_POST["method"]){
            $this->view->renderUtil($this->generatePosts());  

        }else{
            $this->view->render($this->pageBody());
        
        }
     
            
       
    }

    function generatePosts(){
        //echo json_encode(array("flag" => true));
        //echo sizeof($this->output);
        ob_start();
            require "view/index/posts.php";
        $html = ob_get_clean();

        $flag = (sizeof($this->output) < 10  ) ? true : false ;
        $content = array("flag" => $flag, "content" => $html);
        return json_encode($content); 

    }
/*
    function sortLink($input){
        if($this->sort === "popular"){
            $this->sortLinkPopular = $_GET['url'];
            $this->sortLinkNew = $input[0] . "/". $input[1]."new";
        }else{
            $this->sortLinkPopular = $_GET['url'] ."/popular";
        }
       
    }

*/
  
    function pageBody(){
     
        ob_start();
            require "view/index/container.php";
        return  ob_get_clean();
}



    function getContent(){
        
       if($this->categoryName != ""){
            $this->view->pageData['metaData']['title']      =  $this->categoryName;
            if($this->sort == "new"){
                return $this->model->getNewPostsCategory($this->categoryName, $this->nextCount,$this->loggedIn,$this->username,$this->searchInput);

            }
            return $this->model->getPopularPostsCategory($this->categoryName, $this->nextCount,$this->loggedIn,$this->username,$this->searchInput);
        }else{
            if($this->sort == "new"){
               // echo "ddd";
                return $this->model->getNewPosts($this->nextCount,$this->loggedIn,$this->username,$this->searchInput);
         
            }
           // echo $this->sort."ssssssssssssss";
            return $this->model->getPopularPosts($this->nextCount,$this->loggedIn,$this->username,$this->searchInput);
         
        }
        
    
    }

   

    



}


?>
