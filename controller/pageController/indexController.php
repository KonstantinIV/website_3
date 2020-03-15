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
        
        if(empty($input)){
            $input = [false];
        }else if($input[0] == "new" || $input[0] =="popular"){
            if($input[1] != ""){
                $this->view->pageData['metaData']['sortLinkPopular'] =rtrim("/hot"."/".$input[1] . "/". $input[2]."/". $input[3]."/","/") ;
                $this->view->pageData['metaData']['sortLinkNew'] = rtrim("/new"."/".$input[1] . "/". $input[2]."/". $input[3]."/","/"); 
            }else{

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
