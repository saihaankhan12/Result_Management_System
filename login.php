<?php
include("server.php");   
//The $_POST superglobal in PHP is used to collect form data sent through an HTTP POST request. It allows you to access data submitted by users through a form with the method="post" attribute, which securely sends data like passwords, user inputs, or other sensitive information that should not appear in the URL.

if(isset($_POST['submit']))  //when we click submit then we redirect to login logic
{
$email = $_POST['email'];
$password = $_POST['pass'];
$sql = "select * from login where Email = '$email' and Password = '$password' ";
$result =  mysqli_query($conn , $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1 && $row['Role'] == 'Student' )
{ //if count == 1, ill redirect it to stud_dashboard page
    header("Location: stud_dashboard.php");
    exit();  
    //If you place any statements below an exit() call in your PHP script, those statements will not be executed. The exit() function immediately terminates the script, so anything that follows it will be ignored.
}

elseif($count == 1 && $row['Role'] == 'Faculty')
{
    header("Location: fac_dashboard.php");
    exit();
}



else
{
    echo '<script>
         window.location.href = "index.php";
         alert("Login Failed. Invalid Username or Password!!!");
         </script>';
} 

}


?>