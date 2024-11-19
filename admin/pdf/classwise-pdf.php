<?php
// Include the FPDF library
require('fpdf.php');

// Mockup database connection
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'united_database';

// Create a database connection (using mysqli)
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected class ID from URL parameter
$selectedClassID = isset($_GET['classID']) ? $_GET['classID'] : null;

// Get date from URL parameter
$date = isset($_GET['date']) ? $_GET['date'] : null;

if (!$selectedClassID || !$date) {
    die("Class ID and date parameters are required.");
}

// Fetch class name based on class ID
$queryClass = "SELECT `class_name` FROM `class` WHERE `cid` = '$selectedClassID'";
$resultClass = $conn->query($queryClass);

$className = '';
if ($resultClass->num_rows > 0) {
    $row = $resultClass->fetch_assoc();
    $className = $row['class_name'];
}

// Execute the provided query
$query = "SELECT 
            sd.`reg_id`, 
            sd.`std_name`, 
            sd.`std_fathername`,
            r.`subjectName`, 
            r.`subjectMarks`, 
            r.`subjectTotal`, 
            r.`subjectGrade` 
          FROM 
            `result` r 
          JOIN 
            `student_detail` sd ON r.`reg_id` = sd.`reg_id` 
          WHERE 
            DATE(r.`result_date`) = '$date' AND sd.`class` = '$selectedClassID'";

$result = $conn->query($query);

// Create a PDF document with landscape orientation and set margins
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 15); // Enable auto page break with a margin of 15mm

// Add a new page
$pdf->AddPage();

// Set font and size for title
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(0, 10, 'Student Results', 0, 1, 'C');

// Set font and size for class name on the left side
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 10, 'Class Name: ' . $className, 0, 0, 'L');

// Set font and size for result date on the right side
$pdf->Cell(0, 10, 'Date: ' . $date, 0, 1, 'R');

// Set font and size for table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 10, 'Reg ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Student Name', 1, 0, 'C');
$pdf->Cell(40, 10, "Father's Name", 1, 0, 'C');
$pdf->Cell(40, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(25, 10, 'Subject Marks', 1, 0, 'C');
$pdf->Cell(25, 10, 'Subject Total', 1, 0, 'C');
$pdf->Cell(25, 10, 'Subject Grade', 1, 1, 'C'); // End of line

// Set font and size for student data
$pdf->SetFont('Arial', '', 10);

// Initialize variables to keep track of the previous student's ID
$prevRegID = null;

// Display student data fetched from the query
while ($row = $result->fetch_assoc()) {
    // Check if Reg ID has changed
    if ($prevRegID !== $row['reg_id']) {
        // Display Reg ID, Student Name, and Father's Name only when it changes
        $pdf->Cell(25, 10, $row['reg_id'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['std_name'], 1, 0, 'C');
        $prevRegID = $row['reg_id'];
    } else {
        // Otherwise, display empty cells
        $pdf->Cell(25, 10, '', 1, 0, 'C');
        $pdf->Cell(40, 10, '', 1, 0, 'C');
    }

    // Display Subject Name, Marks, Total, and Grade
    $pdf->Cell(40, 10, $row['subjectName'], 1, 0, 'C');
    $pdf->Cell(25, 10, $row['subjectMarks'], 1, 0, 'C');
    $pdf->Cell(25, 10, $row['subjectTotal'], 1, 0, 'C');
    $pdf->Cell(25, 10, $row['subjectGrade'], 1, 1, 'C'); // End of line
}

// Output PDF
$pdf->Output();

// Close the database connection
$conn->close();
