<?php
include('connection.php');
require 'vendor/autoload.php'; // PhpSpreadsheet library
use PhpOffice\PhpSpreadsheet\IOFactory;



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file is uploaded
    if (isset($_FILES['marksheet']) && $_FILES['marksheet']['error'] == 0) {
        // Get semester from form
        $semester = $_POST['semester'];

        // Get file path
        $fileTmpPath = $_FILES['marksheet']['tmp_name'];
        $spreadsheet = IOFactory::load($fileTmpPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        // Define table name based on semester
        $tableName = "semester_" . $semester . "_marks";

        // Create table if it doesn't exist
        $createTableQuery = "
            CREATE TABLE IF NOT EXISTS $tableName (
                id INT AUTO_INCREMENT PRIMARY KEY,
                NAME VARCHAR(50),
                EXNO VARCHAR(20),
                DMS_TH INT,
                DMS_IA INT,
                DMS_TW INT,
                OOSE_TH INT,
                OOSE_IA INT,
                OOSE_TW INT,
                MM_TH INT,
                MM_IA INT,
                MADF_TH INT,
                MADF_IA INT,
                FLAT_TH INT,
                FLAT_IA INT,
                EE_TH INT,
                EE_IA INT,
                MADFLAB_PR INT,
                MMLAB_TW INT,
                MMLAB_PRAC INT
            );
        ";
        
        if ($conn->query($createTableQuery) === TRUE) {
            echo "Table $tableName created successfully or already exists.<br>";
        } else {
            die("Error creating table: " . $conn->error);
        }

        // Skip header row and insert data
        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // Skip header

            // Extract data from row
            $name = $row['A'];
            $exno = $row['B'];
            $dms_th = $row['C'];
            $dms_ia = $row['D'];
            $dms_tw = $row['E'];
            $oose_th = $row['F'];
            $oose_ia = $row['G'];
            $oose_tw = $row['H'];
            $mm_th = $row['I'];
            $mm_ia = $row['J'];
            $madf_th = $row['K'];
            $madf_ia = $row['L'];
            $flat_th = $row['M'];
            $flat_ia = $row['N'];
            $ee_th = $row['O'];
            $ee_ia = $row['P'];
            $madflab_pr = $row['Q'];
            $mmlab_tw = $row['R'];
            $mmlab_prac = $row['S'];

            // Insert data into the database
            $insertDataQuery = "
                INSERT INTO $tableName (NAME, EXNO, DMS_TH, DMS_IA, DMS_TW, OOSE_TH, OOSE_IA, OOSE_TW, 
                                        MM_TH, MM_IA, MADF_TH, MADF_IA, FLAT_TH, FLAT_IA, EE_TH, EE_IA, 
                                        MADFLAB_PR, MMLAB_TW, MMLAB_PRAC)
                VALUES ('$name', '$exno', $dms_th, $dms_ia, $dms_tw, $oose_th, $oose_ia, $oose_tw, 
                        $mm_th, $mm_ia, $madf_th, $madf_ia, $flat_th, $flat_ia, $ee_th, $ee_ia, 
                        $madflab_pr, $mmlab_tw, $mmlab_prac);
            ";

            if (!$conn->query($insertDataQuery)) {
                echo "Error inserting data on row $index: " . $conn->error . "<br>";
            }
        }

        echo "Data imported successfully for semester $semester.";
    } else {
        echo "File upload error!";
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Marksheet</title>
    <link rel="stylesheet" href="fac-style.css">
</head>
<body>
    <div class="container">
        <h1>Import Marksheet</h1>
        <form action="fac_dashboard.php" method="POST" enctype="multipart/form-data">
          <div class="excel-label">  <label for="fileUpload">Upload Excel File:</label> </div>
            <input type="file" id="fileUpload" name="marksheet" accept=".xlsx, .xls">
            
           <div class="sem"> <label for="semester">Select Semester:</label></div>
    
            <select id="semester" name="semester">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            
            <button type="submit">Submit</button>
        </form>
        
        <button onclick="location.href='check_student_marks.html'" class="check-marks-btn">Check Student Marks</button>
    </div>
</body>
</html>
