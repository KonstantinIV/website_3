<?php
require_once 'library/database.php';
require_once 'library/log_in.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   
    $user = mysqli_real_escape_string($_POST['user']);
    $pass = mysqli_real_escape_string($_POST['pass']);
    

    $s = new usr_session;
    $s->set_usr($user,$pass);
    $s->check_usr();
    $s->sess_start();

}
?>