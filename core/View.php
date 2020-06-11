<?php
namespace src\core;

class View {
    

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

    function returnJSON($content){
        $content = json_encode($content);
        echo $content;
    }

}


?>