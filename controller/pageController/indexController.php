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
    private $searchInput;
    protected $output;
    //private categoryName = "";
    

    
    function __construct($input){
    
        //print_r($_COOKIE);
        parent::__construct("postModel", "Main", "index", $input);
        
        if($input[0] == "new" || $input[0] =="popular"){
            if($input[1] == "cat"){
                $this->view->pageData['metaData']['sortLinkPopular'] = "/popular"."/".$input[1] . "/". $input[2]."/";
                $this->view->pageData['metaData']['sortLinkNew'] = "/new"."/".$input[1] . "/". $input[2]."/";
            }
        }else{
            if($input[0] == "cat" ){
                $this->view->pageData['metaData']['sortLinkPopular'] = "/popular"."/".$input[0] . "/". $input[1]."/";
                $this->view->pageData['metaData']['sortLinkNew'] = "/new"."/".$input[0] . "/". $input[1]."/";
            }
        }


        $this->username     =  isset($_SESSION['user']) ? $_SESSION['user'] : false;
        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
       
    
    }




    function loadPage(){
       
            $this->view->render($this->pageBody());
        
    }

   

  
    function pageBody(){
     
        ob_start();
            require "view/index/container.php";
        return  ob_get_clean();
}



    
   

    



}


?>
