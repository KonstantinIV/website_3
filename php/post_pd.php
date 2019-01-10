<?php 

function san_dt($text){
    //Check if text contains html tags , ex <div>
    if($text != strip_tags($text)){
        echo "Contains html tags";
    }else{

        ins_dt($text);

    }
}

function con_db(){
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
        return false;
    }

    
}

//insert function
function ins_dt($text){
    $pdo = con_db();
    //Check if connection was succesful before inserting
    if ($pdo){
        $stmt = $pdo->prepare('insert into post (name, text) values ("kd",?)');
        $stmt->execute([$text]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $data;
    }else {
        echo "222";
    }
   

    $pdo = null;


}

san_dt($_POST['text']);









?>