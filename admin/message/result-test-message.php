<?php
if (isset($_GET['id']) && isset($_GET['date'])) {
    $rollno = $_GET["id"];
    $runningdate = $_GET["date"];
    $date = date_create($runningdate);

    $number = '';
    $stdrollno = '';
    $name = "";
    $class = "";
    $group = "";
    $subjects = "";
    $Obtain = 0;
    $total = 0;
    $title = '';
    try {
        include('../../dbconfig.php');
        $sql = "SELECT * FROM test_result as res, student_detail as sd, class as cls, stdgroup as grp WHERE sd.`class` = cls.cid and sd.`std_group`= grp.gid and res.reg_id = sd.reg_id and res.`reg_id`='$rollno' and res.`result_date`='$runningdate'";
        $result = $pdo->query($sql);
        $counter = 0;
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $number = $row["phoneNo"];
                $stdrollno = $row["reg_id"];
                $name = $row["std_name"] . " " . $row["std_fathername"];
                $class = $row["class_name"];
                $group = $row["g_name"];
                $title = $row["title"];
                $Obtain = $Obtain +  $row["subjectMarks"];
                $total = $total +  $row["subjectTotal"];
                $subjects = $subjects . "*" . $row["subjectName"] . "*: *" . $row["subjectMarks"] . "* / *" . $row["subjectTotal"] . "*" . ".%0a";
            }
            // echo $stdrollno . "<br>";
            // echo $name . "<br>";
            // echo $class . "<br>";
            // echo $group . "<br>";
            // echo $subjects;
            // echo $Obtain;
            // echo $total;
            $msg = "Roll No:" . $stdrollno . "%0aName: " . $name . "%0aClass: " . $class . "%0aGroup: " . $group . "%0aTest Result: " . $title . "%0a" . $subjects . "%0a*TSF Academy Of Science And Arts*%0a*Address: Chandni Chowk 428-C GM Abad FSD.*%0a*Mobile No: +923062736167*";
            //message status update
            $updatesql = "UPDATE `test_result` SET `msgstatus`=? WHERE `reg_id`=? and `result_date`=?";
            $udpatestmt = $pdo->prepare($updatesql);
            $udpatestmt->execute([1, $rollno, $runningdate]);
            // echo $msg;
            header("Location: send-result.php?msg=" . $msg . "&number=" . $number . "&url=" . "test");
            // Free result set
            unset($result);
        } else {
            echo "No records matching your query were found.";
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
}
