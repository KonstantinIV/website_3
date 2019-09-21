<?php
namespace src\utility;

use src\model;
use \src\controller\core;
class mainUtility{

    protected $view;
    protected $sessionModel;

    protected $loggedIn;
    protected $input;
    protected $output;
    protected $username;


    function __construct(){
        $this->sessionModel = new model\sessionModel();
        $this->view  = new core\viewController();

        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
        $this->username = isset($_SESSION['user']) ? $_SESSION['user'] : false;


      
       
        
    }


}


?>
