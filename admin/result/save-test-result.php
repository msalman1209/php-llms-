<?php
if (isset($_POST['rollno'])) {
    $rollno = $_POST['rollno'];
    $title = $_POST['title'];
    $ResultDate = $_POST['ResultDate'];
    $result = $_POST['result'];

    try {
        include('../../dbconfig.php');
        // begin the transaction
        $pdo->beginTransaction();
        // our SQL statements

        foreach ($result as $row) {
            $subject = $row['subject'];
            $obt = $row['obtaininsub'];
            $tot = $row['totalinsub'];
            $pdo->exec("INSERT INTO `test_result`(`reg_id`, `title`, `result_date`, `subjectName`, `subjectMarks`, `subjectTotal`) VALUES ('$rollno','$title','$ResultDate','$subject',$obt,$tot)");
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