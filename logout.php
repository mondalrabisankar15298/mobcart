<?php
session_start();


session_destroy();
header('location:index.php');
//echo 'logout Successfull';
//include('alert\alert_logout.php'); 

?>