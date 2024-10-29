<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "result_management";
$conn = new mysqli($servername,$username,$password,$db_name); //mysqli_connect : function to connect to the database
if($conn->connect_error)  //if connection error
{
    die("Connection failed".$conn->connect_error); //die function : prints a msg and exit the current script
}
echo "";

?>

