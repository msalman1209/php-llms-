<?php
if (isset($_POST['rollno'])) {
    $rollno = $_POST['rollno'];
    $ResultDate = $_POST['ResultDate'];
    $result = $_POST['result'];

    try {
        include('../../dbconfig.php');
        // begin the transaction
        $pdo->beginTransaction();
        // our SQL statements

        foreach ($result as $row) {
            $subject = $row['subjects'];
            $obt = $row['obtaininsub'];
            $tot = $row['totalinsub'];
            // $grd = $row['gradeinsub'];
            $pdo->exec("INSERT INTO `result`(`reg_id`, `result_date`, `subjectName`, `subjectMarks`, `subjectTotal`) VALUES ('$rollno','$ResultDate','$subject',$obt,$tot)");
        }
        $pdo->commit();
        // commit the transaction
        if ($pdo) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 201));
        }
    } catch (PDOException $e) {
        // roll back the transaction if something failed
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;
}