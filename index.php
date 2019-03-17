<?php 
require_once "controller/routerController.php";
require_once "controller/mainController.php";
require_once "controller/viewController.php";
require_once "controller/modelController.php";
require_once "controller/indexController.php";
require_once "controller/loginController.php";
require_once "controller/profileController.php";
require_once "controller/editController.php";
require_once "controller/commentController.php";
require_once "controller/logOutController.php";


require_once "utility/mainLoginUtility.php";
require_once "utility/loginUtility.php";
require_once "utility/registerUtility.php";
require_once "utility/indexPageUtility.php";

require_once "model/postModel.php";
require_once "model/sessionModel.php";
require_once "model/userModel.php";
require_once "model/loginModel.php";
require_once "model/profileModel.php";
require_once "model/commentModel.php";

ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

 $router = new routerController($_GET['url']);

 $router->parseUrl();
 $controllerName = $router->retController();
 $controller = new  $controllerName($router->param);
 //$controller->setParams($router->params);
 //loginController::login();
 //$controller = new indexController;


//print_r($router->retParams());





?>