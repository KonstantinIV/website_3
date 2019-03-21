<?php 



//require_once "controller/routerController.php";
/*require_once "controller/mainController.php";
require_once "controller/viewController.php";
require_once "controller/modelController.php";
require_once "controller/indexController.php";
require_once "controller/loginController.php";
require_once "controller/profileController.php";
require_once "controller/editController.php";
require_once "controller/commentController.php";
require_once "controller/logOutController.php";
require_once "controller/deleteController.php";

require_once "utility/mainLoginUtility.php";
require_once "utility/loginUtility.php";
require_once "utility/registerUtility.php";
require_once "utility/indexPageUtility.php";
require_once "utility/editUtility.php";
require_once "utility/likeUtility.php";
require_once "utility/dislikeUtility.php";

require_once "model/postModel.php";
require_once "model/sessionModel.php";
require_once "model/userModel.php";
require_once "model/loginModel.php";
require_once "model/profileModel.php";
require_once "model/commentModel.php";*/
/*
use \router\routerController as routerController;

use index as indexController;
use main  as mainController;
use postmodel as postModel;
use mainModel as modelController;*/

use \src\controller;
use \src\model;
use \src\utility;

spl_autoload_register(function ($class) {
    $class = (string) $class;
    $sourcePath = __DIR__ . DIRECTORY_SEPARATOR;
    $replaceRootPath = str_replace('src\\', $sourcePath, $class);
    
    $replaceDirectorySeparator = str_replace('\\', DIRECTORY_SEPARATOR, $replaceRootPath);
    $filePath = $replaceDirectorySeparator . '.php';

    //echo $filePath;
    if (file_exists($filePath)) {
        echo $filePath."\n <br>";
        require_once $filePath;
   
    }
});


//use src\controller\routerController as routerController;
//echo __DIR__;
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);
 $router = new controller\routerController($_GET['url']);

 $router->parseUrl();
 $controllerName = (string)'\\src\\controller\\'.$router->retController();
 //echo $controllerName;
 $controller = new  $controllerName($router->param);

//$controller = new controller\indexController($router->param);












 //$controller->setParams($router->params);
 //loginController::login();
 //$controller = new indexController;


//print_r($router->retParams());





?>