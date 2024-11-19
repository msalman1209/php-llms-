<?php
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        $croped_image = $_POST['image'];
        list($type, $croped_image) = explode(';', $croped_image);
        list(, $croped_image)      = explode(',', $croped_image);
        $croped_image = base64_decode($croped_image);
        $image_name = time() . '.png';
        $path = "teacher/" . $image_name;
        if (file_put_contents('teacher/' . $image_name, $croped_image)) {
            // Create prepared statement
            $sql = "INSERT INTO `teacher_detail`(`t_name`, `fatherName`, `DOB`, `CNIC`, `Address`, `phoneNo`, `cellNo`, `email`, `t_image`, `created_at`) VALUES (:name, :fathername, :dob, :CNIC, :taddress,:phoneNo, :cellNo, :email, :t_image, :created_at);";
            $stmt = $pdo->prepare($sql);
            date_default_timezone_set("Asia/Karachi");
            $current_dated =  date('d-m-y h:i:s');
            // Bind parameters to statement
            $stmt->bindParam(':name', $_REQUEST['tname']);
            $stmt->bindParam(':fathername', $_REQUEST['fName']);
            $stmt->bindParam(':dob', $_REQUEST['tDOB']);
            $stmt->bindParam(':CNIC', $_REQUEST['tcnic']);
            $stmt->bindParam(':taddress', $_REQUEST['tAddress']);
            $stmt->bindParam(':phoneNo', $_REQUEST['phoneNo']);
            $stmt->bindParam(':cellNo', $_REQUEST['cellNo']);
            $stmt->bindParam(':email', $_REQUEST['temail']);
            $stmt->bindParam(':t_image', $path);
            $stmt->bindParam(':created_at', $current_dated);

            // Execute the prepared statement
            $stmt->execute();

            session_start();
            $message = array(
                'content' => 'Teacher Record Add successfully.',
                'type' => 'success',
                'cssClass' => 'success'
            );
            $_SESSION["sweetmsg"] = json_encode($message);
            header("Location: ../view-teacher.php");
        } else {
            echo "<script>alert('click on upload image.')</script>";
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