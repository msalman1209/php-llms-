<?php
//include connection file
include('../Grade.php');
include_once("connection.php");
include_once('fpdf.php');
$rollno = $_GET["id"];
$runningdate = $_GET["date"];
$obtainmarks = 0;
$totalmarks = 0;
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $date = date_create($_GET["date"]);
        $name = '';
        $fname = '';
        $class = '';
        $group = '';
        $image = '';
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $result = mysqli_query($connString, "SELECT * FROM `student_detail` as std, class as cls, stdgroup as grp WHERE  std.`class` = cls.cid and std.`std_group`= grp.gid and std.reg_id='" . $_GET["id"] . "'") or die("database error:" . mysqli_error($connString));
        foreach ($result as $row) {
            $image = $row["std_image"];
            $name = $row["std_name"];
            $fname = $row["std_fathername"];
            $class = $row["class_name"];
            $group = $row["g_name"];
        }
        // Logo
        $this->Image('../../assets/img/logo.png', 3, 2, 40);
        $this->SetFont('Arial', 'B', 13);
        // Move to the right
        $this->Cell(45);
        // Title
        // $this->SetDrawColor(0, 80, 180);
        // $this->SetFillColor(230, 230, 0);
        // $this->SetTextColor(220, 50, 50);
        $this->Cell(90, 10, 'TSF Academy Of Science And Arts', 1, 1, 'C');
        $this->Cell(30);
        $this->Image('../../admin/insert/' . $image, 160, 5, 35);

        // Line break
        $this->Ln(25);
        // Title
        $this->Cell(185, 10, 'Result Card', 1, 1, 'C');
        // Line break
        $this->Ln(3);
        $this->Cell(20, 10, 'Roll No:', 1, 0, 'C');
        $this->Cell(65, 10, "" . $_GET["id"] . "", 1, 0, 'C');
        $this->Cell(40, 10, 'Date:', 1, 0, 'C');
        $this->Cell(60, 10, "" . date_format($date, "d-M-Y") . "", 1, 0, 'C');
        $this->Ln();
        $this->Cell(20, 10, 'Name:', 1, 0, 'C');
        $this->Cell(65, 10, "" . $name . "", 1, 0, 'C');
        $this->Cell(40, 10, 'Father Name:', 1, 0, 'C');
        $this->Cell(60, 10, "" . $fname . "", 1, 0, 'C');
        $this->Ln();
        $this->Cell(20, 10, 'Class:', 1, 0, 'C');
        $this->Cell(65, 10, "" . $class . "", 1, 0, 'C');
        $this->Cell(40, 10, 'Group:', 1, 0, 'C');
        $this->Cell(60, 10, "" . $group . "", 1, 0, 'C');

        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('subjectName' => 'Subjects', 'subjectMarks' => 'Obtain Marks', 'subjectTotal' => 'Total Marks',);

$result = mysqli_query($connString, "SELECT subjectName,subjectMarks,subjectTotal FROM `result` WHERE `reg_id`='$rollno' and `result_date`='$runningdate'") or die("database error:" . mysqli_error($connString));
// $header = mysqli_query($connString, "SHOW columns FROM result");
$header = array('subjectName', 'subjectMarks', 'subjectTotal');

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);
foreach ($header as $heading) {
    $pdf->Cell(62, 10, $display_heading[$heading], 1, 0, 'C');
}
foreach ($result as $row) {
    $pdf->Ln();
    foreach ($row as $column)
        $pdf->Cell(62, 10, $column, 1, 0, 'C');
}
$pdf->Ln(20);
foreach ($result as $row) {
    $obtainmarks = $obtainmarks + $row["subjectMarks"];
    $totalmarks = $totalmarks + $row["subjectTotal"];
}
$pdf->Cell(62, 10, 'Secure Marks : ' . $obtainmarks . ' / ' . $totalmarks . '', 1, 0, 'C');
$pdf->Cell(62, 10, 'Percentage: ' . bcdiv((($obtainmarks / $totalmarks) * 100), 1, 2) . '%', 1, 0, 'C');
$pdf->Cell(62, 10, 'Grade: ' . GradeCheck((($obtainmarks / $totalmarks) * 100)) . '', 1, 0, 'C');
$pdf->Ln(60);
$pdf->Cell(62, 10, 'Teacher Sign:', 1, 0, 'C');
$pdf->Cell(62, 10, '', 1, 0, 'C');
$pdf->Cell(62, 10, 'Parent Sign:', 1, 0, 'C');
$pdf->Output();