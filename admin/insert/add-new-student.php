<?php
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        $croped_image = $_POST['image'];
        list($type, $croped_image) = explode(';', $croped_image);
        list(, $croped_image)      = explode(',', $croped_image);
        $croped_image = base64_decode($croped_image);
        $image_name = time() . '.png';
        $path = "upload/" . $image_name;
        if (file_put_contents('upload/' . $image_name, $croped_image)) {
            // Create prepared statement
            $sql = "INSERT INTO `student_detail`(`reg_id`, `std_name`, `std_fathername`, `DOB`, `std_nationality`, `present_address`, `phoneNo`, `cellNo`, `E_Mail`, `permanent_address`, `subjects`,`std_fee`, `Relationship`, `GuardianRelation`, `CNIC`, `class`, `std_group`, `test_session`, `submission_date`, `std_image`, `Employee`, `Designation`, `Organization`, `Business`, `Created_at`) VALUES ( :reg_id, :std_name, :std_fathername, :DOB, :std_nationality, :present_address, :phoneNo, :cellNo, :E_Mail, :permanent_address, :subjects, :std_fee, :Relationship, :GuardianRelation, :CNIC, :class, :std_group, :test_session, :submission_date, :std_image, :Employee, :Designation, :Organization, :Business, :Created_at)";
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
            $stmt->bindParam(':submission_date', $current_dated);
            $stmt->bindParam(':std_image', $path);
            $stmt->bindParam(':Employee', $_REQUEST['SelectEmployee']);
            $stmt->bindParam(':Designation', $_REQUEST['Designation']);
            $stmt->bindParam(':Organization', $_REQUEST['Organization']);
            $stmt->bindParam(':Business', $_REQUEST['Business']);
            $stmt->bindParam(':Created_at', $current_dated);

            // Execute the prepared statement
            $stmt->execute();

            session_start();
            $message = array(
                'content' => 'Student Record Add successfully.',
                'type' => 'success',
                'cssClass' => 'success'
            );
            $_SESSION["sweetmsg"] = json_encode($message);
            header("Location: ../view-student.php");
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