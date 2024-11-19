<?php
if (isset($_GET['aid'])) {
    include_once '../../dbconfig.php';
    try {
        // Create prepared statement
        $aid = $_GET['aid'];
        date_default_timezone_set('Asia/Karachi');
        $runningdate = date('Y-m-d h:i:s');
        $sql = "INSERT INTO `daily_attendance`( `attedance_date`, `reg_id`, `attendace_status`) VALUES (:attedance_date,:reg_id,0)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters to statement
        $stmt->bindParam(':attedance_date', $runningdate);
        $stmt->bindParam(':reg_id', $aid);

        // Execute the prepared statement
        $stmt->execute();

        session_start();
        $message = array(
            'content' => 'Absent Marked Successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        header("Location: ../daily-attendance.php");
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
} else {
    header("Location: ../index.php");
    die();
}