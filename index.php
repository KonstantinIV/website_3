<?php 
//use \src\controller\interfaces\projectInterface ;
//use \src\controller\pageController;
use \src\core;
//ini_set('allow_url_fopen', '1');
define("ROOT", "/var/www/html/");/*
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);*/
// ini_set('allow_url_include', 'On');


require  __DIR__."/core/Autoloader.php";
//require  __DIR__."/helpers/helpers.php";


spl_autoload_register(
    "autoloader::autoload"

);


$bootstrap = new core\Bootstrap(
    new core\Router($_GET['url']), 
    new core\UserSession(), 
    new core\View(), 
    $_SERVER['REQUEST_METHOD']
    
    
);
$bootstrap->setController();
$bootstrap->loadContent();








?>