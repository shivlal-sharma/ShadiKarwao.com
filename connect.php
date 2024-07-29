<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user123";
$con = mysqli_connect($servername,$username,$password,$database);
if(!$con){
    die ("Error".mysqli_connect_error());
}
?>