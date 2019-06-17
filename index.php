<?php 
//use \src\controller\interfaces\projectInterface ;
//use \src\controller\pageController;
use \src\controller\core;


define("ROOT", "/var/www/html/");/*
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);*/



require  __DIR__."/controller/core/autoloader.php";


spl_autoload_register(
    "autoloader::autoload"

);

$bootstrap = new core\bootstrap();
$bootstrap->initController();
$bootstrap->loadContent();








?>