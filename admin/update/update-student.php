<?php
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        if ($_FILES['photo']['name'] == '') {
            $id = $_GET['id'];
            $sql = "UPDATE `student_detail` SET `reg_id`=:reg_id,`std_name`=:std_name,`std_fathername`=:std_fathername,`DOB`=:DOB,`std_nationality`=:std_nationality,`present_address`=:present_address,`phoneNo`=:phoneNo,`cellNo`=:cellNo,`E_Mail`=:E_Mail,`permanent_address`=:permanent_address,`subjects`=:subjects,`std_fee`=:std_fee,`Relationship`=:Relationship,`GuardianRelation`=:GuardianRelation,`CNIC`=:CNIC,`class`=:class,`std_group`=:std_group,`test_session`=:test_session,`Employee`=:Employee,`Designation`=:Designation,`Organization`=:Organization,`Business`=:Business,`Updated_at`=:Updated_at WHERE `id`=" . $id;
            $stmt = $pdo->prepare($sql);
            date_default_timezone_set("Asia/Karachi");
            $current_dated =  date('d-m-y h:i:s');
            // Bind parameters to statement
            $stmt->bindParam(':reg_id', $_REQUEST['regid']);
            $stmt->bindParam(':std_name', $_REQUEST['stdName']);
            $stmt->bindParam(':std_fathername', $_REQUEST['fatherName']);
            $stmt->bindParam(':DOB', $_REQUEST['DOB']);
            $stmt->bindParam(':std_nationality', $_REQUEST['Nationality']);
            $stmt->bindParam(':present_address', $_REQUEST['presentAddress']);
            $stmt->bindParam(':phoneNo', $_REQUEST['phoneNo']);
            $stmt->bindParam(':cellNo', $_REQUEST['cellNo']);
            $stmt->bindParam(':E_Mail', $_REQUEST['email']);
            $stmt->bindParam(':permanent_address', $_REQUEST['permanentAddress']);
            $stmt->bindParam(':subjects', $_REQUEST['subjects']);
            $stmt->bindParam(':std_fee', $_REQUEST['stdfee']);
            $stmt->bindParam(':Relationship', $_REQUEST['relation']);
            $stmt->bindParam(':GuardianRelation', $_REQUEST['GuardianRelation']);
            $stmt->bindParam(':CNIC', $_REQUEST['cnic']);
            $stmt->bindParam(':class', $_REQUEST['SelectClass']);
            $stmt->bindParam(':std_group', $_REQUEST['SelectGroup']);
            $stmt->bindParam(':test_session', $_REQUEST['SelectSession']);
            $stmt->bindParam(':Employee', $_REQUEST['SelectEmployee']);
            $stmt->bindParam(':Designation', $_REQUEST['Designation']);
            $stmt->bindParam(':Organization', $_REQUEST['Organization']);
            $stmt->bindParam(':Business', $_REQUEST['Business']);
            $stmt->bindParam(':Updated_at', $current_dated);

            // Execute the prepared statement
            $stmt->execute();

            session_start();
            $message = array(
                'content' => 'Student Record Updated successfully.',
                'type' => 'success',
                'cssClass' => 'success'
            );
            $_SESSION["sweetmsg"] = json_encode($message);
            header("Location: ../view-student.php");
        } else {
            $croped_image = $_POST['image'];
            $previous = $_POST['previous'];
            if ($croped_image != '') {
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image)      = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = time() . '.png';
                $path = "upload/" . $image_name;
                if (unlink("../insert/" . $previous)) {
                    if (file_put_contents('../insert/upload/' . $image_name, $croped_image)) {
                        // Create prepared statement
                        $id = $_GET['id'];
                        $sql = "UPDATE `student_detail` SET `reg_id`=:reg_id,`std_name`=:std_name,`std_fathername`=:std_fathername,`DOB`=:DOB,`std_nationality`=:std_nationality,`present_address`=:present_address,`phoneNo`=:phoneNo,`cellNo`=:cellNo,`E_Mail`=:E_Mail,`permanent_address`=:permanent_address,`subjects`=:subjects,`std_fee`=:std_fee,`Relationship`=:Relationship,`GuardianRelation`=:GuardianRelation,`CNIC`=:CNIC,`class`=:class,`std_group`=:std_group,`test_session`=:test_session,`std_image`=:std_image,`Employee`=:Employee,`Designation`=:Designation,`Organization`=:Organization,`Business`=:Business,`Updated_at`=:Updated_at WHERE `id`=" . $id;
                        $stmt = $pdo->prepare($sql);
                        date_default_timezone_set("Asia/Karachi");
                        $current_dated =  date('d-m-y h:i:s');
                        // Bind parameters to statement
                        $stmt->bindParam(':reg_id', $_REQUEST['regid']);
                        $stmt->bindParam(':std_name', $_REQUEST['stdName']);
                        $stmt->bindParam(':std_fathername', $_REQUEST['fatherName']);
                        $stmt->bindParam(':DOB', $_REQUEST['DOB']);
                        $stmt->bindParam(':std_nationality', $_REQUEST['Nationality']);
                        $stmt->bindParam(':present_address', $_REQUEST['presentAddress']);
                        $stmt->bindParam(':phoneNo', $_REQUEST['phoneNo']);
                        $stmt->bindParam(':cellNo', $_REQUEST['cellNo']);
                        $stmt->bindParam(':E_Mail', $_REQUEST['email']);
                        $stmt->bindParam(':permanent_address', $_REQUEST['permanentAddress']);
                        $stmt->bindParam(':subjects', $_REQUEST['subjects']);
                        $stmt->bindParam(':std_fee', $_REQUEST['stdfee']);
                        $stmt->bindParam(':Relationship', $_REQUEST['relation']);
                        $stmt->bindParam(':GuardianRelation', $_REQUEST['GuardianRelation']);
                        $stmt->bindParam(':CNIC', $_REQUEST['cnic']);
                        $stmt->bindParam(':class', $_REQUEST['SelectClass']);
                        $stmt->bindParam(':std_group', $_REQUEST['SelectGroup']);
                        $stmt->bindParam(':test_session', $_REQUEST['SelectSession']);
                        $stmt->bindParam(':std_image', $path);
                        $stmt->bindParam(':Employee', $_REQUEST['SelectEmployee']);
                        $stmt->bindParam(':Designation', $_REQUEST['Designation']);
                        $stmt->bindParam(':Organization', $_REQUEST['Organization']);
                        $stmt->bindParam(':Business', $_REQUEST['Business']);
                        $stmt->bindParam(':Updated_at', $current_dated);

                        // Execute the prepared statement
                        $stmt->execute();

                        session_start();
                        $message = array(
                            'content' => 'Student Record Updated successfully.',
                            'type' => 'success',
                            'cssClass' => 'success'
                        );
                        $_SESSION["sweetmsg"] = json_encode($message);
                        header("Location: ../view-student.php");
                    }
                } else {
                    session_start();
                    $message = array(
                        'content' => 'No Image Exist With This Name.',
                        'type' => 'error',
                        'cssClass' => 'error'
                    );
                    $_SESSION["sweetmsg"] = json_encode($message);
                    header("Location: ../update-student.php?id=" . $_GET['id']);
                }
            } else {
                session_start();
                $message = array(
                    'content' => 'Please Select Image And Click on Upload Image.',
                    'type' => 'error',
                    'cssClass' => 'error'
                );
                $_SESSION["sweetmsg"] = json_encode($message);
                header("Location: ../update-student.php?id=" . $_GET['id']);
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