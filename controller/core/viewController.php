<?php
namespace src\controller\core;

class viewController extends mainController{
    public $pageData;


    function __construct(){
        //require __DIR__ . "/template.php";
        
    }


    function conHead(){
        require "view/head.php";
    }
    function conHeader(){
        require "view/header.php";

    }




    function conBody(){
        //echo $this->pageData['body'];
        switch ($this->pageData['metaData']['body']){
            case "index":
                ob_start();
                    require "view/index/posts.php"   ;
                $content = ob_get_clean();
                ob_start();
                     require "view/index/postContainer.php";
                     require "view/index/category.php";
                $content = ob_get_clean();
                    require "view/index/container.php";
                    //require "view/index/pageNumbers.php";
                break;
            case "indexUtil":
            ob_start();
                    require "view/index/posts.php";
                    $content = ob_get_clean();
            echo $content;    
            //echo "asdsadasd";    
                break;

            case "login":
                ob_start();
                    require "view/login/login.php"   ;
                    require "view/login/register.php";
                $content = ob_get_clean();
                    require "view/login/container.php";
                break;
            case "profile":
                ob_start();
                    require "view/profile/userPosts.php" ;  
                    require "view/profile/score.php";
                $content = ob_get_clean();
                    require "view/profile/container.php";
                break;
            case "edit":
                    require "view/edit/edit.php" ;  
                break;

            case "comment":
                    require "view/comment/post.php" ;  
                    require "view/comment/comment.php";
            
                break;
            
        }
        
    }
    function conFooter(){
        require "view/footer.php";
        //print_r($this->data);
    }
    

    function render(){
        $this->conHead();
        $this->conHeader();
        $this->conBody();
        $this->conFooter();
    }

}


?>