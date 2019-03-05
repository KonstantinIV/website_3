<?php 
session_start();
if(!isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: log_in.php');
}
require_once "library/profile.php";
$id = $_GET['id'];
$pdo     = new database();
$profile = new profile($pdo->retPdo());
$profile->delPost($id);


header('Location: profile.php');

?>