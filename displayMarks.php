<?php include("connection.php"); 

if(isset($_POST['submit-btn']))
{
    $rollnum = $_POST['rollno'];
    $sql = "select * from stud_marks where `ROLL NO.` = '$rollnum' "; 
}   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks</title>
</head>
<body>
    
</body>
</html>