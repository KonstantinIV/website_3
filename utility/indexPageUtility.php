<?php
namespace src\utility;
use src\model;
use src\controller\core;
use \src\controller\interfaces ;

class indexPageUtility implements interfaces\utilityInterface{ 
    
    private $model;
    private $categoryName;
    private $nextCount;
    private $view;

    private $output;

    function __construct($input){
       
       $this->model = new model\postModel();
       $this->view = new core\viewController;


       $this->categoryName = isset($_POST['cat']) ? $_POST['cat'] : "" ;
       $this->nextCount = isset($_POST['grab']) ? (int)$_POST['grab'] : "" ;

     
      // $this->view->pageData['metaData']['body']   = "indexUtil";

        if($this->categoryName != ""){

            $this->output = $this->model->getPopularPostsCategory($this->categoryName, $this->nextCount);
        }else{
            $this->output = $this->model->getPopularPosts($this->nextCount);
        }

    
        
    
       
      // print_r($this->output);

              
    }


    function runScript(){
        $this->view->renderUtil($this->generatePosts());  



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



    

    
}



?>