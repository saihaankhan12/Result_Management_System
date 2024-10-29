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
    <title>Document</title>
    <link rel="stylesheet" href="fac-style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    <div class="box1">
        <div class="box2">
        <input type="file" name="exceldata" required data-parsley-type="file" data-parsley-trigger="keyup">
        </div>
        <button type="submit" name="import-btn" value="import">IMPORT</button>
    
    </form>
    <a href="marksheet_stud.xlsx" >Download Sample File </a> 
    </div>

   
</body>
</html>