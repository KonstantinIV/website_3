<?php
namespace src\core;

class View {
    

    function __construct(){
        //require __DIR__ . "/template.php";
        
    }


  




    function returnJSON($content){
        $content = json_encode($content);
        echo $content;
    }

}


?>