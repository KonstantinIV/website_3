<?php
namespace src\utility;
use src\model;
use src\controller\core;
class indexPageUtility {
    
    private $model;
    private $categoryName;
    private $nextCount;
    private $view;

    private $output;

    function __construct($input){
       
       $this->model = new model\postModel();
       $this->view = new core\viewController;


       $this->categoryName = isset($_POST['cat']) ? $_POST['cat'] : "" ;
       $this->nextCount = (int)$_POST['grab'];

     
      // $this->view->pageData['metaData']['body']   = "indexUtil";

        if($this->categoryName != ""){

            $this->output = $this->model->getPopularPostsCategory($this->categoryName, $this->nextCount);
        }else{
            $this->output = $this->model->getPopularPosts($this->nextCount);
        }

    
        
    
       
      // print_r($this->output);

       $this->view->renderUtil($this->generatePosts());         
    }

    function generatePosts(){
        echo json_encode(array("flag" => true));
        ob_start();
        require "view/index/posts.php";
        return ob_get_clean();

    }



    

    
}



?>