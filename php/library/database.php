<?php 
class database{

   private $pdo;
   function __construct (){
        //data
        require_once "../conf/conf.php";
        $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
        $this->pdo = new PDO($dsn, DBUSER, DBPWD);
        


   }

   function retPdo(){
      
      return $this->pdo;
   }


}


?>