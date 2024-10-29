<?php include("connection.php"); ?> 

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
    <form action="login.php" method="POST">
       <label for="email">Email Address</label>
       <div> <input type="text" name = "email" id="email" autofocus required> </div> 

       <label for="password">Password</label>
       <div><input type="password" name = "pass" id="password" required></div>

       <button type="submit" name = "submit"> Login </button>
    </form>
</body>
</html>
 