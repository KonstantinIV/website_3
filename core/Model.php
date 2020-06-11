<?php 
namespace src\core;
//use src\controller;
require_once "conf/conf.php";
class Model{
    
    private $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;

    protected $pdo;
    
   function __construct(){    
        $this->pdo = new \PDO($this->dsn, DBUSER, DBPWD);
        
    }

}

?>