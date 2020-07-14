<?php
use \src\core;
define("PATH",     "/var/www/html/");

class Autoloader{

    

    static function autoload($class){
        $class = (string) $class;
        $sourcePath = PATH;
        $replaceRootPath = str_replace('src\\', $sourcePath, $class);
        $replaceDirectorySeparator = str_replace('\\', DIRECTORY_SEPARATOR, $replaceRootPath);
        $filePath = $replaceDirectorySeparator . '.php';
    //echo $replaceRootPath."                  " ;
       //echo $filePath; 
        if (file_exists($filePath)) {
            //require_once "controller/pageIn.php";
           // echo "included"."\n <br>";
            include_once $filePath;
            //require_once $filePath;
       
        }
    }
}




?>