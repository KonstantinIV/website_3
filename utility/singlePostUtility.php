<?php
namespace src\utility;

use \src\model;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\utility ;
use \src\controller\helpers;

class singlePostUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
    private $model;
    private $categoryName;
    private $nextCount;
    
    
    
    
    function __construct($input){
        parent::__construct();
        //echo($this->username);
       $this->model = new model\commentModel();
       $this->helper = new helpers\helpers();

       $input =  isset($_POST['url']) ? $_POST['url'] : false ;

       $this->postID = empty($input[1]) ? false : $input[1] ;

        
    }

    

    function runScript(){
        $this->output =  array($this->model->getSinglePost($this->postID,$this->username)[0]);
        $this->view->renderUtilJSON($this->generatePosts());  

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

    function generatePosts(){
        //echo json_encode(array("flag" => true));
        //echo sizeof($this->output);
        ob_start();
            require "view/index/posts.php";
        $html = ob_get_clean();

        return array( "content" => $html);

    }
    


  



    

    
}



?>