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

function get_dt(){
    //Pdo object
    $pdo = con_db();
    //Check if connection was succesful before inserting
    if ($pdo){
        //echo strlen((string)$date);

        $stmt = $pdo->prepare('SELECT id, username,title,text, rel_date, 
        post_date, da_date, likes, dislikes from post2');

        $stmt->execute();


        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);  
               
    }else {
        // ERROR
        echo "ERROR 222";
    }
   
    //Close connection
    $pdo = null;


}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //Start
    get_dt();
}


?>