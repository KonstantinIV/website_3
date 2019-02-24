<?php
require_once 'library/database.php';
require_once 'library/register.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Start
    $database = new database;
    $regUser  = new user($database->retPdo());
    $user->set_user($_POST['username'],
                    $_POST['password'],
                    $_POST['email'],
                    $_POST['join_date'],
                    $_POST['birthday']
                    );     
    $user->validate_user();
    $user->validate_existing();
    $user->create_user();
}else{
return 1;
}


?>