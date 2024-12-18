<?php
include("connection.php");
//The $_POST superglobal in PHP is used to collect form data sent through an HTTP POST request. It allows you to access data submitted by users through a form with the method="post" attribute, which securely sends data like passwords, user inputs, or other sensitive information that should not appear in the URL.

if (isset($_POST['submit']))  //when we click submit then we redirect to login logic
{
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql = "select * from user where Email = '$email' and Password = '$password' ";
    $result =  mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1 ) { //if count == 1, ill redirect it to stud_dashboard page
        header("Location: stud_details.php");
        exit();
        //If you place any statements below an exit() call in your PHP script, those statements will not be executed. The exit() function immediately terminates the script, so anything that follows it will be ignored.
    } else {
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
    <link rel="stylesheet" href="login.css">
    <link rel="preload" href="loginpage.jpg" as="image">
   
</head>

<body>
    <nav>
        <h1>SmartResults</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
    <div class="glass-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <input type="text" id="email" name="email" required placeholder="Email">
                <input type="password" id="pass" name="pass" required placeholder="Password">
                <div class="options">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="submit">Login</button>
                <p>Don't have an account? <a href="register.php" id="register">Register</a></p>
            </form>
        </div>
    </div>
</body>

</html>
