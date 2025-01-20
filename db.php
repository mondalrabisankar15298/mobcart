<?php

$databasename = 'college';
$host = 'localhost';
$user = 'root';
$password = '';
$conn =new mysqli($host,$user,'',$databasename);
if(!$conn){
    die("connection error");
}
// if($conn){
//     echo "successfull";
// }
?>