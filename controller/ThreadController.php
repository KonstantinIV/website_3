<?php
namespace src\controller;
use \src\interfaces ;
use \src\controller ;
use \src\model;

class ThreadController extends controller\MainController { 
    
  

    function get($arr)
    {       
        
        return $this->model->getThreads($_SESSION["user"]);

    }
    function post($arr){
       return array( "flag" => ($this->model->postThread($_SESSION["user"],$arr['threadTitle'],$arr['threadDescription'])));


    }
    function delete($arr){
       


    }
    function put($arr){
     


    }


    
}



?>