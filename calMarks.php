<?php include("connection.php"); 

if(isset($_POST['submit-btn']))
{
    $rollnum = $_POST['rollno'];
    $sql = "select * from stud_marks where `ROLL NO.` = '$rollnum' "; 
}   

?>