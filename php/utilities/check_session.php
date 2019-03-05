<?php
session_start();
if(!isset($_SESSION['user']) ) {
   echo 'Set and not empty, and no undefined index error!';
   header('Location: log_in.php');
}
?>