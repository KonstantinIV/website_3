<?php
function con_db(){
    //data
    $host = "localhost";
    $username = "root";
    $password = "qwerty";
    $dbname = "webpage_3";

    $dsn = "mysql:host=$host;dbname=$dbname";
    try{
        //Pdo object check if connection is success
        $pdo = new PDO($dsn, $username, $password);
        return $pdo;
    }catch(PDOException $e){
        //conection failed
        return false;
    }

}
?>