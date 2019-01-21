<?php
session_start();
require_once 'database.php';
//$_SESSION['uname'] = "trolo";


function valid($user,$pass){
    //echo "1";
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
    
    $_SESSION['uname'] = "troooolo";


}else {
    // ERROR
    echo "ERROR 222";
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //echo "ssdsda1";
    $user = mysqli_real_escape_string($_POST['user']);
    $pass = mysqli_real_escape_string($_POST['pass']);
    valid($user,$pass);
}



?>

<?php
/*
session_start();
//require_once 'php/log_in.php';
//$_SESSION['uname'] = "trolo";

echo $_SESSION['uname'];
/*if(!isset($_SESSION['uname'])){
    header('Location: login.html');
}*/
?>