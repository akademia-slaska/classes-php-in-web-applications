<?php 
$servername = "localhost";
$username="root";
$pass="";
$db_name="textify_db";

$conn = mysqli_connect($servername, $username, $pass, $db_name);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error() );
}
?>