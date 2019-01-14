<?php 

function san_dt($title,$date,$text){
    //Check if text contains html tags , ex <div>
    if($text != strip_tags($text) ||  $title != strip_tags($title)){
        echo "Contains html tags";
    }else if(!is_int($date) || strlen((string)$date) != 8){
        echo "Date is not numeric or wrong input";
    }else {
        ins_dt($title,$date,$text);

    }
}

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

//insert function
function ins_dt($title,$date, $text){
    //Pdo object
    $pdo = con_db();
    //Check if connection was succesful before inserting
    if ($pdo){
        //echo strlen((string)$date);
        $stmt = $pdo->prepare('insert into post (name, text, c_date, pro_date ) values (?,?, DATE_FORMAT(now(), "%Y-%m-%d %H:%i"), ? )');
        $stmt->execute([$title,$text,$date]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $data;
        echo "Success";
    }else {
        // ERROR
        echo "ERROR 222";
    }
   
    //Close connection
    $pdo = null;


}

//Check if user sends get or post important
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Start
    san_dt( $_POST['title'],(int)$_POST['date'], $_POST['text']);
}











?>