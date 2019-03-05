<?php 
session_start();
//$_SESSION['user'] = "sfdds";
if(isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: profile.php');
}
?>