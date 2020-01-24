<?php
namespace src\utility;

use \src\model;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\utility ;


class postApiUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
    private $model;
 

    function __construct($input){
        parent::__construct();
       $this->model = new model\postModel();

    }


    function get($arr){

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

    function post(){
        
    }
    function put(){
        
    }
    function delete(){
        
    }

    

    
}



?>