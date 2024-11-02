<?php include("connection.php"); 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
require_once('vendor/autoload.php');

if(isset($_POST['import-btn']))
{
    $filename = $_FILES['exceldata']['name'];
    $tempname = $_FILES['exceldata']['tmp_name'];
    
    move_uploaded_file($tempname, 'Uploads/'.$filename);

    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadSheet = $Reader->load('Uploads/'.$filename);
    $excelSheet = $spreadSheet->getActiveSheet();
    $spreadSheetAry = $excelSheet->toArray();
    $sheetCount = count($spreadSheetAry);

    // In SQL, column names with spaces or special characters need to be enclosed in backticks (`) to ensure they're recognized correctly.
    for($i = 1;$i<$sheetCount;$i++)
    {
        $sql = "insert into stud_marks(`ROLL NO.`,`DMQP`,`DMQP IT`,`OS`,`OS IT`,`OOPJ`,`OOPJ IT`,`WT`,`WT IT`,`CLIPR`,`CLIPR IT`,`CC`,`CC IT`) values('".$spreadSheetAry[$i][0]."' ,    '".$spreadSheetAry[$i][1]."' , '".$spreadSheetAry[$i][2]."' , '".$spreadSheetAry[$i][3]."' , '".$spreadSheetAry[$i][4]."' , '".$spreadSheetAry[$i][5]."' ,       '".$spreadSheetAry[$i][6]."' , '".$spreadSheetAry[$i][7]."' , '".$spreadSheetAry[$i][8]."' , '".$spreadSheetAry[$i][9]."' , '".$spreadSheetAry[$i][10]."' ,    '".$spreadSheetAry[$i][11]."' , '".$spreadSheetAry[$i][12]."' )";
        mysqli_query($conn,$sql);
    }
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Management System - Import Excel Data</title>
    <link rel="stylesheet" href="fac-style.css"> <!-- Keep any existing styles -->
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000; /* Fallback color */
            background-image: url('loginpage.jpg'); /* Background image */
            background-size: cover;
            background-position: center; /* Center the background */
            background-repeat: no-repeat; /* Prevent the image from repeating */
        }

        .container {
            width: 300px; /* Set a fixed width for the container */
            padding: 20px; /* Padding for internal spacing */
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #fff;
            backdrop-filter: blur(10px); /* Apply blur for glass effect */
            -webkit-backdrop-filter: blur(10px); /* For Safari */
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px; /* Space below heading */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="file"] {
            padding: 10px;
            margin-top: 5px; /* Reduced margin for closer alignment */
            border: none;
            border-radius: 10px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
            font-size: 13px;
        }

        input::placeholder {
            color: #fff;
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

        .sample-file {
            display: inline-block;
            margin: 15px 0;
            text-align: center;
            color: #fff;
            text-decoration: underline;
        }

        .dashboard-link {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Import Marksheet</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="box1">
                <div class="box2">
                    <input type="file" name="exceldata" required data-parsley-type="file" data-parsley-trigger="keyup">
                </div>
                <button type="submit" name="import-btn" value="import">IMPORT</button>
            </div>
        </form>
        <a href="marksheet_stud.xlsx" class="sample-file">Download Sample File</a> 

        <div class="dashboard-link">
            <a href="stud_details.php"><button>Check Student Marks</button></a> 
        </div>
    </div>
</body>
</html>
