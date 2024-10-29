<?php
include("connection.php");   
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

  <!-- all pages that include connection.php will share the same database connection and be able to interact with the database efficiently. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <H2>LOGIN</H2>
    <form action="" method="POST">
       <label for="email">Email Address</label>
       <div> <input type="text" name = "email" id="email" autofocus required> </div> 

       <label for="password">Password</label>
       <div><input type="password" name = "pass" id="password" required></div>

       <button type="submit" name = "submit"> Login </button>
    </form>
</body>
</html>
 