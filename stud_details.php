<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Marks</title>
    <style>
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
            background-color: #000; /* Fallback color */
            background-image: url('bluebg.jpg');
            background-size: cover;
            background-position: center; /* Center the background */
            background-repeat: no-repeat; /* Prevent the image from repeating */
        }

        .glass-container {
            width: 300px;
            padding: 20px; /* Padding for internal spacing */
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #fff;
            backdrop-filter: blur(10px); /* Apply blur directly here */
            -webkit-backdrop-filter: blur(10px); /* For Safari */
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px; /* Space below heading */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #fff;
            margin-top: 15px; /* Space above the label */
            font-size: 14px; /* Increased font size for readability */
        }

        input,
        select {
            padding: 10px;
            margin-top: 5px; /* Reduced margin for closer alignment */
            border: none;
            border-radius: 10px;
            background: transparent;
            border: 1px solid #fff;
            color: black;
            font-size: 13px;
        }

        input::placeholder {
            color: black;
        }

        input:focus {
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
            color: #fff;
            margin-top: 15px;
        }

        #register {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="glass-container">
        <h2>View Marks</h2>
        <form action="stud_dashboard.php" method="POST">
            <label for="exam">Enter your Exam Number</label>
            <input type="text" id="examno" name="examno" required autofocus placeholder="Exam Number">
            <label for="sem">Semester</label>
            <select name="sem" id="sem" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <div>
                <button type="submit" name="submit-btn">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
</html>