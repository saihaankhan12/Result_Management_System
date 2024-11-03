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
        <form action="#" method="POST" enctype="multipart/form-data">
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
