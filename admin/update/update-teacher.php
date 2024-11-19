<?php
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        if ($_FILES['photo']['name'] == '') {
            // Create prepared statement
            $id = $_GET['id'];
            $sql = "UPDATE `teacher_detail` SET `t_name`=:tname,`fatherName`=:fathername,`DOB`=:dob,`CNIC`=:CNIC,`Address`=:taddress,`phoneNo`=:phoneNo,`cellNo`=:cellNo,`email`=:email,`updated_at`=:updated_at WHERE `tid`=" . $id;
            $stmt = $pdo->prepare($sql);
            date_default_timezone_set("Asia/Karachi");
            $current_dated =  date('d-m-y h:i:s');
            // Bind parameters to statement
            $stmt->bindParam(':tname', $_REQUEST['tname']);
            $stmt->bindParam(':fathername', $_REQUEST['fName']);
            $stmt->bindParam(':dob', $_REQUEST['tDOB']);
            $stmt->bindParam(':CNIC', $_REQUEST['tcnic']);
            $stmt->bindParam(':taddress', $_REQUEST['tAddress']);
            $stmt->bindParam(':phoneNo', $_REQUEST['phoneNo']);
            $stmt->bindParam(':cellNo', $_REQUEST['cellNo']);
            $stmt->bindParam(':email', $_REQUEST['temail']);
            $stmt->bindParam(':updated_at', $current_dated);

            // Execute the prepared statement
            $stmt->execute();

            session_start();
            $message = array(
                'content' => 'Teacher Record Updated Successfully.',
                'type' => 'success',
                'cssClass' => 'success'
            );
            $_SESSION["sweetmsg"] = json_encode($message);
            header("Location: ../view-teacher.php");
        } else {
            $croped_image = $_POST['image'];
            $previous = $_POST['previous'];
            if ($croped_image != '') {
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image)      = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = time() . '.png';
                $path = "teacher/" . $image_name;
                if (unlink("../insert/" . $previous)) {
                    if (file_put_contents('../insert/teacher/' . $image_name, $croped_image)) {
                        // Create prepared statement
                        $id = $_GET['id'];
                        $sql = "UPDATE `teacher_detail` SET `t_name`=:tname,`fatherName`=:fathername,`DOB`=:dob,`CNIC`=:CNIC,`Address`=:taddress,`phoneNo`=:phoneNo,`cellNo`=:cellNo,`email`=:email,`t_image`=:t_image,`updated_at`=:updated_at WHERE `tid`=" . $id;
                        $stmt = $pdo->prepare($sql);
                        date_default_timezone_set("Asia/Karachi");
                        $current_dated =  date('d-m-y h:i:s');
                        // Bind parameters to statement
                        $stmt->bindParam(':tname', $_REQUEST['tname']);
                        $stmt->bindParam(':fathername', $_REQUEST['fName']);
                        $stmt->bindParam(':dob', $_REQUEST['tDOB']);
                        $stmt->bindParam(':CNIC', $_REQUEST['tcnic']);
                        $stmt->bindParam(':taddress', $_REQUEST['tAddress']);
                        $stmt->bindParam(':phoneNo', $_REQUEST['phoneNo']);
                        $stmt->bindParam(':cellNo', $_REQUEST['cellNo']);
                        $stmt->bindParam(':email', $_REQUEST['temail']);
                        $stmt->bindParam(':t_image', $path);
                        $stmt->bindParam(':updated_at', $current_dated);

                        // Execute the prepared statement
                        $stmt->execute();

                        session_start();
                        $message = array(
                            'content' => 'Teacher Record Updated Successfully.',
                            'type' => 'success',
                            'cssClass' => 'success'
                        );
                        $_SESSION["sweetmsg"] = json_encode($message);
                        header("Location: ../view-teacher.php");
                    }
                } else {
                    session_start();
                    $message = array(
                        'content' => 'No Image Exist With This Name.',
                        'type' => 'error',
                        'cssClass' => 'error'
                    );
                    $_SESSION["sweetmsg"] = json_encode($message);
                    header("Location: ../update-teacher.php?id=" . $_GET['id']);
                }
            } else {
                session_start();
                $message = array(
                    'content' => 'Please Select Image And Click on Upload Image.',
                    'type' => 'error',
                    'cssClass' => 'error'
                );
                $_SESSION["sweetmsg"] = json_encode($message);
                header("Location: ../update-teacher.php?id=" . $_GET['id']);
            }
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
} else {
    header("Location: ../index.php");
    die();
}