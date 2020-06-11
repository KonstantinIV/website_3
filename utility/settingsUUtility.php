<?php
namespace src\utility;

use \src\model;
use \src\controller\core;
use \src\controller\interfaces ;
use \src\utility ;
use \src\controller\helpers;

class settingsUUtility extends utility\mainUtility implements interfaces\utilityInterface{ 
    
    private $model;
    private $tabName;
    
    
    
    
    function __construct($input){
        parent::__construct();
       $this->model = new model\commentModel();
       
       $this->tabName = isset($_POST['tabName']) ? $_POST['tabName'] : false ;

       // echo "kljlklj";
        
    }

    

    function runScript(){
        $html = $this->tabBlock();
        $this->view->renderUtilJSON(array(  "html" => $html)); 

    }

    function tabBlock(){
        ob_start();
        require "view/settings/".$this->tabName.".php";

        $html = ob_get_clean();

    return  $html;
    }

    




  



    

    
}



?>