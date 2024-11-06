<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "result_management"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['examno']) && isset($_POST['sem'])) {
    $rollno = $_POST['examno'];
    $semester = $_POST['sem'];

    // SQL query to fetch student name
    $sql_name = "SELECT `name` FROM students WHERE seat_no = '$rollno'";
    $result_name = $conn->query($sql_name);

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Semester Result</title>
        <!-- Link to the external CSS file -->
        <link rel='stylesheet' href='dash_style.css'>  <!-- Path to your CSS file -->
    </head>
    <body>";

    // Prepare table output
    echo "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th colspan='26'>Semester $semester Result</th></tr>";
    echo "<tr>
            <th>First Name</th><th>Seat No</th>
            <th colspan='3'>DMS</th><th colspan='3'>OOSE</th><th colspan='2'>MADF</th><th colspan='2'>MM</th>
            <th colspan='2'>FLAT</th><th colspan='2'>ECO</th>
            <th>SGPA</th><th>RESULT</th>
          </tr>";
    
    // Sub-columns for subjects
    echo "<tr>
            <th></th><th></th>
            <th>TH</th><th>IA</th><th>TW</th><th>TH</th><th>IA</th><th>TW</th>
            <th>TH</th><th>IA</th><th>TH</th><th>IA</th>
            <th>TH</th><th>IA</th><th>TH</th><th>IA</th>
            <th></th><th></th>
          </tr>";

    // Get the student's name
    $first_name = "Not Found";
    if ($result_name->num_rows > 0) {
        $row_name = $result_name->fetch_assoc();
        $first_name = $row_name['name'];
    }

    // Output row for the student's results
    echo "<tr>";
    echo "<td>$first_name</td>";
    echo "<td>$rollno</td>";

    // Array of subjects for which marks will be fetched
    $subjects = ['DMS', 'OOSE', 'MADF', 'MM', 'FLAT', 'ECO'];

    foreach ($subjects as $subject) {
        $sql_marks = "SELECT theory_marks, internal_assessment, term_work 
                      FROM `marks table`
                      WHERE seat_no = '$rollno' AND semester = '$semester' AND subject_practical = '$subject'";
        $result_marks = $conn->query($sql_marks);

        if ($result_marks->num_rows > 0) {
            $mark = $result_marks->fetch_assoc();

            // Only print <td> tags if there's data available for that field
            if (!empty($mark['theory_marks'])) {
                echo "<td>{$mark['theory_marks']}</td>";
            }
            if (!empty($mark['internal_assessment'])) {
                echo "<td>{$mark['internal_assessment']}</td>";
            }
            if (!empty($mark['term_work'])) {
                echo "<td>{$mark['term_work']}</td>";
            }
        } 
    }

    // Calculate SGPA
    $sgpa = calculateSGPA($conn, $rollno, $semester, $subjects);
    $result_status = ($sgpa >= 4) ? "PASS" : "FAIL"; // Example passing condition
    echo "<td>$sgpa</td><td>$result_status</td>";

    echo "</tr>";
    echo "</table>";
} else {
    echo "Please enter roll number and semester.";
}

$conn->close();

// Function to calculate SGPA
function calculateSGPA($conn, $rollno, $semester, $subjects) {
    $totalGradePoints = 0;
    $totalCredits = 0;

    // Define credits for each subject
    $subjectCredits = [
        'DMS' => 4,
        'OOSE' => 4,
        'MADF' => 3,
        'MM' => 3,
        'FLAT' => 3,
        'ECO' => 3,
    ];

    foreach ($subjects as $subject) {
        $sql_marks = "SELECT theory_marks, internal_assessment, term_work
                      FROM `marks table`
                      WHERE seat_no = '$rollno' AND semester = '$semester' AND subject_practical = '$subject'";
        $result_marks = $conn->query($sql_marks);

        if ($result_marks->num_rows > 0) {
            $mark = $result_marks->fetch_assoc();

            // Calculate total marks for the subject
            $totalMarks = ($mark['theory_marks'] ?? 0) + ($mark['internal_assessment'] ?? 0) + ($mark['term_work'] ?? 0);

            // Calculate grade points for the subject
            $gradePoint = getGradePoint($totalMarks);

            // Accumulate weighted grade points and credits
            $totalGradePoints += $gradePoint * $subjectCredits[$subject];
            $totalCredits += $subjectCredits[$subject];
        }
    }

    // Calculate SGPA as total grade points divided by total credits
    return ($totalCredits > 0) ? round($totalGradePoints / $totalCredits, 2) : 0;
}

// Grade point calculation based on total marks
function getGradePoint($marks) {
    if ($marks >= 90) return 10;
    if ($marks >= 80) return 9;
    if ($marks >= 70) return 8;
    if ($marks >= 60) return 7;
    if ($marks >= 50) return 6;
    if ($marks >= 40) return 5;
    return 0;
}
?>
