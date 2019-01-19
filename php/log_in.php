<?php
require_once 'database.php';


function valid($user,$pass){
$pdo = con_db();
//Check if connection was succesful before inserting
if ($pdo){
    //echo strlen((string)$date);

    $stmt = $pdo->prepare('SELECT username, pass  from users WHERE username=? password=?');
    $stmt->execute([$user,$pass]);
    $count = $stmt->rowCount();
    if($count > 1){
        echo "Sm wrong";
    }else {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Succes login";
    }


}else {
    // ERROR
    echo "ERROR 222";
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = mysqli_real_escape_string($_POST['user']);
    $pass = mysqli_real_escape_string($_POST['pass']);
    valid($user,$pass);
}



?>