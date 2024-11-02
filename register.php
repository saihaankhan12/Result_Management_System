<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Existing CSS styling */
        * {
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('login.webp');
            background-size: cover;
        }

        .glass-container {
            width: 300px;
            height: 460px; /* Increased height to accommodate the select dropdown */
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #fff;
        }

        .glass-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: -1;
        }

        .login-box {
            max-width: 250px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            color: black;
            margin-top: 30px;
            margin-bottom: -10px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        input, select {
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1); /* Added for visibility */
            border: 1px solid #fff;
            color: black;
            font-size: 13px;
            
        }

        input::placeholder {
            color: black;
        }

        input:focus, select:focus {
            outline: none;
        }

        button {
            background: #fff;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background: transparent;
            color: white;
            outline: 1px solid #fff;
        }

        p {
            font-size: 12px;
            color:black;
            margin-top: 15px;
        }

        #login {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        /* Additional styles for select */
        select {
            color:black; /* White text color */
            padding-right: 30px; /* Space for custom arrow */
            position: relative; /* Create positioning context for the custom arrow */
        }

        /* Style for dropdown options (this requires a custom dropdown approach) */
        /* This can't be directly styled in all browsers, consider a custom dropdown with JavaScript if needed */
    </style>
</head>
<body>
    <div class="glass-container">
        <div class="login-box">
            <h2>Register</h2>
            <form action="register_process.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="department" required>
                    <option value="" disabled selected>Select Department</option>
                    <option value="COMP">COMP</option>
                    <option value="IT">IT</option>
                    <option value="ETC">ETC</option>
                    <option value="MECH">MECH</option>
                </select>
                <input type="text" name="rollno" placeholder="Roll Number" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a id="login" href="index.php">Login</a></p>
        </div>
    </div>
</body>
</html>
