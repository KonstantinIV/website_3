<?php
namespace src\controller\core;

class viewController extends mainController{
    public $pageData = array( 
        "metaData" => array(
            "title" => "",
            "body" => "",
            "loggedIn" => false),
         
         "outputData" => ""
);

    function __construct(){
        //require __DIR__ . "/template.php";
        
    }


    function conHead(){
        require "view/head.php";
    }
    function conHeader(){
        require "view/header.php";

    }



    function conFooter(){
        require "view/footer.php";
        //print_r($this->data);
    }
    

    function render($body){
        $this->conHead();
        $this->conHeader();
        echo $body;
        $this->conFooter();
    }

    function renderUtil($body){
        echo $body;
    }

}


?>